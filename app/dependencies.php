<?php declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManagerInterface;
use League\Fractal\Manager;
use Psr\Log\LoggerInterface;
use Sakila\Application\Command\Bus\SimpleCommandBus;
use Sakila\Application\Logger\Monolog\LoggerFactory;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Actor\Entity\Transformer\ActorTransformerInterface;
use Sakila\Domain\Actor\Repository\ActorRepository as ActorRepositoryInterface;
use Sakila\Domain\Actor\Repository\Database\ActorRepository;
use Sakila\Domain\Actor\Validator\ActorValidator as ActorValidatorInterface;
use Sakila\Domain\Entity\FactoryAdapter;
use Sakila\Domain\Transformers\ActorTransformer;
use Sakila\Domain\Transformers\FractalTransformerAdapter;
use Sakila\Domain\Validators\ActorValidator;
use Sakila\Entity\FactoryInterface;
use Sakila\Infrastructure\Persistence\Database\Doctrine\Connection;
use Sakila\Infrastructure\Persistence\Database\Doctrine\EntityManagerFactory;
use Sakila\Repository\Database\ConnectionInterface;
use Sakila\Repository\Database\Table\NameResolver;
use Sakila\Repository\Database\Table\SimpleNameResolver;
use Sakila\Transformer\Transformer;

use function DI\autowire;
use function DI\create;
use function DI\env;
use function DI\factory;
use function DI\get;

return function (ContainerBuilder $containerBuilder) {
    $containerBuilder
        ->useAutowiring(true)
        ->addDefinitions([
            'doctrine' => [
                'driver'   => 'pdo_mysql',
                'host'     => env('DB_HOST'),
                'dbname'   => env('DB_DATABASE'),
                'user'     => env('DB_USERNAME'),
                'password' => env('DB_PASSWORD')
            ],
            LoggerInterface::class => factory([LoggerFactory::class, 'create'])->parameter('settings', get('settings')),
            ConnectionInterface::class => DI\autowire(Connection::class),
            EntityManagerInterface::class => factory([EntityManagerFactory::class, 'create'])
                ->parameter('connection', get('doctrine')),

            CommandBus::class => autowire(SimpleCommandBus::class),
            FactoryInterface::class => create(FactoryAdapter::class),
            NameResolver::class => create(SimpleNameResolver::class),
            Manager::class     => create(),
            Transformer::class => autowire(FractalTransformerAdapter::class),

            ActorValidatorInterface::class   => create(ActorValidator::class),
            ActorTransformerInterface::class => create(ActorTransformer::class),
            ActorRepositoryInterface::class  => autowire(ActorRepository::class),
    ]);
};
