<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Actor\Validator\ActorValidatorInterface;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Required;
use Symfony\Component\Validator\Constraints\Type;

class ActorValidator extends AbstractValidator implements ActorValidatorInterface
{
    /**
     * @return array
     */
    protected function getRules(): array
    {
        return [
            'firstName' => [new Required(), new NotBlank(), new Type('alpha'), new Length(['max' => 45])],
            'lastName'  => [new Required(), new NotBlank(), new Type('alpha'), new Length(['max' => 45])],
        ];
    }
}
