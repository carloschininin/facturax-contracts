<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\LiquidacionCompraCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class LiquidacionCompraDetalleDto
{
    #[Assert\NotNull]
    #[Assert\Positive]
    public ?float $cantidad = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 3)]
    public ?string $unidad = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 500)]
    public ?string $descripcion = null;

    #[Assert\Length(max: 30)]
    public ?string $codigo = null;

    /** Catálogo 25 de SUNAT (UNSPSC), opcional. */
    #[Assert\Length(max: 8)]
    public ?string $codigoSunat = null;

    /** Valor unitario sin IGV. */
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $valorUnitario = null;

    /** Precio unitario con IGV. Si falta: valor unitario + IGV unitario. */
    #[Assert\PositiveOrZero]
    public ?float $precioUnitario = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [LiquidacionCompraCatalog::class, 'tipoAfectacionIgv'])]
    public ?string $tipoAfectacionIgv = null;

    /** Valor de venta del ítem (cantidad × valor unitario), sin IGV. */
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $valorVenta = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentajeIgv = null;

    #[Assert\PositiveOrZero]
    public float $igv = 0.0;

    /** Retención de IR del ítem. Si falta, Facturax la calcula con el porcentaje de los totales. */
    #[Assert\PositiveOrZero]
    public ?float $retencionIr = null;
}
