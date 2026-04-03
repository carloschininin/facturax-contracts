<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Reversion;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Reversion\ReversionDetalleDto;
use CarlosChininin\FacturaxContracts\Api\V1\Dto\Reversion\ReversionRequestDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\TestCase;

final class ReversionRequestDtoTest extends TestCase
{
    use CreatesValidator;

    public function testValidReversionRequestPassesValidation(): void
    {
        $detalle = new ReversionDetalleDto();
        $detalle->tipoDoc = '20';
        $detalle->serie = 'R001';
        $detalle->correlativo = '122';
        $detalle->motivo = 'ERROR DE SISTEMA';

        $dto = new ReversionRequestDto();
        $dto->correlativo = '001';
        $dto->fechaGeneracion = '2026-04-01';
        $dto->fechaComunicacion = '2026-04-03';
        $dto->detalles = [$detalle];

        self::assertCount(0, $this->createValidator()->validate($dto));
    }
}
