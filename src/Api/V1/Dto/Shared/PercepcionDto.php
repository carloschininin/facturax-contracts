<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class PercepcionDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 3)]
    public ?string $codReg = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $tasa = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoBase = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mto = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoTotal = null;
}

