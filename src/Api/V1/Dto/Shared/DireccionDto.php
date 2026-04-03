<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared;

use Symfony\Component\Validator\Constraints as Assert;

final class DireccionDto
{
    #[Assert\Length(min: 6, max: 6)]
    public ?string $ubigeo = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 2, max: 2)]
    public string $codigoPais = 'PE';

    #[Assert\Length(max: 100)]
    public ?string $departamento = null;

    #[Assert\Length(max: 100)]
    public ?string $provincia = null;

    #[Assert\Length(max: 100)]
    public ?string $distrito = null;

    #[Assert\Length(max: 100)]
    public ?string $urbanizacion = null;

    #[Assert\Length(max: 300)]
    public ?string $direccion = null;

    #[Assert\Length(max: 11)]
    public ?string $ruc = null;

    #[Assert\NotBlank]
    #[Assert\Length(min: 4, max: 4)]
    public string $codLocal = '0000';
}
