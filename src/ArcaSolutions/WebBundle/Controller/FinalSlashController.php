<?php

namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class FinalSlashController extends Controller
{
    /**
     * Remove the trailing slash in an url
     *
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function removeTrailingSlashAction(Request $request)
    {
        $pathInfo = $request->getPathInfo();
        $requestUri = $request->getRequestUri();

        $url = str_replace($pathInfo, rtrim($pathInfo, ' /'), $requestUri);

        return $this->redirect($url, 301);
    }

    /**
     * Send error 404 when image is not found
     *
     * @return Response
     */
    public function lastRouteAction()
    {
        $this->get('wysiwyg.service')->setModule('');

        $twig = $this->container->get("twig");

        $twig->addGlobal('contentType', Wysiwyg::ERROR404_PAGE);

        $response = new Response();

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ERROR404_PAGE);


        return $response->create($this->renderView('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]), 404);
    }
}
