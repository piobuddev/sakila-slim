<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Store\Validator\StoreValidator as StoreValidatorInterface;

class StoreValidator extends AbstractValidator implements StoreValidatorInterface
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
