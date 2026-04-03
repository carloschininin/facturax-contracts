<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class AtributoDetalleDto
{
    #[Assert\Length(max: 50)]
    public ?string $code = null;

    #[Assert\Length(max: 255)]
    public ?string $name = null;

    #[Assert\Length(max: 500)]
    public ?string $value = null;

    #[Assert\Date]
    public ?string $fecInicio = null;

    #[Assert\Date]
    public ?string $fecFin = null;

    #[Assert\PositiveOrZero]
    public ?int $duracion = null;
}
