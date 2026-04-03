<?php

declare(strict_types=1);

/*
 * This file is part of the CarlosChininin Facturax Contracts package.
 */

use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $container): void {
    $services = $container->services()
        ->defaults()
        ->autowire()
        ->autoconfigure();

    $services->load('CarlosChininin\\FacturaxContracts\\', '../src/')
        ->exclude([
            '../src/Api/V1/Dto/',
            '../src/DependencyInjection/',
            '../src/CarlosChinininFacturaxContractsBundle.php',
        ]);
};

