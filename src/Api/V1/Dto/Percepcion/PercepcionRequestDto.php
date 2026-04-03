<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Percepcion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use Symfony\Component\Validator\Constraints as Assert;

final class PercepcionRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $serie = null;

    #[Assert\NotBlank]
    public string|int|null $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\Length(max: 500)]
    public ?string $observacion = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?ReceptorDto $proveedor = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $regimen = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $tasa = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $impPercibido = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $impCobrado = null;

    /**
     * @var list<PercepcionDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: PercepcionDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalles = null;
}
