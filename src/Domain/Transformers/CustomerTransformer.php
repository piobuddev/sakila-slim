<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Customer;

class CustomerTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Customer $customer
     *
     * @return array
     */
    public function transform(Customer $customer): array
    {
        return [
            'customerId' => $customer->getCustomerId(),
            'storeId'    => $customer->getStoreId(),
            'firstName'  => $customer->getFirstName(),
            'lastName'   => $customer->getLastName(),
            'email'      => $customer->getEmail(),
            'addressId'  => $customer->getAddressId(),
            'active'     => $customer->getActive(),
            'createDate' => $customer->getCreateDate(),
        ];
    }
}
