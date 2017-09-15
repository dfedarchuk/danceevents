<?php

namespace ArcaSolutions\BannersBundle\DependencyInjection;

use Symfony\Component\Config\FileLocator;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Loader;
use Symfony\Component\HttpKernel\DependencyInjection\Extension;

/**
 * This is the class that loads and manages your bundle configuration
 *
 * To learn more see {@link http://symfony.com/doc/current/cookbook/bundles/extension.html}
 */
class BannersExtension extends Extension
{
    /**
     * {@inheritdoc}
     */
    public function load(array $configs, ContainerBuilder $container)
    {
        $configuration = new Configuration();
        $config = $this->processConfiguration($configuration, $configs);

//        // Creates the parameters to the views of banners
//        foreach ($config['types'] as $theme => $banners) {
//            foreach ($banners as $name => $path) {
//                $container->setParameter($this->getAlias() . '.' . $theme . '.' . $name, $path);
//            }
//        }
//
//        // Parameter of the expiration configuration
//        $container->setParameter($this->getAlias() . '.expiration.impression',
//            $config['default_options']['expiration']['impression']);
//        $container->setParameter($this->getAlias() . '.expiration.renewaldate',
//            $config['default_options']['expiration']['renewal_date']);
//
//        // Parameter of the report configuration
//        $container->setParameter($this->getAlias() . '.report.view', $config['default_options']['report']['view']);
//        $container->setParameter($this->getAlias() . '.report.click', $config['default_options']['report']['click']);

        $loader = new Loader\YamlFileLoader($container, new FileLocator(__DIR__ . '/../Resources/config'));
        $loader->load('config.yml');
        $loader->load('services.yml');
    }

    public function getAlias()
    {
        return 'banners';
    }
}
