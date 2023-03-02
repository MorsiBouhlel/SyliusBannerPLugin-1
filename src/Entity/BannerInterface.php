<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Doctrine\Common\Collections\Collection;
use Sylius\Component\Channel\Model\ChannelInterface;
use Sylius\Component\Resource\Model\CodeAwareInterface;
use Sylius\Component\Resource\Model\ResourceInterface;

interface BannerInterface extends ResourceInterface, CodeAwareInterface
{
    public function getId(): ?int;

    /**
     * @return Collection<int, ChannelInterface>
     */
    public function getChannels(): Collection;

    /**
     * @return Collection<int, SlideInterface>
     */
    public function getSlides(): Collection;
}
