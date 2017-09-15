<?php

namespace ArcaSolutions\SearchBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html#cookbook-bundles-extension-config-class}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('search');

        $rootNode
            ->children()
                ->arrayNode('elasticsearch')
                    ->children()
                        ->arrayNode('servers')
                            ->isRequired()
                            ->requiresAtLeastOneElement()
                            ->prototype('array')
                                ->children()
                                    ->integerNode('port')
                                        ->isRequired()
                                        ->cannotBeEmpty()
                                    ->end()
                                    ->scalarNode('host')
                                        ->isRequired()
                                        ->cannotBeEmpty()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('settings')
                    ->addDefaultsIfNotSet()
                    ->children()
                        ->scalarNode('randomizationInterval')
                            ->defaultValue("20 minutes")
                        ->end()
                        ->scalarNode('defaultSearchResultSize')
                            ->defaultValue(10)
                        ->end()
                        ->scalarNode('locationUnit')
                            ->defaultValue('mi')
                        ->end()
                        ->scalarNode('aggregationSize')
                            ->defaultValue(100)
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('map')
                    ->children()
                        ->arrayNode('icons')
                            ->addDefaultsIfNotSet()
                            ->children()
                                ->scalarNode('iconPath')
                                    ->defaultValue("assets/icons/")
                                ->end()
                                ->scalarNode('classified')
                                    ->defaultValue(null)
                                ->end()
                                ->scalarNode('deal')
                                    ->defaultValue(null)
                                ->end()
                                ->scalarNode('event')
                                    ->defaultValue(null)
                                ->end()
                                ->scalarNode('listing')
                                    ->defaultValue(null)
                                ->end()
                                ->arrayNode('group')
                                    ->addDefaultsIfNotSet()
                                    ->children()
                                        ->scalarNode('url')
                                            ->defaultValue(null)
                                        ->end()
                                        ->scalarNode('textColor')
                                            ->defaultValue(null)
                                        ->end()
                                        ->scalarNode('height')
                                            ->defaultValue(null)
                                        ->end()
                                        ->scalarNode('width')
                                            ->defaultValue(null)
                                        ->end()
                                    ->end()
                                ->end()
                            ->end()
                        ->end()
                    ->end()
                ->end()
                ->arrayNode('seo')
                    ->children()
                        ->arrayNode('friendlyUrlOrder')
                            ->defaultValue(["category", "location", "keyword"])
                            ->prototype('scalar')
                            ->end()
                        ->end()
                    ->end()
                ->end()
            ->end()
        ;

        return $treeBuilder;
    }
}
