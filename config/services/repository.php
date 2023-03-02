<?php

declare(strict_types=1);

use Black\SyliusBannerPlugin\Repository\BannerRepository;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('black_sylius_banner.front_repository.banner', BannerRepository::class)
        ->args([
            service('doctrine'),
            '%black_sylius_banner.model.banner.class%'
        ]);
};
