<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Nota;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Nota\NotaRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\LeyendaDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TotalesDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class NotaRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidNotaRequestPassesValidation(): void
    {
        $receptor = new ReceptorDto();
        $receptor->tipoDoc = '6';
        $receptor->numDoc = '20100039207';
        $receptor->razonSocial = 'EMPRESA RECEPTORA SAC';

        $detalle = new ComprobanteDetalleDto();
        $detalle->unidad = 'NIU';
        $detalle->cantidad = 2;
        $detalle->descripcion = 'PROD 1';
        $detalle->valorUnitario = 50;
        $detalle->baseIgv = 100;
        $detalle->porcentajeIgv = 18;
        $detalle->igv = 18;
        $detalle->tipoAfectacionIgv = '10';

        $leyenda = new LeyendaDto();
        $leyenda->code = '1000';
        $leyenda->value = 'SON DOSCIENTOS TREINTA Y SEIS CON 00/100 SOLES';

        $totales = new TotalesDto();
        $totales->gravadas = 200;
        $totales->igv = 36;
        $totales->importeTotal = 236;

        $dto = new NotaRequestDto();
        $dto->tipoDoc = '07';
        $dto->serie = 'FC01';
        $dto->correlativo = '123';
        $dto->fechaEmision = '2026-04-03';
        $dto->tipoDocAfectado = '01';
        $dto->numeroDocAfectado = 'F001-111';
        $dto->codMotivo = '07';
        $dto->descripcionMotivo = 'DEVOLUCION';
        $dto->receptor = $receptor;
        $dto->detalle = [$detalle];
        $dto->leyendas = [$leyenda];
        $dto->totales = $totales;

        self::assertCount(0, $this->createValidator()->validate($dto));
    }
}
