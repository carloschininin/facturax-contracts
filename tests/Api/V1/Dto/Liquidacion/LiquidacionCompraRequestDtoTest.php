<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Liquidacion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion\LiquidacionCompraDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion\LiquidacionCompraRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion\LiquidacionCompraTotalesDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion\UbicacionLiquidacionDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Liquidacion\VendedorLiquidacionDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class LiquidacionCompraRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testLiquidacionExoneradaConRetencionIrEsValida(): void
    {
        self::assertCount(0, $this->createValidator()->validate($this->liquidacion()));
    }

    public function testSerieDebeEmpezarConL(): void
    {
        $dto = $this->liquidacion();
        $dto->serie = 'E001';

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(1, $violations);
        self::assertSame('serie', $violations[0]->getPropertyPath());
    }

    public function testVendedorConRucNoSeAcepta(): void
    {
        $dto = $this->liquidacion();
        $dto->vendedor->tipoDoc = '6';

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(1, $violations);
        self::assertSame('vendedor.tipoDoc', $violations[0]->getPropertyPath());
    }

    public function testLugarDeOperacionEsObligatorio(): void
    {
        $dto = $this->liquidacion();
        $dto->lugarOperacion = null;

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(1, $violations);
        self::assertSame('lugarOperacion', $violations[0]->getPropertyPath());
    }

    public function testCondicionDelDomicilioSigueElCatalogo60(): void
    {
        $dto = $this->liquidacion();
        $dto->vendedor->domicilio->condicion = '09';

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(1, $violations);
        self::assertSame('vendedor.domicilio.condicion', $violations[0]->getPropertyPath());
    }

    private function liquidacion(): LiquidacionCompraRequestDto
    {
        $domicilio = new UbicacionLiquidacionDto();
        $domicilio->ubigeo = '060801';
        $domicilio->direccion = 'CASERIO LA PALMA S/N';
        $domicilio->condicion = '02';

        $vendedor = new VendedorLiquidacionDto();
        $vendedor->tipoDoc = '1';
        $vendedor->numDoc = '12345678';
        $vendedor->nombres = 'PEREZ GARCIA JUAN';
        $vendedor->domicilio = $domicilio;

        $lugar = new UbicacionLiquidacionDto();
        $lugar->ubigeo = '060801';
        $lugar->direccion = 'AV. PRINCIPAL 123 - ALMACEN JAEN';
        $lugar->condicion = '01';

        $detalle = new LiquidacionCompraDetalleDto();
        $detalle->cantidad = 1000.0;
        $detalle->unidad = 'KGM';
        $detalle->descripcion = 'CAFE PERGAMINO';
        $detalle->valorUnitario = 12.0;
        $detalle->tipoAfectacionIgv = '20';
        $detalle->valorVenta = 12000.0;

        $totales = new LiquidacionCompraTotalesDto();
        $totales->exoneradas = 12000.0;
        $totales->valorVenta = 12000.0;
        $totales->porcentajeRetencionIr = 1.5;
        $totales->retencionIr = 180.0;
        $totales->importeTotal = 12000.0;
        $totales->netoPagar = 11820.0;

        $dto = new LiquidacionCompraRequestDto();
        $dto->tipoDoc = '04';
        $dto->serie = 'L001';
        $dto->correlativo = 1;
        $dto->fechaEmision = '2026-11-17';
        $dto->vendedor = $vendedor;
        $dto->lugarOperacion = $lugar;
        $dto->detalle = [$detalle];
        $dto->totales = $totales;

        return $dto;
    }
}
