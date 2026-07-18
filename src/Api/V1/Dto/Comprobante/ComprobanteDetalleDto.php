<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\AtributoDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\CargoDescuentoDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoAfectacionIgvCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ComprobanteDetalleDto
{
    #[Assert\Positive]
    public ?float $cantidad = null;

    #[Assert\Length(max: 50)]
    public ?string $codigo = null;

    /**
     * Código del Catálogo 25 de SUNAT (UNSPSC v14_0801). El formato real
     * esperado es de exactamente 8 dígitos.
     *
     * NO se valida el formato todavía: los sistemas emisores en producción
     * almacenan este código como texto alfanumérico libre y ya envían valores
     * que no cumplen los 8 dígitos. Exigirlo ahora rechazaría comprobantes
     * hoy aceptados. La validación estricta queda pendiente de la resolución
     * SUNAT que la haga obligatoria.
     */
    #[Assert\Length(max: 50)]
    public ?string $codigoSunat = null;

    /**
     * Código GTIN de GS1: el formato real esperado es numérico de 8, 12, 13 o
     * 14 dígitos. No es un código UNSPSC.
     *
     * NO se valida el formato todavía, por la misma razón que `codigoSunat`:
     * exigirlo ahora rechazaría comprobantes hoy aceptados en producción.
     */
    #[Assert\Length(max: 50)]
    public ?string $codigoGs1 = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 10)]
    public ?string $unidad = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 500)]
    public ?string $descripcion = null;

    #[Assert\PositiveOrZero]
    public ?float $valorUnitario = null;

    /** @deprecated mantener por compatibilidad */
    #[Assert\PositiveOrZero]
    public ?float $precioUnitario = null;

    #[Assert\PositiveOrZero]
    public ?float $baseIgv = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentajeIgv = null;

    #[Assert\PositiveOrZero]
    public ?float $igv = null;

    #[Assert\Choice(callback: [TipoAfectacionIgvCatalog::class, 'all'])]
    public ?string $tipoAfectacionIgv = null;

    #[Assert\PositiveOrZero]
    public ?float $baseIsc = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentajeIsc = null;

    #[Assert\PositiveOrZero]
    public ?float $isc = null;

    #[Assert\Length(max: 10)]
    public ?string $tipoSistemaIsc = null;

    #[Assert\PositiveOrZero]
    public ?float $baseOtrosTributos = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentajeOtrosTributos = null;

    #[Assert\PositiveOrZero]
    public ?float $otrosTributos = null;

    #[Assert\PositiveOrZero]
    public ?float $icbper = null;

    #[Assert\PositiveOrZero]
    public ?float $factorIcbper = null;

    #[Assert\PositiveOrZero]
    public ?float $totalImpuestos = null;

    #[Assert\PositiveOrZero]
    public ?float $subtotal = null;

    #[Assert\PositiveOrZero]
    public ?float $valorVenta = null;

    #[Assert\PositiveOrZero]
    public ?float $valorGratuito = null;

    /**
     * @var list<CargoDescuentoDto>
     */
    #[Assert\All([
        new Assert\Type(type: CargoDescuentoDto::class),
    ])]
    #[Assert\Valid]
    public array $cargos = [];

    /**
     * @var list<CargoDescuentoDto>
     */
    #[Assert\All([
        new Assert\Type(type: CargoDescuentoDto::class),
    ])]
    #[Assert\Valid]
    public array $descuentos = [];

    #[Assert\PositiveOrZero]
    public ?float $descuento = null;

    /**
     * @var list<AtributoDetalleDto>
     */
    #[Assert\All([
        new Assert\Type(type: AtributoDetalleDto::class),
    ])]
    #[Assert\Valid]
    public array $atributos = [];
}
