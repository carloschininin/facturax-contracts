<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

/**
 * Valores admitidos en la liquidación de compra electrónica (tipo 04).
 */
final class LiquidacionCompraCatalog
{
    /**
     * Catálogo 51: por ahora solo 0501 (compra interna). 0502 (anticipos) y 0503 (oro) exigen datos que el
     * contrato aún no tiene.
     *
     * @return list<string>
     */
    public static function tipoOperacion(): array
    {
        return ['0501'];
    }

    /**
     * Catálogo 06: el vendedor no tiene RUC. DNI (1), carné de extranjería (4) o pasaporte (7).
     *
     * @return list<string>
     */
    public static function tipoDocumentoVendedor(): array
    {
        return ['1', '4', '7'];
    }

    /**
     * Catálogo 07 admitido: gravado (10), exonerado (20) o inafecto (30), operaciones onerosas.
     *
     * @return list<string>
     */
    public static function tipoAfectacionIgv(): array
    {
        return ['10', '20', '30'];
    }
}
