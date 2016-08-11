<?php

namespace Tmk\DruidBundle\DataCollector;

use Symfony\Component\HttpKernel\DataCollector\DataCollector;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Tmk\DruidBundle\Logger\QueryLoggerInterface;
use JMS\Serializer\SerializerBuilder;
use JMS\Serializer\Naming\IdenticalPropertyNamingStrategy;

/**
 * DruidDataCollector
 */
class DruidDataCollector extends DataCollector
{
    /**
     * @var QueryLoggerInterface
     */
    protected $logger;

    /**
     * Constructor.
     *
     * @param QueryLoggerInterface $logger
     */
    public function __construct(QueryLoggerInterface $logger)
    {
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function collect(Request $request, Response $response, \Exception $exception = null)
    {
        $serializer = SerializerBuilder::create()
            ->setPropertyNamingStrategy(new IdenticalPropertyNamingStrategy())
            ->build();

        $queries = [];
        foreach ($this->logger->getQueries() as $query) {
            $json = $serializer->serialize($query['query'], 'json');
            $queries[] = [
                'query' => $json,
                'duration' => $query['duration'],
            ];
        }

        $this->data = $queries;
    }

    public function getQueries()
    {
        return $this->data;
    }

    public function getQueryCount()
    {
        return count($this->data);
    }

    public function getQueryDuration()
    {
        $time = 0;
        foreach ($this->data as $query) {
            $time += $query['duration'];
        }

        return $time;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'druid';
    }
}
