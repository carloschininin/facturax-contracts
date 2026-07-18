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

    /**
     * Código del Catálogo 25 de SUNAT (UNSPSC v14_0801). El formato real
     * esperado es de exactamente 8 dígitos.
     *
     * NO se valida el formato todavía: los sistemas emisores en producción
     * almacenan este código como texto alfanumérico libre y ya envían valores
     * que no cumplen los 8 dígitos. Exigirlo ahora rechazaría guías hoy
     * aceptadas. La validación estricta queda pendiente de la resolución
     * SUNAT que la haga obligatoria.
     */
    #[Assert\Length(max: 50)]
    public ?string $codigoSunat = null;

    /** @deprecated mantener por compatibilidad, usar codigoSunat */
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
