<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoIdentidadCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class ReceptorDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(callback: [TipoDocumentoIdentidadCatalog::class, 'all'])]
    public ?string $tipoDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $numDoc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 255)]
    public ?string $razonSocial = null;

    #[Assert\Length(max: 255)]
    public ?string $nombreComercial = null;

    #[Assert\Valid]
    public ?DireccionDto $address = null;

    #[Assert\Email]
    #[Assert\Length(max: 255)]
    public ?string $email = null;

    #[Assert\Length(max: 30)]
    public ?string $telephone = null;
}

