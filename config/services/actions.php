<?php

declare(strict_types=1);

use Black\SyliusBannerPlugin\UI\Action\ShowBannerAction;
use Black\SyliusBannerPlugin\UI\Menu\AdminMenuListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('black_sylius_banner.ui.menu.admin_menu_listener', AdminMenuListener::class)
        ->tag('kernel.event_listener', [
            'event' => 'sylius.menu.admin.main',
            'method' => 'addAdminMenuItems'
        ]);

    $services
        ->set('black_sylius_banner.ui.action.show_banner', ShowBannerAction::class)
        ->args([
            service('black_sylius_banner.front_repository.banner'),
            service('sylius.context.channel'),
            service('twig')
        ])
        ->tag('controller.service_arguments');
};
