<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

/**
 * Catálogo 60 de SUNAT: condición del domicilio del vendedor o del lugar de la operación
 * en la liquidación de compra electrónica.
 */
final class TipoDireccionCatalog
{
    public const string PUNTO_VENTA = '01';
    public const string PRODUCCION = '02';
    public const string EXTRACCION = '03';
    public const string EXPLOTACION = '04';
    public const string OTROS = '05';

    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return [self::PUNTO_VENTA, self::PRODUCCION, self::EXTRACCION, self::EXPLOTACION, self::OTROS];
    }
}
