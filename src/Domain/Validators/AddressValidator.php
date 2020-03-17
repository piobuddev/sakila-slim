<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Address\Validator\AddressValidator as AddressValidatorInterface;

class AddressValidator extends AbstractValidator implements AddressValidatorInterface
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
