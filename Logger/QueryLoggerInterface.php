<?php

namespace Tmk\DruidBundle\Logger;

use Druid\Query\QueryInterface;

interface QueryLoggerInterface
{
    /**
     * @param  QueryInterface $query    [description]
     * @param  int            $duration
     */
    public function log(QueryInterface $query, $duration);

    /**
     * @return array
     */
    public function getQueries();
}
