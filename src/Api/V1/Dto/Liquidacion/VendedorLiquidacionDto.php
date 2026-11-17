<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\LiquidacionCompraCatalog;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Persona natural sin RUC que vende al emisor de la liquidación de compra.
 */
final class VendedorLiquidacionDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [LiquidacionCompraCatalog::class, 'tipoDocumentoVendedor'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 15)]
    public ?string $numDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 100)]
    public ?string $nombres = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?UbicacionLiquidacionDto $domicilio = null;
}
