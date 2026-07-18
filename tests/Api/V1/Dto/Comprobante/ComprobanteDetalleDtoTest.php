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

    #[DataProvider('codigosSunatInvalidos')]
    public function testCodigoSunatConFormatoInvalidoGeneraViolacion(string $codigo): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoSunat = $codigo;

        $violaciones = $this->createValidator()->validate($detalle);

        self::assertCount(1, $violaciones);
        self::assertSame('codigoSunat', $violaciones->get(0)->getPropertyPath());
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function codigosSunatInvalidos(): iterable
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

    #[DataProvider('codigosGs1Invalidos')]
    public function testCodigoGs1ConFormatoInvalidoGeneraViolacion(string $codigo): void
    {
        $detalle = $this->createDetalleValido();
        $detalle->codigoGs1 = $codigo;

        $violaciones = $this->createValidator()->validate($detalle);

        self::assertCount(1, $violaciones);
        self::assertSame('codigoGs1', $violaciones->get(0)->getPropertyPath());
    }

    /**
     * @return iterable<string, array{string}>
     */
    public static function codigosGs1Invalidos(): iterable
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
