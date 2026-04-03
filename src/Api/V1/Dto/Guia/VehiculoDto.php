<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use Symfony\Component\Validator\Constraints as Assert;

final class VehiculoDto
{
    #[Assert\Length(max: 20)]
    public ?string $placa = null;

    #[Assert\Length(max: 30)]
    public ?string $nroCirculacion = null;

    #[Assert\Length(max: 20)]
    public ?string $codEmisor = null;

    #[Assert\Length(max: 30)]
    public ?string $nroAutorizacion = null;

    /** @var list<string> */
    public array $secundarios = [];
}
