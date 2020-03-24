<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Customer\Validator\CustomerValidatorInterface;

class CustomerValidator extends AbstractValidator implements CustomerValidatorInterface
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
