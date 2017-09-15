<?php

namespace ArcaSolutions\MultiDomainBundle\DependencyInjection;

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
        $rootNode = $treeBuilder->root('multi_domain');

        $rootNode
            ->children()
                ->arrayNode('hosts')
                ->isRequired()
                ->prototype('array')
                    ->children()
                        ->integerNode('id')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifNull()
                                ->thenInValid("IP cannot be empty")
                            ->end()
                        ->end()
                        ->scalarNode('path')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifNull()
                                ->thenInValid('Path cannot be empty')
                            ->end()
                        ->end()
                        ->scalarNode('template')
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifNull()
                                ->thenInValid('Template cannot be empty')
                            ->end()
                        ->end()
                        ->scalarNode('title')
                        ->end()
                        ->scalarNode('locale')
                            ->cannotBeEmpty()
                            ->isRequired()
                        ->end()
                        ->scalarNode('localized')
                        ->end()
                        ->scalarNode('database')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifNull()
                                ->thenInValid('Database Name cannote be empty')
                            ->end()
                        ->end()
                        ->scalarNode('elastic')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->validate()
                                ->ifNull()
                                ->thenInValid('Elastic Index cannote be empty')
                            ->end()
                        ->end()
                        ->enumNode('branded')
                            ->isRequired()
                            ->cannotBeEmpty()
                            ->values(array('on','off'))
                        ->end()
                    ->end()
            ->end() // hosts
        ;

        return $treeBuilder;
    }
}
