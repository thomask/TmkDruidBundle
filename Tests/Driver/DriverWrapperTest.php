<?php

namespace Tmk\DruidBundle\Tests\Driver;

use Tmk\DruidBundle\Driver\DriverWrapper;
use Druid\Driver\DriverInterface;
use Tmk\DruidBundle\Logger\DruidLogger;
use Druid\Driver\ConnectionConfig;
use Druid\Driver\DriverConnectionInterface;
use Tmk\DruidBundle\Driver\ConnectionWrapper;

class DriverWrapperTest extends \PHPUnit_Framework_TestCase
{
    public function testConnect()
    {
        $connectionMock = $this->getMockBuilder(DriverConnectionInterface::class)->getMock();

        $driverMock = $this->getMockBuilder(DriverInterface::class)->getMock();
        $driverMock->method('connect')->will($this->returnValue($connectionMock));

        $driverMock->expects($this->once())->method('connect');

        $druidLoggerMock = $this->getMockBuilder(DruidLogger::class)->getMock();

        $driverWrapper = new DriverWrapper($driverMock, $druidLoggerMock);

        $connectionConfigMock = $this->createMock(ConnectionConfig::class);

        $connection = $driverWrapper->connect($connectionConfigMock);

        $this->assertInstanceOf(ConnectionWrapper::class, $connection);
    }
}
