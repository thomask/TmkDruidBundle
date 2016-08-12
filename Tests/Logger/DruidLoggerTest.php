<?php

namespace Tmk\DruidBundle\Tests\Logger;

use Tmk\DruidBundle\Logger\DruidLogger;
use Druid\Query\QueryInterface;

class DruidLoggerTest extends \PHPUnit_Framework_TestCase
{
    public function testLog()
    {
        $logger = new DruidLogger();

        $logs = $logger->getQueries();
        $this->assertEquals(0, count($logs));

        $queryMock = $this->createMock(QueryInterface::class);
        $logger->log($queryMock, 10);

        $logs = $logger->getQueries();
        $this->assertEquals(1, count($logs));

        $log = $logs[0];
        $this->assertArrayHasKey('query', $log);
        $this->assertArrayHasKey('duration', $log);
    }
}
