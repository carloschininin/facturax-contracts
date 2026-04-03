<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja;

use Symfony\Component\Validator\Constraints as Assert;

final class ComunicacionBajaRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaGeneracion = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaBaja = null;

    /**
     * @var list<ComunicacionBajaDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: ComunicacionBajaDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalles = null;
}
