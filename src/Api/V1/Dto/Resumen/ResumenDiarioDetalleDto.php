<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DocumentoReferenciaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\PercepcionDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\EstadoResumenCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoIdentidadCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ResumenDiarioDetalleDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'resumen'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $serieNro = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoIdentidadCatalog::class, 'all'])]
    public ?string $clienteTipo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $clienteNro = null;

    /**
     * Apellidos y nombres, denominación o razón social del adquiriente (campo 10.3 del resumen diario,
     * RS 000048-2026/SUNAT). Opcional: desde el 01/01/2027 SUNAT lo exige si la boleta tiene ese dato.
     */
    #[Assert\Length(max: 250)]
    public ?string $clienteNombre = null;

    #[Assert\Valid]
    public ?DocumentoReferenciaDto $docReferencia = null;

    #[Assert\Valid]
    public ?PercepcionDto $percepcion = null;

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [EstadoResumenCatalog::class, 'all'])]
    public ?string $estado = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $total = null;

    #[Assert\PositiveOrZero]
    public ?float $porcentajeIgv = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOperGravadas = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOperInafectas = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOperExoneradas = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOperExportacion = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOperGratuitas = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOtrosCargos = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoIGV = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoIvap = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoISC = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoOtrosTributos = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $mtoIcbper = null;
}

