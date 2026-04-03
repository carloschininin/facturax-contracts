<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class TotalesDto
{
    #[Assert\PositiveOrZero]
    public float $gravadas = 0.0;

    #[Assert\PositiveOrZero]
    public float $inafectas = 0.0;

    #[Assert\PositiveOrZero]
    public float $exoneradas = 0.0;

    #[Assert\PositiveOrZero]
    public float $exportacion = 0.0;

    #[Assert\PositiveOrZero]
    public float $gratuitas = 0.0;

    #[Assert\PositiveOrZero]
    public float $igvGratuitas = 0.0;

    #[Assert\PositiveOrZero]
    public float $igv = 0.0;

    #[Assert\PositiveOrZero]
    public float $baseIvap = 0.0;

    #[Assert\PositiveOrZero]
    public float $ivap = 0.0;

    #[Assert\PositiveOrZero]
    public float $baseIsc = 0.0;

    #[Assert\PositiveOrZero]
    public float $isc = 0.0;

    #[Assert\PositiveOrZero]
    public float $baseOtrosTributos = 0.0;

    #[Assert\PositiveOrZero]
    public float $otrosTributos = 0.0;

    #[Assert\PositiveOrZero]
    public float $otrosCargos = 0.0;

    #[Assert\PositiveOrZero]
    public float $icbper = 0.0;

    #[Assert\PositiveOrZero]
    public float $totalImpuestos = 0.0;

    #[Assert\PositiveOrZero]
    public float $redondeo = 0.0;

    #[Assert\PositiveOrZero]
    public float $valorVenta = 0.0;

    #[Assert\PositiveOrZero]
    public float $subTotal = 0.0;

    #[Assert\PositiveOrZero]
    public float $sumDsctoGlobal = 0.0;

    #[Assert\PositiveOrZero]
    public float $descuentos = 0.0;

    #[Assert\PositiveOrZero]
    public float $sumOtrosDescuentos = 0.0;

    #[Assert\PositiveOrZero]
    public float $cargos = 0.0;

    #[Assert\PositiveOrZero]
    public float $anticipos = 0.0;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $importeTotal = null;
}
