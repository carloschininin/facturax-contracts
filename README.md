# carloschininin/facturax-contracts

Contratos DTO versionados para la API de Facturax, con **Bundle Symfony opcional** para registrar servicios de validación y normalización.

## Objetivo

Este package permite que:

- **Facturax** valide localmente los payloads antes de persistirlos y mapearlos a Greenter.
- **Los sistemas cliente** construyan y validen el JSON antes de invocar la API.

El contrato público está desacoplado de `Greenter\Model\*`, pero conserva la semántica necesaria para mapearse internamente a Greenter.

## Requisitos

- PHP 8.5+
- Symfony 8.x

## Instalación

```bash
composer require carloschininin/facturax-contracts
```

## Bundle Symfony opcional

Si el proyecto consumidor usa Symfony, puede registrar el bundle:

```php
<?php

return [
    CarlosChininin\FacturaxContracts\CarlosChinininFacturaxContractsBundle::class => ['all' => true],
];
```

Servicios incluidos:

- `CarlosChininin\FacturaxContracts\Service\ContractValidator`
- `CarlosChininin\FacturaxContracts\Service\ContractNormalizer`

## Familias de contratos actuales

### Venta
- `Api\V1\Dto\Comprobante\ComprobanteRequestDto`
- `Api\V1\Dto\Nota\NotaRequestDto`

### Resúmenes y anulaciones
- `Api\V1\Dto\Resumen\ResumenDiarioRequestDto`
- `Api\V1\Dto\Baja\ComunicacionBajaRequestDto`
- `Api\V1\Dto\Reversion\ReversionRequestDto`

### Logística
- `Api\V1\Dto\Guia\GuiaRemisionRequestDto`

### Retención / percepción
- `Api\V1\Dto\Percepcion\PercepcionRequestDto`
- `Api\V1\Dto\Retencion\RetencionRequestDto`

### Objetos compartidos
- receptor / dirección
- totales
- forma de pago / cuotas
- cargos / descuentos
- leyendas
- anticipos
- detracción
- percepción de venta
- pagos / tipo de cambio
- atributos de detalle

## Ejemplos JSON

Ver `docs/examples/v1/`:

- `comprobante-factura.json`
- `nota-credito.json`
- `resumen-diario.json`
- `comunicacion-baja.json`
- `guia-remision.json`
- `percepcion.json`
- `retencion.json`
- `reversion.json`

## Testing

```bash
composer install
vendor/bin/phpunit
```

## Notas

- Los DTOs están versionados por namespace en `Api\V1\Dto\...`.
- El emisor autenticado, credenciales SOL, certificados y endpoints SUNAT/OSE **no** forman parte del contrato público.
- El package cubre las familias principales usadas en `thegreenter/demo/examples` para entrada de documentos.
