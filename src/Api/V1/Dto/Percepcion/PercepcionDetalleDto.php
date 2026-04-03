<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Percepcion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\PagoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TipoCambioDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class PercepcionDetalleDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 2)]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $numDoc = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaPercepcion = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $impTotal = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $impCobrar = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $impPercibido = null;

    /**
     * @var list<PagoDto>
     */
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: PagoDto::class),
    ])]
    #[Assert\Valid]
    public array $cobros = [];

    #[Assert\Valid]
    public ?TipoCambioDto $tipoCambio = null;
}
