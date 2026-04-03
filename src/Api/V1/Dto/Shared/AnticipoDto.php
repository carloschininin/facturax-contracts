<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class AnticipoDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 2)]
    public ?string $tipoDocRel = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $nroDocRel = null;

    #[Assert\NotNull]
    #[Assert\PositiveOrZero]
    public ?float $total = null;
}
