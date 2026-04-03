<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ResumenDiarioRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaGeneracion = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaResumen = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    /**
     * @var list<ResumenDiarioDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: ResumenDiarioDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalles = null;
}
