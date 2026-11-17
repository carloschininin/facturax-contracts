<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion;

use Symfony\Component\Validator\Constraints as Assert;

/**
 * Totales de la liquidación de compra. El emisor retiene el IGV (IGV – Crédito) y el IR, por eso el neto a
 * pagar al vendedor es importeTotal − igv − retencionIr.
 */
final class LiquidacionCompraTotalesDto
{
    #[Assert\PositiveOrZero]
    public float $gravadas = 0.0;

    #[Assert\PositiveOrZero]
    public float $exoneradas = 0.0;

    #[Assert\PositiveOrZero]
    public float $inafectas = 0.0;

    /** Suma de gravadas, exoneradas e inafectas. */
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $valorVenta = null;

    #[Assert\PositiveOrZero]
    public float $igv = 0.0;

    /** Porcentaje de retención del IR vigente a la fecha de emisión (ej. 1.5). 0 si no corresponde. */
    #[Assert\NotNull]
    #[Assert\Range(min: 0, max: 100)]
    public ?float $porcentajeRetencionIr = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $retencionIr = null;

    /** Valor de venta + IGV. */
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $importeTotal = null;

    /** Importe total neto: importeTotal − igv − retencionIr. */
    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $netoPagar = null;
}
