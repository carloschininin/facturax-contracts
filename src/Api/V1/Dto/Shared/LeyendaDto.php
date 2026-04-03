<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class LeyendaDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $code = null;

    #[Assert\NotBlank]
    #[Assert\Length(max: 500)]
    public ?string $value = null;
}
