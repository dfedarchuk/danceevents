<?php

namespace ArcaSolutions\MultiDomainBundle\DependencyInjection;

use ArcaSolutions\MultiDomainBundle\HttpFoundation\MultiDomainRequest;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\Config\FileLocator;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;
use Symfony\Component\DependencyInjection\Loader;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link
 * http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class MultiDomainExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

        $domains = array();
        foreach ($config['hosts'] as $host => $hostConfig) {
            $domains[$host] = $hostConfig;
        }
        ksort($domains);
        $container->setParameter('multi_domain.config', $domains);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(array(
            __DIR__ . '/../Resources/config',
            __DIR__ . '/../../../../app/config/domains'
        )));
        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'multi_domain';
    }
}
