<?php

use ArcaSolutions\CoreBundle\Kernel\Kernel;

class AppKernel extends Kernel
{
    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = array(
            // Put here your own bundles!
        );

        if (in_array($this->environment, array('dev', 'test'))) {
            $bundles[] = new \Symfony\Bundle\WebProfilerBundle\WebProfilerBundle();
            $bundles[] = new Sensio\Bundle\DistributionBundle\SensioDistributionBundle();
            $bundles[] = new Sensio\Bundle\GeneratorBundle\SensioGeneratorBundle();
            $bundles[] = new Symfony\Bundle\DebugBundle\DebugBundle();
            $bundles[] = new \JMS\DiExtraBundle\JMSDiExtraBundle($this);
            $bundles[] = new \JMS\AopBundle\JMSAopBundle();
        }

        return array_merge(parent::registerBundles(), $bundles);
    }
}
