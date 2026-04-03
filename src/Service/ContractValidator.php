<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Service;

use CarlosChininin\FacturaxContracts\Exception\ContractValidationException;
use Symfony\Component\Validator\Validator\ValidatorInterface;

final readonly class ContractValidator
{
    public function __construct(
        private ValidatorInterface $validator,
    ) {
    }

    public function validate(object $dto): void
    {
        $violations = $this->validator->validate($dto);

        if (\count($violations) > 0) {
            throw ContractValidationException::fromViolations($violations);
        }
    }
}

