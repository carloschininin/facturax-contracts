<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class DocumentoReferenciaDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoCatalog::class, 'all'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $nroDoc = null;
}

