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

namespace Black\SyliusBannerPlugin\Generator;

use Symfony\Component\HttpFoundation\File\UploadedFile;
use Black\SyliusBannerPlugin\Entity\SlideInterface;

final class UploadedSlidePathGenerator implements SlidePathGeneratorInterface
{
    public function generate(SlideInterface $slide): string
    {
        /** @var UploadedFile $file */
        $file = $slide->getFile();

        $hash = bin2hex(random_bytes(16));

        return $this->expandPath($hash . '/' . $file->getClientOriginalName());
    }

    private function expandPath(string $path): string
    {
        return sprintf('%s/%s/%s', substr($path, 0, 2), substr($path, 2, 2), substr($path, 4));
    }
}
