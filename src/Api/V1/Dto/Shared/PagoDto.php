<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class PagoDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $importe = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fecha = null;
}
