<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Staff;

class StaffTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Staff $staff
     *
     * @return array
     */
    public function transform(Staff $staff): array
    {
        return [
            'staffId'   => $staff->getStaffId(),
            'firstName' => $staff->getFirstName(),
            'lastName'  => $staff->getLastName(),
            'addressId' => $staff->getAddressId(),
            'email'     => $staff->getEmail(),
            'storeId'   => $staff->getStoreId(),
            'active'    => $staff->getActive(),
            'username'  => $staff->getUsername(),
            'password'  => $staff->getPassword(),
        ];
    }
}
