<?php declare(strict_types=1);


namespace Sakila\Domain\Entity;

use Sakila\Entity\EntityInterface;
use Sakila\Entity\FactoryInterface;
use Sakila\Exceptions\UnexpectedValueException;

class FactoryAdapter implements FactoryInterface
{
    /**
     * @param string $resource
     * @param array  $items
     *
     * @return array
     */
    public function hydrate(string $resource, array $items): array
    {
        return array_map(
            function ($item) use ($resource) {
                if ($item instanceof EntityInterface) {
                    return $item;
                }

                return $this->create($resource, (array)$item);
            },
            $items
        );
    }

    /**
     * @param string $resource
     * @param array  $arguments
     *
     * @return \Sakila\Entity\EntityInterface
     * @throws \Sakila\Exceptions\UnexpectedValueException
     */
    public function create(string $resource, array $arguments = []): EntityInterface
    {
        $entity = $this->getEntity($resource)->fill($arguments);
        if (!$entity instanceof EntityInterface) {
            throw new UnexpectedValueException();
        }

        return $entity;
    }

    /**
     * @param string $resource
     *
     * @return \Sakila\Domain\Entity\AbstractEntity
     * @throws \Sakila\Exceptions\UnexpectedValueException
     */
    private function getEntity(string $resource): AbstractEntity
    {
        $entity = 'Sakila\Domain\Entity\\' . ucfirst($resource) . 'Entity';
        if (!class_exists($entity)) {
            throw new UnexpectedValueException();
        }

        return new $entity();
    }
}
