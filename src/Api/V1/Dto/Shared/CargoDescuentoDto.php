<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class CargoDescuentoDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $codTipo = null;

    #[Assert\PositiveOrZero]
    public ?float $factor = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $monto = null;

    #[Assert\PositiveOrZero]
    public ?float $montoBase = null;
}
