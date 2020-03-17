<?php declare(strict_types=1);


namespace Sakila\Application\Logger\Monolog;

use Monolog\Handler\StreamHandler;
use Monolog\Logger;
use Monolog\Processor\UidProcessor;
use Psr\Log\LoggerInterface;

class LoggerFactory
{
    /**
     * @param array $settings
     *
     * @return \Psr\Log\LoggerInterface
     * @throws \Exception
     */
    public function create(array $settings): LoggerInterface
    {
        $loggerSettings = $settings['logger'];
        $logger         = new Logger($loggerSettings['name']);
        $processor      = new UidProcessor();

        $logger->pushProcessor($processor);

        $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
        $logger->pushHandler($handler);

        return $logger;
    }
}
