<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Nota;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DocumentoReferenciaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\FormaPagoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\LeyendaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\PercepcionVentaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TotalesDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class NotaRequestDto
{
    #[Assert\Length(max: 4)]
    public string $ublVersion = '2.1';

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'note'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    #[Assert\Regex(pattern: '/^[A-Z0-9]{1,4}$/')]
    public ?string $serie = null;

    #[Assert\NotBlank]
    public string|int|null $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 2)]
    public ?string $tipoDocAfectado = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $numeroDocAfectado = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $codMotivo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public ?string $descripcionMotivo = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?ReceptorDto $receptor = null;

    #[Assert\Valid]
    public ?FormaPagoDto $formaPago = null;

    #[Assert\Valid]
    public ?PercepcionVentaDto $percepcion = null;

    /**
     * @var list<DocumentoReferenciaDto>
     */
    #[Assert\All([
        new Assert\Type(type: DocumentoReferenciaDto::class),
    ])]
    #[Assert\Valid]
    public array $guias = [];

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

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?TotalesDto $totales = null;
}
