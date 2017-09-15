<?php
namespace ArcaSolutions\WebBundle\Controller;

use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;

/**
 * Class CustomPageController
 *
 * @package ArcaSolutions\WebBundle\Controller
 */
class CustomPageController extends Controller
{
    /**
     * @param $friendlyUrl
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws NotFoundHttpException Content page not found
     */
    public function indexAction($friendlyUrl)
    {
        $doctrine = $this->get('doctrine');

        /* get custom page type id */
        $pageType = $doctrine->getRepository('WysiwygBundle:PageType')->findOneBy(['title' => Wysiwyg::CUSTOM_PAGE]);

        /* gets page */
        $page = $doctrine->getRepository('WysiwygBundle:Page')->findOneBy([
            'url'     => $friendlyUrl,
            'pageTypeId' => $pageType->getId()
        ]);

        if (is_null($page)) {
            throw $this->createNotFoundException('Content not found');
        }

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }
}
