<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Store;

class StoreTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Store $store
     *
     * @return array
     */
    public function transform(Store $store): array
    {
        return [
            'storeId'        => $store->getStoreId(),
            'managerStaffId' => $store->getManagerStaffId(),
            'addressId'      => $store->getAddressId(),
        ];
    }
}
