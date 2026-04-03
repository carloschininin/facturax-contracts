<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use Symfony\Component\Validator\Constraints as Assert;

final class DocumentoAdicionalDto
{
    #[Assert\Length(max: 50)]
    public ?string $tipoDesc = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 10)]
    public ?string $tipo = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 30)]
    public ?string $nro = null;

    #[Assert\Length(max: 20)]
    public ?string $emisor = null;
}
