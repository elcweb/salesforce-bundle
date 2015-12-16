<?php

namespace Elcweb\SalesforceBundle\DependencyInjection;

use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 */
class ElcwebSalesforceExtension extends Extension
{
    /**
     * {@inheritDoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $prefix = 'elcweb.salesforce.soap.config.';
        foreach (['wsdl', 'username', 'password', 'token', 'ttl'] as $elem) {
            $container->setParameter($prefix.$elem, $config[$elem]);
        }

        $container->setAlias('elcweb.salesforce.config', 'elcweb.salesforce.config.parameter');

        $loader = new Loader\YamlFileLoader(
            $container,
            new FileLocator(__DIR__.'/../Resources/config')
        );
        $loader->load('services.yml');

        if ($config['keyvaluestore']) {
            $loader->load('keyvaluestore.yml');
            $container->setAlias('elcweb.salesforce.config', 'elcweb.salesforce.config.keyvaluestore');
        }
    }
}
