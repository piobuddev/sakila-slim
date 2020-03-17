<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use Closure;
use League\Fractal\Manager;
use League\Fractal\Resource\Collection;
use League\Fractal\Resource\Item;
use League\Fractal\Serializer\ArraySerializer;
use Psr\Container\ContainerInterface;
use Sakila\Application\Fractal\SimplePaginator;
use Sakila\Entity\EntityInterface;
use Sakila\Transformer\Transformer;

class FractalTransformerAdapter implements Transformer
{
    /**
     * @var \League\Fractal\Manager
     */
    private Manager $manager;
    /**
     * @var \Psr\Container\ContainerInterface
     */
    private ContainerInterface $application;

    /**
     * @param \League\Fractal\Manager           $manager
     * @param \Psr\Container\ContainerInterface $application
     */
    public function __construct(Manager $manager, ContainerInterface $application)
    {
        $manager->setSerializer(new ArraySerializer());

        $this->manager     = $manager;
        $this->application = $application;
    }

    /**
     * @param mixed       $data
     * @param string|null $transformer
     *
     * @return array
     */
    public function item($data, string $transformer = null): array
    {
        $item = new Item($data, $this->resolveTransformer($transformer));

        return $this->manager->createData($item)->toArray();
    }

    /**
     * @param string|null $transformer
     *
     * @return \Closure|mixed
     */
    private function resolveTransformer(string $transformer = null)
    {
        if (null === $transformer) {
            return $this->getSimpleTransformer();
        }

        return $this->application->get($transformer);
    }

    /**
     * @return \Closure
     */
    private function getSimpleTransformer(): Closure
    {
        return function (EntityInterface $entity) {
            return $entity->jsonSerialize();
        };
    }

    /**
     * @param mixed    $data
     * @param string   $transformer
     * @param int|null $page
     * @param int|null $pageSize
     * @param int|null $total
     *
     * @return array
     */
    public function collection(
        $data,
        string $transformer = null,
        int $page = null,
        int $pageSize = null,
        int $total = null
    ): array {
        $collection = new Collection($data, $this->resolveTransformer($transformer));
        if (null !== $page) {
            $collection->setPaginator(
                new SimplePaginator($data, $total, $pageSize, $page)
            );
        }

        return $this->manager->createData($collection)->toArray();
    }
}
