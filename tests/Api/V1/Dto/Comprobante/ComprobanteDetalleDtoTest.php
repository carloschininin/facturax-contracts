<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Tests\Api\V1\Dto\Comprobante;

use CarlosChininin\FacturaxContracts\Api\V1\Dto\Comprobante\ComprobanteDetalleDto;
use CarlosChininin\FacturaxContracts\Tests\Support\CreatesValidator;
use PHPUnit\Framework\Attributes\DataProvider;
use PHPUnit\Framework\TestCase;

final class ComprobanteDetalleDtoTest extends TestCase
{
    use CreatesValidator;

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

    public function testCodigoGs1NuloNoGeneraViolaciones(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoGs1 = null;

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    #[DataProvider('codigosGs1Validos')]
    public function testCodigoGs1ConLongitudGtinEsValido(string $codigo): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoGs1 = $codigo;

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function codigosGs1Validos(): iterable
    {
        yield 'gtin-8' => ['12345670'];
        yield 'gtin-12' => ['123456789012'];
        yield 'gtin-13' => ['1234567890128'];
        yield 'gtin-14' => ['12345678901231'];
    }

    /**
     * El formato GTIN tampoco se exige todavía: se documenta el comportamiento
     * laxo actual para que un endurecimiento futuro sea un cambio explícito.
     */
    #[DataProvider('codigosGs1FueraDelFormatoGtin')]
    public function testCodigoGs1FueraDelFormatoGtinSigueSiendoValido(string $codigo): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoGs1 = $codigo;

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function codigosGs1FueraDelFormatoGtin(): iterable
    {
        yield 'diez digitos' => ['1234567890'];
        yield 'once digitos' => ['12345678901'];
        yield 'quince digitos' => ['123456789012345'];
        yield 'no numerico' => ['ABCDEFGH'];
    }

    public function testCodigoInternoNoSigueElFormatoSunat(): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigo = 'PROD-001';

        self::assertCount(0, $this->createValidator()->validate($detalle));
    }

    private function createDetalleValido(): ComprobanteDetalleDto
    {
        $detalle = new ComprobanteDetalleDto();
        $detalle->cantidad = 2;
        $detalle->unidad = 'NIU';
        $detalle->descripcion = 'Producto ejemplo';
        $detalle->valorUnitario = 100;
        $detalle->igv = 36;
        $detalle->subtotal = 200;
        $detalle->tipoAfectacionIgv = '10';

        return $detalle;
    }
}
