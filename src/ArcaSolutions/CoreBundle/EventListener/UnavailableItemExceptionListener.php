<?php

namespace ArcaSolutions\CoreBundle\EventListener;

use ArcaSolutions\CoreBundle\Exception\UnavailableItemException;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Kernel;

/**
 * Class UnavailableItemExceptionListener
 *
 * @package ArcaSolutions\CoreBundle\EventListener
 */
class UnavailableItemExceptionListener
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Kernel
     */
    private $kernel;

    /**
     * UnavailableItemExceptionListener constructor.
     *
     * @param ContainerInterface $container
     * @param Kernel $kernel
     */
    public function __construct(ContainerInterface $container, Kernel $kernel)
    {
        $this->container = $container;
        $this->kernel = $kernel;
    }

    /**
     * Exclusive exception for UnavailableItemException
     * Called when UnavailableItemException is triggered
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();

        if (!($exception instanceof UnavailableItemException)) {
            return;
        }

        if (!('prod' == $this->kernel->getEnvironment())) {
            return;
        }

        $this->container->get('wysiwyg.service')->setModule('');

        $twig = $this->container->get("twig");

        $twig->addGlobal('contentType', Wysiwyg::ITEM_UNAVAILABLE_PAGE);

        $response = new Response();

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ITEM_UNAVAILABLE_PAGE);

        $event->setResponse($response->create($this->container->get('twig')->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]), 404));
    }
}
