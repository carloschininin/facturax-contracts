<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Resumen;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen\ResumenDiarioDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen\ResumenDiarioRequestDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class ResumenDiarioRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidResumenDiarioPassesValidation(): void
    {
        $detalle = new ResumenDiarioDetalleDto();
        $detalle->tipoDoc = '03';
        $detalle->serieNro = 'B001-123';
        $detalle->clienteTipo = '1';
        $detalle->clienteNro = '45879632';
        $detalle->estado = '1';
        $detalle->total = 118;
        $detalle->mtoOperGravadas = 100;
        $detalle->mtoOperInafectas = 0;
        $detalle->mtoOperExoneradas = 0;
        $detalle->mtoOperExportacion = 0;
        $detalle->mtoOperGratuitas = 0;
        $detalle->mtoOtrosCargos = 0;
        $detalle->mtoIGV = 18;
        $detalle->mtoIvap = 0;
        $detalle->mtoISC = 0;
        $detalle->mtoOtrosTributos = 0;
        $detalle->mtoIcbper = 0;

        $dto = new ResumenDiarioRequestDto();
        $dto->correlativo = '1';
        $dto->fechaGeneracion = '2026-04-02';
        $dto->fechaResumen = '2026-04-03';
        $dto->detalles = [$detalle];

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(0, $violations);
    }

    public function testInvalidResumenDiarioFailsValidation(): void
    {
        $detalle = new ResumenDiarioDetalleDto();
        $detalle->tipoDoc = '01';
        $detalle->serieNro = null;

        $dto = new ResumenDiarioRequestDto();
        $dto->correlativo = '';
        $dto->fechaGeneracion = 'no-date';
        $dto->fechaResumen = '';
        $dto->detalles = [$detalle];

        $violations = $this->createValidator()->validate($dto);

        self::assertGreaterThan(0, \count($violations));
    }
}

