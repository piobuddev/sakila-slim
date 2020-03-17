<?php declare(strict_types=1);


namespace Sakila\Domain\Transformers;

use League\Fractal\TransformerAbstract;
use Sakila\Domain\Entity\Rental;

class RentalTransformer extends TransformerAbstract
{
    /**
     * @param \Sakila\Domain\Entity\Rental $rental
     *
     * @return array
     */
    public function transform(Rental $rental): array
    {
        return [
            'rentalId'    => $rental->getRentalId(),
            'rentalDate'  => $rental->getRentalDate(),
            'inventoryId' => $rental->getInventoryId(),
            'customerId'  => $rental->getCustomerId(),
            'returnDate'  => $rental->getReturnDate(),
            'staffId'     => $rental->getStaffId(),
        ];
    }
}
