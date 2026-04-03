<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\AtributoDetalleDto;
use Symfony\Component\Validator\Constraints as Assert;

final class GuiaRemisionDetalleDto
{
    #[Assert\Length(max: 50)]
    public ?string $codigo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 500)]
    public ?string $descripcion = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 10)]
    public ?string $unidad = null;

    #[Assert\NotNull]
    #[Assert\Positive]
    public ?float $cantidad = null;

    #[Assert\Length(max: 50)]
    public ?string $codProdSunat = null;

    /**
     * @var list<AtributoDetalleDto>
     */
    #[Assert\All([
        new Assert\Type(type: AtributoDetalleDto::class),
    ])]
    #[Assert\Valid]
    public array $atributos = [];
}
