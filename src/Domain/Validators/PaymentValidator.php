<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Payment\Validator\PaymentValidatorInterface;

class PaymentValidator extends AbstractValidator implements PaymentValidatorInterface
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
