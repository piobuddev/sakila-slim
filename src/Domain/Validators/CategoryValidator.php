<?php declare(strict_types=1);

namespace Sakila\Domain\Validators;

use Sakila\Domain\Category\Validator\CategoryValidator as CategoryValidatorInterface;

class CategoryValidator extends AbstractValidator implements CategoryValidatorInterface
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
