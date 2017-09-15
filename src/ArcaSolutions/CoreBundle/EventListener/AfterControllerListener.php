<?php
namespace ArcaSolutions\CoreBundle\EventListener;

use Symfony\Component\HttpKernel\Event\FilterResponseEvent;

/**
 * Class AfterControllerListener
 * @package ArcaSolutions\CoreBundle\EventListener
 */
class AfterControllerListener
{
    /**
     * Call it after a controller in every request
     *
     * @param FilterResponseEvent $event
     */
    public function onKernelResponse(FilterResponseEvent $event)
    {
        $response = $event->getResponse();

        // IE Ajax
        $response->headers->set('Pragma','no-cache');

        $response->prepare($event->getRequest());
    }
}
