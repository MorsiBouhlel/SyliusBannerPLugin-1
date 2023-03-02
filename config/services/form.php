<?php

declare(strict_types=1);

use Black\SyliusBannerPlugin\UI\Form\Type\BannerType;
use Black\SyliusBannerPlugin\UI\Form\Type\ChannelFilterType;
use Black\SyliusBannerPlugin\UI\Form\Type\SlideTranslationType;
use Black\SyliusBannerPlugin\UI\Form\Type\SlideType;
use Symfony\Component\DependencyInjection\Loader\Configurator\ContainerConfigurator;
use function Symfony\Component\DependencyInjection\Loader\Configurator\service;

return static function (ContainerConfigurator $containerConfigurator): void {
    $services = $containerConfigurator->services();

    $services
        ->set('black_sylius_banner.form.type.banner', BannerType::class)
        ->args([
            '%black_sylius_banner.model.banner.class%'
        ])
        ->tag('form.type');

    $services
        ->set('black_sylius_banner.form.type.slide', SlideType::class)
        ->args([
            '%black_sylius_banner.model.slide.class%'
        ])
        ->tag('form.type');

    $services
        ->set('black_sylius_banner.form.type.slide_translation', SlideTranslationType::class)
        ->args([
            '%black_sylius_banner.model.slide_translation.class%'
        ])
        ->tag('form.type');

    $services
        ->set('black_sylius_banner.form.type.channel_filter', ChannelFilterType::class)
        ->args([
            service('sylius.repository.channel')
        ])
        ->tag('form.type');
};
