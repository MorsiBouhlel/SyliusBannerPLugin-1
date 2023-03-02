<?php

/*
 * This file is part of the Sylius package.
 *
 * (c) Paweł Jędrzejewski
 *
 * For the full copyright and license information, please view the Sylius LICENSE
 * file that was distributed with this source code.
 */

declare(strict_types=1);

namespace Black\SyliusBannerPlugin\EventListener;

use Black\SyliusBannerPlugin\Entity\SlideInterface;
use Symfony\Component\EventDispatcher\GenericEvent;
use Black\SyliusBannerPlugin\Entity\BannerInterface;
use Black\SyliusBannerPlugin\Uploader\SlideUploaderInterface;
use Webmozart\Assert\Assert;

final class SlidesUploadListener
{
    private SlideUploaderInterface $uploader;

    public function __construct(SlideUploaderInterface $uploader)
    {
        $this->uploader = $uploader;

    }

    public function uploadSlides(GenericEvent $event): void
    {
        $subject = $event->getSubject();
        Assert::isInstanceOf($subject, BannerInterface::class);

        $this->uploadSubjectSlides($subject);
    }

    private function uploadSubjectSlides(BannerInterface $subject): void
    {
        $slides = $subject->getSlides();

        foreach ($slides as $slide) {
            if ($slide->hasFile()) {
                $this->uploader->upload($slide);
            }

            if (null === $slide->getPath()) {
                $slides->removeElement($slide);
            }
        }
    }
}
