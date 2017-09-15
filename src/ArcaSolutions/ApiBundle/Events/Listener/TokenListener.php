<?php

namespace ArcaSolutions\ApiBundle\Events\Listener;


use ArcaSolutions\ApiBundle\Controller\TokenAuthenticatedController;
use ArcaSolutions\CoreBundle\Kernel\Kernel;
use Symfony\Component\HttpKernel\Event\FilterControllerEvent;
use Symfony\Component\HttpKernel\Exception\AccessDeniedHttpException;
use Symfony\Component\HttpKernel\KernelInterface;

class TokenListener
{
    private $tokens;

    private $environment;

    public function __construct($tokens, KernelInterface $kernel)
    {
        $this->tokens = $tokens;
        $this->environment = $kernel->getEnvironment();
    }

    public function onKernelController(FilterControllerEvent $event)
    {
        $controller = $event->getController();

        if (!is_array($controller)) {
            return;
        }

        if ($controller[0] instanceof TokenAuthenticatedController) {
            $token = $event->getRequest()->query->get('token');
            if (!in_array($token, $this->tokens) and $this->environment !== Kernel::ENV_DEV) {
                throw new AccessDeniedHttpException('Authentication Required');
            }
        }
    }

}
