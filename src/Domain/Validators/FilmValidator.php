<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Film\Validator\FilmValidatorInterface;

class FilmValidator extends AbstractValidator implements FilmValidatorInterface
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
