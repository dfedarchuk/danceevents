<?php

namespace ArcaSolutions\CoreBundle\EventListener;

use ArcaSolutions\CoreBundle\Kernel\Kernel;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Entity\Page;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\GetResponseForExceptionEvent;
use Symfony\Component\HttpKernel\Exception\HttpExceptionInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class DefaultExceptionListener
 *
 * @package eDirectory
 * @subpackage CoreBundle
 * @category Core
 * @author Matheus <matheus.faustino@arcasolutions.com>
 * @author Lucas Trentim <lucas.trentim@arcasolutions.com>
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 * @author Fernando Nascimento <fernando.nascimento@arcasolutions.com>
 * @copyright ArcaSolutions Inc.
 * @version 1.2.0
 * @since File available since Release 11.0.00
 */
class DefaultExceptionListener
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
     * Sets response with custom error page
     * Every exception that is not handled before will drop here and finish with default error page
     *
     * @param GetResponseForExceptionEvent $event
     */
    public function onKernelException(GetResponseForExceptionEvent $event)
    {
        $exception = $event->getException();
        $request = $event->getRequest();

        /*
         * Saves error messages in log files
         * It helps with debug
         */
        $logger = $this->container->get('logger');
        if (!$exception instanceof NotFoundHttpException) {
            $message = $exception->getMessage().' in File: '.$exception->getFile().':'.$exception->getLine();
            $logger->critical($message, ['defaultException']);
        }

        if (!(Kernel::ENV_PROD == $this->kernel->getEnvironment()) or
            ($request->attributes->get('media_type') == 'application/json')
        ) {
            return;
        }

        $response = new Response($this->container->get('twig')->render(':pages:error-500.html.twig'));

        if ($exception instanceof HttpExceptionInterface) {
            if ($exception->getStatusCode() != Response::HTTP_INTERNAL_SERVER_ERROR) {
                /* Disables the 404 error to next occurrences */
                ParameterHandler::setException(false);

                /* Sets Banners type with 'general' */
                $this->container->get('wysiwyg.service')->setModuleBanner(null);

                /* @var $page Page */
                $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ERROR404_PAGE);
                $response->setContent($this->container->get('twig')->render('::base.html.twig', [
                    'title'     => $page->getTitle(),
                    'pageId'    => $page->getId(),
                    'pageTitle' => $page->getTitle(),
                ]));
            }

            $response->setStatusCode($exception->getStatusCode());
            $response->headers->replace($exception->getHeaders());
        } else {
            $response->setStatusCode(Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $event->setResponse($response);
    }
}
