<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Menu;

use Sylius\Bundle\UiBundle\Menu\Event\MenuBuilderEvent;
use Webmozart\Assert\Assert;

final class AdminMenuListener
{
    public function addAdminMenuItems(MenuBuilderEvent $event): void
    {
        $menu = $event->getMenu();
        $marketing = $menu->getChild('marketing');
        Assert::notNull($marketing);

        $marketing
            ->addChild('banners', [
                'route' => 'black_sylius_banner_admin_banner_index'
            ])
            ->setLabel('black_sylius_banner.ui.banners')
            ->setLabelAttribute('icon', 'picture');
    }
}
