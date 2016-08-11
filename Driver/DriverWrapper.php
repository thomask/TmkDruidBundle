<?php

namespace Tmk\DruidBundle\Driver;

use Druid\Driver\DriverInterface;
use Druid\Driver\ConnectionConfig;
use Tmk\DruidBundle\Logger\QueryLoggerInterface;

class DriverWrapper implements DriverInterface
{
    /**
     * @var DriverInterface
     */
    protected $driver;

    /**
     * @var QueryLoggerInterface
     */
    protected $logger;

    /**
     * Constructor
     * @param DriverInterface      $driver
     * @param QueryLoggerInterface $logger
     */
    public function __construct(DriverInterface $driver, QueryLoggerInterface $logger)
    {
        $this->driver = $driver;
        $this->logger = $logger;
    }

    /**
     * {@inheritdoc}
     */
    public function connect(ConnectionConfig $config)
    {
        $connection = $this->__call('connect', [$config]);

        return new ConnectionWrapper($connection, $this->logger);
    }

    public function __call($name, array $args)
    {
        return call_user_func_array([$this->driver, $name], $args);
    }
}
