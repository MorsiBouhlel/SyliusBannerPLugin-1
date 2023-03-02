<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

interface BannerChannelInterface
{
    public function getBanner(): ?BannerInterface;
}
