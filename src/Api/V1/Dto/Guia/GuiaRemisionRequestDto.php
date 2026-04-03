<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DocumentoReferenciaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class GuiaRemisionRequestDto
{
    #[Assert\Length(max: 4)]
    public string $version = '2022';

    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'despatch'])]
    public string $tipoDoc = '09';

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    #[Assert\Regex(pattern: '/^[A-Z0-9]{1,4}$/')]
    public ?string $serie = null;

    #[Assert\NotBlank]
    public string|int|null $correlativo = null;

    #[Assert\Length(max: 500)]
    public ?string $observacion = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaEmision = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?ReceptorDto $destinatario = null;

    #[Assert\Valid]
    public ?ReceptorDto $tercero = null;

    #[Assert\Valid]
    public ?ReceptorDto $comprador = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?EnvioGuiaDto $envio = null;

    #[Assert\Valid]
    public ?DocumentoReferenciaDto $docBaja = null;

    #[Assert\Valid]
    public ?DocumentoReferenciaDto $relDoc = null;

    /**
     * @var list<DocumentoAdicionalDto>
     */
    #[Assert\All([
        new Assert\Type(type: DocumentoAdicionalDto::class),
    ])]
    #[Assert\Valid]
    public array $documentosAdicionales = [];

    /**
     * @var list<GuiaRemisionDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: GuiaRemisionDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalles = null;
}
