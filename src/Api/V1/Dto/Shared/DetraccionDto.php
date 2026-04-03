<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class DetraccionDto
{
    #[Assert\PositiveOrZero]
    public ?float $percent = null;

    #[Assert\PositiveOrZero]
    public ?float $monto = null;

    #[Assert\Length(max: 50)]
    public ?string $ctaBanco = null;

    #[Assert\Length(max: 10)]
    public ?string $codMedioPago = null;

    #[Assert\Length(max: 10)]
    public ?string $codBienDetraccion = null;

    #[Assert\PositiveOrZero]
    public ?float $valueRef = null;
}
