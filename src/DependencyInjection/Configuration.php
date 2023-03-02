<?php
declare(strict_types=1);

namespace Black\SyliusBannerPlugin\DependencyInjection;

use Sylius\Bundle\ResourceBundle\Controller\ResourceController;
use Sylius\Bundle\ResourceBundle\SyliusResourceBundle;
use Sylius\Component\Resource\Factory\Factory;
use Symfony\Component\Config\Definition\Builder\ArrayNodeDefinition;
use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;
use Black\SyliusBannerPlugin\UI\Form\Type\BannerType;
use Black\SyliusBannerPlugin\UI\Form\Type\SlideTranslationType;
use Black\SyliusBannerPlugin\UI\Form\Type\SlideType;
use Black\SyliusBannerPlugin\Entity\Banner;
use Black\SyliusBannerPlugin\Entity\BannerInterface;
use Black\SyliusBannerPlugin\Entity\Slide;
use Black\SyliusBannerPlugin\Entity\SlideInterface;
use Black\SyliusBannerPlugin\Entity\SlideTranslation;
use Black\SyliusBannerPlugin\Entity\SlideTranslationInterface;

/**
 * @psalm-suppress UnusedVariable
 * @psalm-suppress PossiblyNullReference
 * @psalm-suppress MixedMethodCall
 * @psalm-suppress UnusedMethodCall
 * @psalm-suppress PossiblyUndefinedMethod
 */
final class Configuration implements ConfigurationInterface
{
    /**
     * @psalm-suppress UnusedVariable
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress MixedMethodCall
     * @psalm-suppress UnusedMethodCall
     * @psalm-suppress PossiblyUndefinedMethod
     */
    public function getConfigTreeBuilder(): TreeBuilder
    {
        $treeBuilder = new TreeBuilder('black_sylius_banner_plugin');
        /** @var ArrayNodeDefinition $rootNode */
        $rootNode = $treeBuilder->getRootNode();

        $rootNode
            ->addDefaultsIfNotSet()
            ->children()
                ->scalarNode('driver')->defaultValue(SyliusResourceBundle::DRIVER_DOCTRINE_ORM)->end()
            ->end();

        $this->addResourcesSection($rootNode);

        return $treeBuilder;
    }

    /**
     * @psalm-suppress UnusedVariable
     * @psalm-suppress PossiblyNullReference
     * @psalm-suppress MixedMethodCall
     * @psalm-suppress UnusedMethodCall
     * @psalm-suppress PossiblyUndefinedMethod
     */
    private function addResourcesSection(ArrayNodeDefinition $node): void
    {
        $node
            ->children()
                ->arrayNode('resources')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->arrayNode('banner')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                    ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(Banner::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(BannerInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(BannerType::class)->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                        ->arrayNode('slide')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->variableNode('options')->end()
                                ->arrayNode('classes')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('model')->defaultValue(Slide::class)->cannotBeEmpty()->end()
                                        ->scalarNode('interface')->defaultValue(SlideInterface::class)->cannotBeEmpty()->end()
                                        ->scalarNode('controller')->defaultValue(ResourceController::class)->end()
                                        ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                        ->scalarNode('form')->defaultValue(SlideType::class)->end()
                                    ->end()
                                ->end()
                                ->arrayNode('translation')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->variableNode('options')->end()
                                        ->arrayNode('classes')
                                            ->addDefaultsIfNotSet()
                                            ->children()
                                                ->scalarNode('model')->defaultValue(SlideTranslation::class)->cannotBeEmpty()->end()
                                                ->scalarNode('interface')->defaultValue(SlideTranslationInterface::class)->cannotBeEmpty()->end()
                                                ->scalarNode('factory')->defaultValue(Factory::class)->end()
                                                ->scalarNode('form')->defaultValue(SlideTranslationType::class)->end()
                                            ->end()
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end();
    }
}
