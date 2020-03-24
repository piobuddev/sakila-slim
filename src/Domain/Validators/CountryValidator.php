<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Country\Validator\CountryValidatorInterface;

class CountryValidator extends AbstractValidator implements CountryValidatorInterface
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
