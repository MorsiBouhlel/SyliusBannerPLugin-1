<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\Entity;

use Sylius\Component\Resource\Model\TranslatableInterface;
use Sylius\Component\Resource\Model\TranslatableTrait;
use Sylius\Component\Resource\Model\TranslationInterface;

class Slide implements SlideInterface, TranslatableInterface
{
    use TranslatableTrait {
        TranslatableTrait::__construct as private initializeTranslationsCollection;
        TranslatableTrait::getTranslation as private doGetTranslation;
    }

    /** @psalm-suppress PropertyNotSetInConstructor */
    private ?int $id;

    private ?BannerInterface $banner = null;

    private ?\SplFileInfo $file = null;

    private ?string $path = null;

    public function __construct()
    {
        $this->initializeTranslationsCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): void
    {
        $this->id = $id;
    }

    public function getBanner(): ?BannerInterface
    {
        return $this->banner;
    }

    public function setBanner(?BannerInterface $banner): void
    {
        $this->banner = $banner;
    }

    public function getFile(): ?\SplFileInfo
    {
        return $this->file;
    }

    public function setFile(?\SplFileInfo $file): void
    {
        $this->file = $file;
    }

    public function getPath(): ?string
    {
        return $this->path;
    }

    public function setPath(?string $path): void
    {
        $this->path = $path;
    }

    public function hasFile(): bool
    {
        return null !== $this->file;
    }

    public function hasPath(): bool
    {
        return null !== $this->path;
    }

    public function setContent(?string $content): void
    {
        $this->getTranslation()->setContent($content);
    }

    public function getContent(): ?string
    {
        return  $this->getTranslation()->getContent();
    }

    public function setLink(?string $link): void
    {
        $this->getTranslation()->setLink($link);
    }

    public function getLink(): ?string
    {
        return $this->getTranslation()->getLink();
    }

    /**
     * @return SlideTranslationInterface
     */
    public function getTranslation(?string $locale = null): SlideTranslationInterface
    {
        /** @var SlideTranslationInterface $translation */
        $translation = $this->doGetTranslation($locale);

        return $translation;
    }

    protected function createTranslation(): TranslationInterface
    {
        return new SlideTranslation();
    }
}
