<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\AnticipoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\CargoDescuentoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DetraccionDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DocumentoReferenciaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\FormaPagoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\LeyendaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\PercepcionVentaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TotalesDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ComprobanteRequestDto
{
    #[Assert\Length(max: 4)]
    public string $ublVersion = '2.1';

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'sale'])]
    public ?string $tipoDoc = null;

    #[Assert\Length(max: 4)]
    public ?string $tipoOperacion = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    #[Assert\Regex(pattern: '/^[A-Z0-9]{1,4}$/')]
    public ?string $serie = null;

    #[Assert\NotBlank]
    public string|int|null $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\Date]
    public ?string $fechaVencimiento = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\Length(min: 4, max: 4)]
    public string $codLocalEmisor = '0000';

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?ReceptorDto $receptor = null;

    #[Assert\Valid]
    public ?FormaPagoDto $formaPago = null;

    /**
     * @var list<CargoDescuentoDto>
     */
    #[Assert\All([
        new Assert\Type(type: CargoDescuentoDto::class),
    ])]
    #[Assert\Valid]
    public array $descuentos = [];

    /**
     * @var list<CargoDescuentoDto>
     */
    #[Assert\All([
        new Assert\Type(type: CargoDescuentoDto::class),
    ])]
    #[Assert\Valid]
    public array $cargos = [];

    #[Assert\Valid]
    public ?PercepcionVentaDto $percepcion = null;

    #[Assert\Valid]
    public ?DetraccionDto $detraccion = null;

    /**
     * @var list<AnticipoDto>
     */
    #[Assert\All([
        new Assert\Type(type: AnticipoDto::class),
    ])]
    #[Assert\Valid]
    public array $anticipos = [];

    /**
     * @var list<DocumentoReferenciaDto>
     */
    #[Assert\All([
        new Assert\Type(type: DocumentoReferenciaDto::class),
    ])]
    #[Assert\Valid]
    public array $guias = [];

    /**
     * @var list<DocumentoReferenciaDto>
     */
    #[Assert\All([
        new Assert\Type(type: DocumentoReferenciaDto::class),
    ])]
    #[Assert\Valid]
    public array $relDocs = [];

    /**
     * @var list<ComprobanteDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: ComprobanteDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalle = null;

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
    public ?TotalesDto $totales = null;
}
