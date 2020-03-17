<?php declare(strict_types=1);


namespace Sakila\Application\Command\Bus;

use Psr\Container\ContainerInterface;
use ReflectionClass;
use Sakila\Command\Bus\CommandBus;
use Sakila\Command\Command;

class SimpleCommandBus implements CommandBus
{
    /**
     * @var \Psr\Container\ContainerInterface
     */
    private ContainerInterface $container;

    /**
     * @param \Psr\Container\ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * @inheritDoc
     * @throws \ReflectionException
     */
    public function execute(Command $command)
    {
        $handlerClassName = self::resolveHandler(get_class($command));
        $handler = $this->container->get($handlerClassName);

        return $handler->execute($command);
    }

    /**
     * @param string $command
     *
     * @return string
     * @throws \ReflectionException
     */
    private static function resolveHandler(string $command): string
    {
        $reflection = new ReflectionClass($command);
        $handlerNamespace = str_replace('Request', '', $reflection->getNamespaceName());
        $chunks = (array)preg_split(
            '/(?=[A-Z])/',
            str_replace('Request', '', $reflection->getShortName())
        );

        array_shift($chunks);

        return $handlerNamespace . implode($chunks) . 'Service';
    }
}
