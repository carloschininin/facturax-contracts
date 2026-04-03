<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Exception;

use Symfony\Component\Validator\ConstraintViolationListInterface;

final class ContractValidationException extends \InvalidArgumentException
{
    /**
     * @param array<string, list<string>> $errors
     */
    public function __construct(
        private readonly array $errors,
        string $message = 'El contrato enviado no es válido.',
    ) {
        parent::__construct($message);
    }

    /**
     * @return array<string, list<string>>
     */
    public function getErrors(): array
    {
        return $this->errors;
    }

    public static function fromViolations(ConstraintViolationListInterface $violations): self
    {
        /** @var array<string, list<string>> $errors */
        $errors = [];

        foreach ($violations as $violation) {
            $path = '' !== $violation->getPropertyPath() ? $violation->getPropertyPath() : '_global';
            $errors[$path] ??= [];
            $errors[$path][] = $violation->getMessage();
        }

        return new self($errors);
    }
}

