<?php

namespace ArcaSolutions\BannersBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('banners');

//        $rootNode
//            ->children()
//                ->arrayNode('types')
//                    ->useAttributeAsKey('name')
//                    ->prototype('array')
//                        ->prototype('scalar')->end()
//                    ->end()
//                ->end()
//                ->arrayNode('default_options')
//                    ->addDefaultsIfNotSet()
//                    ->children()
//                        ->arrayNode('expiration')
//                            ->addDefaultsIfNotSet()
//                            ->children()
//                                ->scalarNode('impression')->defaultValue(1)->end()
//                                ->scalarNode('renewal_date')->defaultValue(2)->end()
//                            ->end()
//                    ->end()
//                        ->arrayNode('report')
//                            ->addDefaultsIfNotSet()
//                            ->children()
//                                ->scalarNode('click')->defaultValue(1)->end()
//                                ->scalarNode('view')->defaultValue(2)->end()
//                            ->end()
//                    ->end()
//            ->end();

        return $treeBuilder;
    }
}
