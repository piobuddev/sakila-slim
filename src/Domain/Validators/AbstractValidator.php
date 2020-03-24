<?php declare(strict_types=1);


namespace Sakila\Domain\Validators;

use Sakila\Entity\Validator\ValidatorInterface;
use Sakila\Exceptions\UnexpectedValueException;
use Sakila\Exceptions\Validation\ValidationException;
use Symfony\Component\Validator\Constraints\Collection;
use Symfony\Component\Validator\ConstraintViolation;
use Symfony\Component\Validator\ConstraintViolationList;
use Symfony\Component\Validator\ConstraintViolationListInterface;
use Symfony\Component\Validator\Validation;

abstract class AbstractValidator implements ValidatorInterface
{
    private const ALLOW_EXTRA_FIELDS = true;
    private const ALLOW_MISSING_FIELDS = false;

    /**
     * @return array
     */
    abstract protected function getRules(): array;

    /**
     * @param array $attributes
     *
     * @throws \Sakila\Exceptions\Validation\ValidationException ;
     */
    public function validate(array $attributes): void
    {
        $errors = Validation::createValidator()->validate($attributes, $this->getConstrains());
        if (0 !== $errors->count()) {
            throw new ValidationException($this->getErrorMessage($errors));
        }
    }

    /**
     * @return \Symfony\Component\Validator\Constraints\Collection
     */
    private function getConstrains(): Collection
    {
        $options = [
            'fields'             => $this->getRules(),
            'allowExtraFields'   => self::ALLOW_EXTRA_FIELDS,
            'allowMissingFields' => self::ALLOW_MISSING_FIELDS,
        ];

        return new Collection($options);
    }

    /**
     * @param \Symfony\Component\Validator\ConstraintViolationListInterface $errors
     *
     * @return string
     * @throws \Exception
     */
    private function getErrorMessage(ConstraintViolationListInterface $errors): string
    {
        if (!$errors instanceof ConstraintViolationList) {
            throw new UnexpectedValueException();
        }

        $messages = array_map(
            function (ConstraintViolation $violation) {
                return $violation->getPropertyPath() . ': ' . $violation->getMessage();
            },
            iterator_to_array($errors->getIterator())
        );

        return implode(PHP_EOL, $messages);
    }
}
