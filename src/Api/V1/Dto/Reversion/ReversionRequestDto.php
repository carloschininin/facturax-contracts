<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Reversion;

use Symfony\Component\Validator\Constraints as Assert;

final class ReversionRequestDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 20)]
    public ?string $correlativo = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaGeneracion = null;

    #[Assert\NotBlank]
    #[Assert\Date]
    public ?string $fechaComunicacion = null;

    /**
     * @var list<ReversionDetalleDto>
     */
    #[Assert\NotNull]
    #[Assert\Count(min: 1)]
    #[Assert\All([
        new Assert\Type(type: ReversionDetalleDto::class),
    ])]
    #[Assert\Valid]
    public ?array $detalles = null;
}
