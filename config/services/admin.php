<?php

declare(strict_types=1);

use Black\SyliusBannerPlugin\UI\Form\Type\ChannelFilterType;
use Black\SyliusBannerPlugin\UI\Grid\Filter\ChannelFilter;
use Black\SyliusBannerPlugin\UI\Menu\AdminMenuListener;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('black_sylius_banner.ui.menu.admin_menu_listener', AdminMenuListener::class)
        ->tag('kernel.event_listener', [
            'event' => 'sylius.menu.admin.main',
            'method' => 'addAdminMenuItems'
        ]);

    $services
        ->set('black_sylius_banner.grid.filter.channel', ChannelFilter::class)
        ->tag('sylius.grid_filter', [
            'type' => 'banner_channel',
            'form_type' => ChannelFilterType::class
        ]);
};
