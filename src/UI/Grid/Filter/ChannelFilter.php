<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\UI\Grid\Filter;

use Sylius\Component\Grid\Data\DataSourceInterface;
use Sylius\Component\Grid\Filtering\FilterInterface;
use Webmozart\Assert\Assert;

class ChannelFilter implements FilterInterface
{
    public function apply(DataSourceInterface $dataSource, string $name, $data, array $options): void
    {
        Assert::isArray($data);
        Assert::keyExists($data, 'channel');

        $dataSource->restrict($dataSource->getExpressionBuilder()->equals('o.channel.code', $data['channel']));
    }
}
