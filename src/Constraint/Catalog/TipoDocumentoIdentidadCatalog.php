<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

namespace CarlosChininin\FacturaxContracts\Constraint\Catalog;

final class TipoDocumentoIdentidadCatalog
{
    /**
     * @return list<string>
     */
    public static function all(): array
    {
        return ['0', '1', '4', '6', '7', 'A', 'B', 'C', 'D'];
    }
}

