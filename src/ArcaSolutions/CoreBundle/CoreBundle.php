<?php

namespace ArcaSolutions\CoreBundle;

use ArcaSolutions\CoreBundle\DependencyInjection\Compiler\OverrideRecaptchaCompilerPass;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\HttpKernel\Bundle\Bundle;

class CoreBundle extends Bundle
{
    public function build(ContainerBuilder $container)
    {
        parent::build($container);

        $container->addCompilerPass(new OverrideRecaptchaCompilerPass());
    }
}
