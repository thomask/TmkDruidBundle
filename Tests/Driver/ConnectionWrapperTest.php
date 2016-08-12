<?php

namespace Tmk\DruidBundle\Tests\Driver;

use Tmk\DruidBundle\Driver\ConnectionWrapper;
use Druid\Driver\DriverConnectionInterface;
use Tmk\DruidBundle\Logger\DruidLogger;
use Druid\Query\QueryInterface;

class ConnectionWrapperTest extends \PHPUnit_Framework_TestCase
{
    public function testSend()
    {
        $connectionMock = $this->getMockBuilder(DriverConnectionInterface::class)->setMethods(['send'])->getMock();
        $connectionMock->expects($this->once())->method('send');

        $druidLoggerMock = $this->getMockBuilder(DruidLogger::class)->setMethods(['log'])->getMock();
        $druidLoggerMock->expects($this->once())->method('log');

        $connectionWrapper = new ConnectionWrapper($connectionMock, $druidLoggerMock);

        $queryMock = $this->createMock(QueryInterface::class);

        $connectionWrapper->send($queryMock);
    }
}
