<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Actor;

class ActorTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Actor $actor
     *
     * @return array
     */
    public function transform(Actor $actor): array
    {
        return [
            'actorId'   => $actor->getActorId(),
            'firstName' => $actor->getFirstName(),
            'lastName'  => $actor->getLastName(),
        ];
    }
}
