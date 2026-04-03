<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use CarlosChininin\FacturaxContracts\Constraint\Catalog\MonedaCatalog;
use Symfony\Component\Validator\Constraints as Assert;

final class FormaPagoDto
{
    #[Assert\NotBlank]
    #[Assert\Choice(choices: ['CONTADO', 'CREDITO'])]
    public ?string $tipo = null;

    #[Assert\Choice(callback: [MonedaCatalog::class, 'all'])]
    public string $moneda = 'PEN';

    #[Assert\PositiveOrZero]
    public ?float $monto = null;

    /**
     * @var list<CuotaDto>
     */
    #[Assert\All([
        new Assert\Type(type: CuotaDto::class),
    ])]
    #[Assert\Valid]
    public array $cuotas = [];
}
