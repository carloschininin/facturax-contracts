<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Comprobante;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteRequestDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\DireccionDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\ReceptorDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Shared\TotalesDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class ComprobanteRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidComprobanteRequestPassesValidation(): void
    {
        $direccion = new DireccionDto();
        $direccion->direccion = 'Av. Lima 123';

        $receptor = new ReceptorDto();
        $receptor->tipoDoc = '6';
        $receptor->numDoc = '20100039207';
        $receptor->razonSocial = 'EMPRESA RECEPTORA SAC';
        $receptor->address = $direccion;

        $detalle = new ComprobanteDetalleDto();
        $detalle->cantidad = 2;
        $detalle->unidad = 'NIU';
        $detalle->descripcion = 'Producto ejemplo';
        $detalle->precioUnitario = 118;
        $detalle->valorUnitario = 100;
        $detalle->igv = 36;
        $detalle->subtotal = 200;
        $detalle->tipoAfectacionIgv = '10';

        $totales = new TotalesDto();
        $totales->gravadas = 200;
        $totales->igv = 36;
        $totales->importeTotal = 236;

        $dto = new ComprobanteRequestDto();
        $dto->tipoDoc = '01';
        $dto->serie = 'F001';
        $dto->correlativo = 1234;
        $dto->fechaEmision = '2026-04-02';
        $dto->receptor = $receptor;
        $dto->detalle = [$detalle];
        $dto->totales = $totales;

        $violations = $this->createValidator()->validate($dto);

        self::assertCount(0, $violations);
    }

    public function testInvalidComprobanteRequestFailsValidation(): void
    {
        $dto = new ComprobanteRequestDto();
        $dto->tipoDoc = '99';
        $dto->serie = '';
        $dto->correlativo = null;
        $dto->fechaEmision = '2026-99-99';
        $dto->detalle = [];

        $violations = $this->createValidator()->validate($dto);
        $paths = [];

        foreach ($violations as $violation) {
            $paths[] = $violation->getPropertyPath();
        }

        self::assertNotEmpty($violations);
        self::assertContains('tipoDoc', $paths);
        self::assertContains('serie', $paths);
        self::assertContains('correlativo', $paths);
        self::assertContains('fechaEmision', $paths);
        self::assertContains('detalle', $paths);
    }
}

