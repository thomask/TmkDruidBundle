<?php

namespace Tmk\DruidBundle\Driver;

use Druid\Driver\DriverConnectionInterface;
use Druid\Query\QueryInterface;
use Tmk\DruidBundle\Logger\QueryLoggerInterface;

/**
 * ConnectionWrapper
 */
class ConnectionWrapper implements DriverConnectionInterface
{
    /**
     * @var DriverConnectionInterface
     */
    protected $connection;

    /**
     * @var QueryLoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     * @param DriverConnectionInterface $connection
     * @param QueryLoggerInterface      $logger
     */
    public function __construct(DriverConnectionInterface $connection, QueryLoggerInterface $logger)
    {
        $this->connection = $connection;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function send(QueryInterface $query)
    {
        $time_start = microtime(true);
        $result = $this->__call('send', [$query]);
        $time_end = microtime(true);

        $time = $time_end - $time_start;
        $this->logger->log($query, $time);

        return $result;
    }

    public function __call($name, array $args)
    {
        return call_user_func_array([$this->connection, $name], $args);
    }
}
