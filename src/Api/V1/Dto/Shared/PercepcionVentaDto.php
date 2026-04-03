<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class PercepcionVentaDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 3)]
    public ?string $codReg = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentaje = null;

    #[Assert\PositiveOrZero]
    public ?float $mtoBase = null;

    #[Assert\PositiveOrZero]
    public ?float $mto = null;

    #[Assert\PositiveOrZero]
    public ?float $mtoTotal = null;
}
