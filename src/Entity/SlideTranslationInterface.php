<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Sylius\Component\Resource\Model\ResourceInterface;
use Sylius\Component\Resource\Model\TranslationInterface;

interface SlideTranslationInterface extends TranslationInterface, ResourceInterface
{
    public function setContent(?string $content): void;

    public function getContent(): ?string;

    public function getLink(): ?string;

    public function setLink(?string $link): void;
}
