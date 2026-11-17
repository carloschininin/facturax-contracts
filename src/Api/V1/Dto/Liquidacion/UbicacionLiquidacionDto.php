<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDireccionCatalog;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Domicilio del vendedor o lugar donde se realiza la operación. SUNAT exige ubigeo, dirección y la condición
 * del lugar (catálogo 60: punto de venta, producción, extracción, explotación u otros).
 */
final class UbicacionLiquidacionDto
{
    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^\d{6}$/', message: 'El ubigeo debe tener 6 dígitos.')]
    public ?string $ubigeo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 250)]
    public ?string $direccion = null;

    #[Assert\Length(max: 30)]
    public ?string $departamento = null;

    #[Assert\Length(max: 30)]
    public ?string $provincia = null;

    #[Assert\Length(max: 30)]
    public ?string $distrito = null;

    #[Assert\Length(max: 25)]
    public ?string $urbanizacion = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 2)]
    public string $codigoPais = 'PE';

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDireccionCatalog::class, 'all'])]
    public ?string $condicion = null;
}
