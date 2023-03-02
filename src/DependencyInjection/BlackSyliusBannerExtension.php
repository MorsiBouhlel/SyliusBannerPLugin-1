<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\DependencyInjection;

use Sylius\Bundle\ResourceBundle\DependencyInjection\Extension\AbstractResourceExtension;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader\PhpFileLoader;
use Webmozart\Assert\Assert;

final class BlackSyliusBannerExtension extends AbstractResourceExtension
{
    /**
     * @psalm-suppress UnusedVariable
     */
    public function load(array $configs, ContainerBuilder $container): void
    {
        $config = $this->processConfiguration($this->getConfiguration([], $container), $configs);
        $loader = new PhpFileLoader($container, new FileLocator(__DIR__ . '/../../config'));

        Assert::string($config['driver']);
        Assert::isArray($config['resources']);

        $this->registerResources('black_sylius_banner', $config['driver'], $config['resources'], $container);

        $loader->load('services.php');
    }

    public function getConfiguration(array $config, ContainerBuilder $container): ConfigurationInterface
    {
        return new Configuration();
    }
}
