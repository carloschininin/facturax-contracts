<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Baja;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja\ComunicacionBajaDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja\ComunicacionBajaRequestDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class ComunicacionBajaRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidComunicacionBajaPassesValidation(): void
    {
        $detalle = new ComunicacionBajaDetalleDto();
        $detalle->tipoDoc = '01';
        $detalle->serie = 'F001';
        $detalle->correlativo = '123';
        $detalle->motivo = 'Error en datos del receptor';

        $dto = new ComunicacionBajaRequestDto();
        $dto->correlativo = '1';
        $dto->fechaGeneracion = '2026-04-03';
        $dto->fechaBaja = '2026-04-02';
        $dto->detalles = [$detalle];

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(0, $violations);
    }

    public function testInvalidComunicacionBajaFailsValidation(): void
    {
        $dto = new ComunicacionBajaRequestDto();
        $dto->correlativo = null;
        $dto->fechaGeneracion = 'invalid';
        $dto->fechaBaja = '';
        $dto->detalles = [];

        $violations = $this->createValidator()->validate($dto);

        self::assertGreaterThan(0, \count($violations));
    }
}
