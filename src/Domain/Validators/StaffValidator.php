<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Staff\Validator\StaffValidator as StaffValidatorInterface;

class StaffValidator extends AbstractValidator implements StaffValidatorInterface
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
