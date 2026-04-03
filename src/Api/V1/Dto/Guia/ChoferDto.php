<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoIdentidadCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ChoferDto
{
    #[Assert\Length(max: 2)]
    public ?string $tipo = null;

    #[Assert\Choice(callback: [TipoDocumentoIdentidadCatalog::class, 'all'])]
    public ?string $tipoDoc = null;

    #[Assert\Length(max: 20)]
    public ?string $nroDoc = null;

    #[Assert\Length(max: 255)]
    public ?string $nombres = null;

    #[Assert\Length(max: 255)]
    public ?string $apellidos = null;

    #[Assert\Length(max: 30)]
    public ?string $licencia = null;
}
