<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Rental\Validator\RentalValidator as RentalValidatorInterface;

class RentalValidator extends AbstractValidator implements RentalValidatorInterface
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            //todo: add rules
        ];
    }
}
