<?php

namespace ArcaSolutions\CoreBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Reference;

class OverrideRecaptchaCompilerPass implements CompilerPassInterface
{
    /**
     * @var string
     */
    private $reCaptcha = 'ewz_recaptcha.validator.true';

    /**
     * You can modify the container here before it is dumped to PHP code.
     *
     * @param ContainerBuilder $container
     */
    public function process(ContainerBuilder $container)
    {
        if ($container->hasDefinition($this->reCaptcha)) {
            $recaptcha = $container->getDefinition($this->reCaptcha);
            $recaptcha->addArgument(new Reference('settings'));
        }
    }
}
