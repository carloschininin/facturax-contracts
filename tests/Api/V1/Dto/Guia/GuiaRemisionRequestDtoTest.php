<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia\EnvioGuiaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia\GuiaRemisionDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia\GuiaRemisionRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia\TransportistaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DireccionDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class GuiaRemisionRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testDefaultVersionIsLegacyValueCompatibleWithCurrentSunatEndpoint(): void
    {
        $dto = new GuiaRemisionRequestDto();

        self::assertSame('1.0', $dto->version);
    }

    public function testValidGuiaRemisionRequestPassesValidation(): void
    {
        $destinatario = new ReceptorDto();
        $destinatario->tipoDoc = '6';
        $destinatario->numDoc = '20000000002';
        $destinatario->razonSocial = 'EMPRESA DEST 1';

        $partida = new DireccionDto();
        $partida->ubigeo = '150203';
        $partida->direccion = 'AV ITALIA';

        $llegada = new DireccionDto();
        $llegada->ubigeo = '150101';
        $llegada->direccion = 'AV LIMA';

        $transportista = new TransportistaDto();
        $transportista->tipoDoc = '6';
        $transportista->numDoc = '20000000002';
        $transportista->razonSocial = 'TRANSPORTES SAC';

        $envio = new EnvioGuiaDto();
        $envio->codTraslado = '01';
        $envio->modTraslado = '01';
        $envio->fechaTraslado = '2026-04-03';
        $envio->pesoTotal = 12.5;
        $envio->undPesoTotal = 'KGM';
        $envio->partida = $partida;
        $envio->llegada = $llegada;
        $envio->transportista = $transportista;

        $detalle = new GuiaRemisionDetalleDto();
        $detalle->codigo = 'PROD1';
        $detalle->descripcion = 'PROD 1';
        $detalle->unidad = 'ZZ';
        $detalle->cantidad = 2;

        $dto = new GuiaRemisionRequestDto();
        $dto->serie = 'T001';
        $dto->correlativo = '121';
        $dto->fechaEmision = '2026-04-03';
        $dto->destinatario = $destinatario;
        $dto->envio = $envio;
        $dto->detalles = [$detalle];

        self::assertCount(0, $this->createValidator()->validate($dto));
    }
}
