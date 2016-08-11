<?php

namespace Tmk\DruidBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and merges configuration from your app/config files.
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/configuration.html}
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritdoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('tmk_druid');

        $rootNode
            ->children()
                ->scalarNode('scheme')
                    ->defaultValue('http')
                ->end()
                ->scalarNode('host')
                    ->defaultValue('localhost')
                ->end()
                ->scalarNode('port')
                    ->defaultValue('8082')
                ->end()
                ->scalarNode('path')
                    ->defaultValue('/druid/v2')
                ->end()
                ->scalarNode('proxy')
                    ->defaultNull()
                ->end();

        return $treeBuilder;
    }
}
