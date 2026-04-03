<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ComunicacionBajaDetalleDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'baja'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    #[Assert\Regex(pattern: '/^[A-Z0-9]{1,4}$/')]
    public ?string $serie = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 300)]
    public ?string $motivo = null;
}

