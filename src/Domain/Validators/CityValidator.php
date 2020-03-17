<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\City\Validator\CityValidator as CityValidatorInterface;

class CityValidator extends AbstractValidator implements CityValidatorInterface
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
