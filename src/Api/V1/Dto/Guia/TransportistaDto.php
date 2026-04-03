<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\TipoDocumentoIdentidadCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class TransportistaDto
{
    #[Assert\Choice(callback: [TipoDocumentoIdentidadCatalog::class, 'all'])]
    public ?string $tipoDoc = null;

    #[Assert\Length(max: 20)]
    public ?string $numDoc = null;

    #[Assert\Length(max: 255)]
    public ?string $razonSocial = null;

    #[Assert\Length(max: 50)]
    public ?string $nroMtc = null;

    #[Assert\Length(max: 20)]
    public ?string $placa = null;

    #[Assert\Choice(callback: [TipoDocumentoIdentidadCatalog::class, 'all'])]
    public ?string $choferTipoDoc = null;

    #[Assert\Length(max: 20)]
    public ?string $choferDoc = null;
}
