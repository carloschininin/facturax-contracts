<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

final class TipoAfectacionIgvCatalog
{
    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return [
            '10', '11', '12', '13', '14', '15', '16', '17',
            '20', '21',
            '30', '31', '32', '33', '34', '35', '36', '37',
            '40',
        ];
    }
}

