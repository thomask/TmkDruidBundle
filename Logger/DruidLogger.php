<?php

namespace Tmk\DruidBundle\Logger;

use Druid\Query\QueryInterface;

class DruidLogger implements QueryLoggerInterface
{
    /**
     * @var array
     */
    protected $queries = [];

    /**
     * {@inheritdoc}
     */
    public function log(QueryInterface $query, $duration)
    {
        $this->queries[] = array('query' => $query, 'duration' => $duration);
    }

    /**
     * {@inheritdoc}
     */
    public function getQueries()
    {
        return $this->queries;
    }
}
