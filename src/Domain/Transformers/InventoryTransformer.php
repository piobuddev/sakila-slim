<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Inventory;

class InventoryTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Inventory $inventory
     *
     * @return array
     */
    public function transform(Inventory $inventory): array
    {
        return [
            'inventoryId' => $inventory->getInventoryId(),
            'filmId'      => $inventory->getFilmId(),
            'storeId'     => $inventory->getStoreId(),
        ];
    }
}
