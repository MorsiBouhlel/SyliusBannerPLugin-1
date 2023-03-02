<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Doctrine\ORM\Mapping as ORM;

trait BannerChannel
{
    /**
     * @ORM\OneToOne(targetEntity="Black\SyliusBannerPlugin\Entity\BannerInterface", mappedBy="channel")
     */
    protected ?BannerInterface $banner;

    public function getBanner(): ?BannerInterface
    {
        return $this->banner;
    }
}
