<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Guia;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Guia\GuiaRemisionDetalleDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class GuiaRemisionDetalleDtoTest extends TestCase
{
    use CreatesValidator;

    public function testDetalleSinCodigosSunatEsValido(): void
    {
        self::assertCount(0, $this->createValidator()->validate($this->createDetalleValido()));
    }

    public function testDetalleConCodProdSunatLegadoSigueSiendoValido(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codProdSunat = '10101500';

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    public function testDetalleConCodProdSunatLegadoNoConformeSigueSiendoValido(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codProdSunat = 'ABC123';

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    public function testCodigoSunatNuloNoGeneraViolaciones(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoSunat = null;

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    public function testCodigoSunatConOchoDigitosEsValido(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoSunat = '10101500';

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    /**
     * El formato UNSPSC de 8 dígitos NO se exige todavía (ver docblock del DTO):
     * los emisores en producción envían códigos alfanuméricos libres y deben
     * seguir siendo aceptados.
     */
    #[DataProvider('codigosSunatFueraDelFormatoUnspsc')]
    public function testCodigoSunatFueraDelFormatoUnspscSigueSiendoValido(string $codigo): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoSunat = $codigo;

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function codigosSunatFueraDelFormatoUnspsc(): iterable
    {
        yield 'letras' => ['ABC'];
        yield 'muy corto' => ['1234'];
        yield 'muy largo' => ['123456789'];
        yield 'alfanumerico de ocho caracteres' => ['1010150A'];
    }

    private function createDetalleValido(): GuiaRemisionDetalleDto
    {
        $detalle = new GuiaRemisionDetalleDto();
        $detalle->codigo = 'P001';
        $detalle->descripcion = 'Producto';
        $detalle->unidad = 'ZZ';
        $detalle->cantidad = 1;

        return $detalle;
    }
}
