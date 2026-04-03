<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DireccionDto;
use Symfony\Component\Validator\Constraints as Assert;

final class EnvioGuiaDto
{
    #[Assert\NotBlank]
    #[Assert\Length(max: 4)]
    public ?string $codTraslado = null;

    #[Assert\Length(max: 255)]
    public ?string $desTraslado = null;

    #[Assert\Length(max: 100)]
    public ?string $sustentoPeso = null;

    public ?bool $indTransbordo = null;

    /** @var list<string> */
    public array $indicadores = [];

    #[Assert\PositiveOrZero]
    public ?float $pesoItems = null;

    #[Assert\PositiveOrZero]
    public ?float $pesoTotal = null;

    #[Assert\Length(max: 10)]
    public ?string $undPesoTotal = null;

    #[Assert\PositiveOrZero]
    public ?int $numBultos = null;

    #[Assert\Length(max: 4)]
    public ?string $modTraslado = null;

    #[Assert\Date]
    public ?string $fechaTraslado = null;

    #[Assert\Length(max: 50)]
    public ?string $numContenedor = null;

    /** @var list<string> */
    public array $contenedores = [];

    #[Assert\Length(max: 10)]
    public ?string $codPuerto = null;

    #[Assert\Length(max: 255)]
    public ?string $puerto = null;

    #[Assert\Length(max: 255)]
    public ?string $aeropuerto = null;

    #[Assert\Valid]
    public ?TransportistaDto $transportista = null;

    #[Assert\Valid]
    public ?VehiculoDto $vehiculo = null;

    /**
     * @var list<ChoferDto>
     */
    #[Assert\All([
        new Assert\Type(type: ChoferDto::class),
    ])]
    #[Assert\Valid]
    public array $choferes = [];

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?DireccionDto $llegada = null;

    #[Assert\NotNull]
    #[Assert\Valid]
    public ?DireccionDto $partida = null;
}
