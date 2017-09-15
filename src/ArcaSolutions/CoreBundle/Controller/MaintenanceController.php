<?php

namespace ArcaSolutions\CoreBundle\Controller;

use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class MaintenanceController extends Controller
{
    /**
     * Handle maintenance mode
     * Get content in Content table
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->get('wysiwyg.service')->setModule('');

        $twig = $this->container->get("twig");
        $twig->addGlobal('contentType', Wysiwyg::MAINTENANCE_PAGE);

        $page = $this->container->get('doctrine')
            ->getRepository('WysiwygBundle:Page')
            ->getPageByType(Wysiwyg::MAINTENANCE_PAGE);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }
}
