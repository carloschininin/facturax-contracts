<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Service;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja\ComunicacionBajaDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Baja\ComunicacionBajaRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen\ResumenDiarioDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Resumen\ResumenDiarioRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TotalesDto;
use CarlosChininin\FacturaxContracts\Exception\ContractValidationException;
use CarlosChininin\FacturaxContracts\Service\ContractValidator;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class ContractValidatorTest extends TestCase
{
    use CreatesValidator;

    public function testValidateAllowsValidComprobanteContract(): void
    {
        $validator = new ContractValidator($this->createValidator());

        $validator->validate($this->createValidComprobanteDto());

        $this->addToAssertionCount(1);
    }

    public function testValidateRejectsInvalidComprobanteContract(): void
    {
        $validator = new ContractValidator($this->createValidator());
        $dto = $this->createValidComprobanteDto();
        $dto->moneda = 'XXX';
        $dto->detalle = [];

        try {
            $validator->validate($dto);
            self::fail('Se esperaba una ContractValidationException.');
        } catch (ContractValidationException $exception) {
            self::assertSame(
                [
                    'moneda' => ['The value you selected is not a valid choice.'],
                    'detalle' => ['This collection should contain 1 element or more.'],
                ],
                $exception->getErrors(),
            );
        }
    }

    public function testValidateAllowsValidResumenDiarioContract(): void
    {
        $validator = new ContractValidator($this->createValidator());

        $validator->validate($this->createValidResumenDiarioDto());

        $this->addToAssertionCount(1);
    }

    public function testValidateAllowsValidComunicacionBajaContract(): void
    {
        $validator = new ContractValidator($this->createValidator());

        $validator->validate($this->createValidComunicacionBajaDto());

        $this->addToAssertionCount(1);
    }

    private function createValidComprobanteDto(): ComprobanteRequestDto
    {
        $receptor = new ReceptorDto();
        $receptor->tipoDoc = '6';
        $receptor->numDoc = '20100039207';
        $receptor->razonSocial = 'Empresa Receptora SAC';

        $detalle = new ComprobanteDetalleDto();
        $detalle->cantidad = 2;
        $detalle->unidad = 'NIU';
        $detalle->descripcion = 'Producto ejemplo';
        $detalle->valorUnitario = 100;
        $detalle->precioUnitario = 118;
        $detalle->igv = 36;
        $detalle->subtotal = 200;
        $detalle->tipoAfectacionIgv = '10';

        $totales = new TotalesDto();
        $totales->igv = 36;
        $totales->importeTotal = 236;

        $dto = new ComprobanteRequestDto();
        $dto->tipoDoc = '01';
        $dto->serie = 'F001';
        $dto->correlativo = '1234';
        $dto->fechaEmision = '2026-04-02';
        $dto->moneda = 'PEN';
        $dto->receptor = $receptor;
        $dto->detalle = [$detalle];
        $dto->totales = $totales;

        return $dto;
    }

    private function createValidResumenDiarioDto(): ResumenDiarioRequestDto
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
        $dto->moneda = 'PEN';
        $dto->detalles = [$detalle];

        return $dto;
    }

    private function createValidComunicacionBajaDto(): ComunicacionBajaRequestDto
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

        return $dto;
    }
}
