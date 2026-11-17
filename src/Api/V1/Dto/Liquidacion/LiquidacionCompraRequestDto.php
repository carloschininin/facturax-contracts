<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DocumentoReferenciaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\LeyendaDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\LiquidacionCompraCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * Liquidación de compra electrónica (tipo 04): la emite el comprador con RUC cuando compra a una persona
 * natural sin RUC. Serie L + 3 caracteres (ej. L001).
 */
final class LiquidacionCompraRequestDto
{
    #[Assert\Length(max: 4)]
    public string $ublVersion = '2.1';

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'liquidacion'])]
    public ?string $tipoDoc = null;

    #[Assert\Choice(callback: [LiquidacionCompraCatalog::class, 'tipoOperacion'])]
    public ?string $tipoOperacion = '0501';

    #[Assert\NotBlank]
    #[Assert\Regex(pattern: '/^L[A-Z0-9]{3}$/', message: 'La serie de la liquidación de compra debe tener 4 caracteres y empezar con L (ej. L001).')]
    public ?string $serie = null;

    #[Assert\NotBlank]
    public string|int|null $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\Length(min: 4, max: 4)]
    public string $codLocalEmisor = '0000';

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?VendedorLiquidacionDto $vendedor = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?UbicacionLiquidacionDto $lugarOperacion = null;

    /**
     * @var list<LiquidacionCompraDetalleDto>|null
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: LiquidacionCompraDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalle = null;

    /**
     * Guías de remisión relacionadas (09 o 31), opcional.
     *
     * @var list<DocumentoReferenciaDto>
     */
    #[Assert\All([
        new Assert\Type(type: DocumentoReferenciaDto::class),
    ])]
    #[Assert\Valid]
    public array $guias = [];

    /**
     * @var list<LeyendaDto>
     */
    #[Assert\All([
        new Assert\Type(type: LeyendaDto::class),
    ])]
    #[Assert\Valid]
    public array $leyendas = [];

    #[Assert\Length(max: 500)]
    public ?string $observacion = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?LiquidacionCompraTotalesDto $totales = null;
}
