<?php

namespace Elcweb\SalesforceBundle\DependencyInjection;

use Symfony\Component\Config\Definition\Builder\TreeBuilder;
use Symfony\Component\Config\Definition\ConfigurationInterface;

/**
 * This is the class that validates and 
 * merges configuration from your app/config files
 */
class Configuration implements ConfigurationInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfigTreeBuilder()
    {
        $treeBuilder = new TreeBuilder();
        $rootNode = $treeBuilder->root('elcweb_salesforce');

        $rootNode
            ->children()
                ->scalarNode('wsdl')->end()
                ->scalarNode('username')->end()
                ->scalarNode('password')->end()
                ->scalarNode('token')->end()
                ->scalarNode('ttl')->defaultValue(14400)->end()
            ->end();

        return $treeBuilder;
    }
}
