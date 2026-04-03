<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

final class TipoDocumentoCatalog
{
    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return ['01', '03', '07', '08', '09', '20', '40'];
    }

    /**
     * @return list<string>
     */
    public static function sale(): array
    {
        return ['01', '03'];
    }

    /**
     * @return list<string>
     */
    public static function note(): array
    {
        return ['07', '08'];
    }

    /**
     * @return list<string>
     */
    public static function resumen(): array
    {
        return ['03', '07', '08'];
    }

    /**
     * @return list<string>
     */
    public static function baja(): array
    {
        return ['01', '03', '07', '08'];
    }

    /**
     * @return list<string>
     */
    public static function despatch(): array
    {
        return ['09'];
    }

    /**
     * @return list<string>
     */
    public static function reversion(): array
    {
        return ['20', '40'];
    }
}
