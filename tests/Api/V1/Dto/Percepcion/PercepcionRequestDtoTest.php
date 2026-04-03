<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Percepcion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Percepcion\PercepcionDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Percepcion\PercepcionRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\PagoDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TipoCambioDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class PercepcionRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidPercepcionRequestPassesValidation(): void
    {
        $proveedor = new ReceptorDto();
        $proveedor->tipoDoc = '6';
        $proveedor->numDoc = '20100039207';
        $proveedor->razonSocial = 'EMPRESA PROVEEDORA SAC';

        $pago = new PagoDto();
        $pago->fecha = '2026-04-03';
        $pago->importe = 100;

        $cambio = new TipoCambioDto();
        $cambio->fecha = '2026-04-03';
        $cambio->factor = 1;

        $detalle = new PercepcionDetalleDto();
        $detalle->tipoDoc = '01';
        $detalle->numDoc = 'F001-1';
        $detalle->fechaEmision = '2026-04-02';
        $detalle->fechaPercepcion = '2026-04-03';
        $detalle->impTotal = 200;
        $detalle->impCobrar = 210;
        $detalle->impPercibido = 10;
        $detalle->cobros = [$pago];
        $detalle->tipoCambio = $cambio;

        $dto = new PercepcionRequestDto();
        $dto->serie = 'P001';
        $dto->correlativo = '123';
        $dto->fechaEmision = '2026-04-03';
        $dto->proveedor = $proveedor;
        $dto->regimen = '01';
        $dto->tasa = 2;
        $dto->impPercibido = 10;
        $dto->impCobrado = 210;
        $dto->detalles = [$detalle];

        self::assertCount(0, $this->createValidator()->validate($dto));
    }
}
