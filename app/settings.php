<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Monolog\Logger;
use function DI\env;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions(
        [
            'connection' => [
                'driver'   => 'pdo_mysql',
                'host'     => env('DB_HOST'),
                'dbname'   => env('DB_DATABASE'),
                'user'     => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD'),
            ],
            'settings'   => [
                'displayErrorDetails' => true, // Should be set to false in production
                'logger'              => [
                    'name'  => 'slim-app',
                    'path'  => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
            ],
        ]
    );
};
