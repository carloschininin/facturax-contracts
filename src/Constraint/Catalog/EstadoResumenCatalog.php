<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

final class EstadoResumenCatalog
{
    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return ['1', '2', '3'];
    }
}

