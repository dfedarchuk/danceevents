<?php

namespace ArcaSolutions\BlogBundle\Controller;

use ArcaSolutions\BlogBundle\BlogItemDetail;
use ArcaSolutions\BlogBundle\Entity\Blogcategory;
use ArcaSolutions\BlogBundle\Entity\BlogCategory1;
use ArcaSolutions\BlogBundle\Entity\Post;
use ArcaSolutions\CoreBundle\Exception\ItemNotFoundException;
use ArcaSolutions\CoreBundle\Exception\UnavailableItemException;
use ArcaSolutions\CoreBundle\Services\ValidationDetail;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use ArcaSolutions\SearchBundle\Entity\Elasticsearch\Category;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WysiwygBundle\Services\Wysiwyg;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_BLOG);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::BLOG_HOME_PAGE);

        return $this->render('::base.html.twig', [
            'pageId' => $page->getId(),
            'pageTitle' => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords' => $page->getMetaKey(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @param $friendlyUrl
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws UnavailableItemException
     * @throws \Exception
     */
    public function detailAction($friendlyUrl)
    {
        /*
         * Validation
         */
        /* @var $item Post For phpstorm get properties of entity Listing */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'blog', 'BlogBundle:Post');
        /* event not found by friendlyURL */
        if (is_null($item)) {
            throw new ItemNotFoundException();
        }

        /* normalizes item to validate detail */
        $blogItemDetail = new BlogItemDetail($this->container, $item);

        /* validating if listing is enabled, if listing's level is active and if level allows detail */
        if (!ValidationDetail::isDetailAllowed($blogItemDetail)) {
            /* error page */
            throw new UnavailableItemException();
        }

        /*
         * Report
         */
        if (false === ValidationDetail::isSponsorsOrSitemgr($blogItemDetail)) {
            /* Counts the view towards the statistics */
            $this->container->get("reporthandler")->addPostReport($item->getId(), ReportHandler::POST_DETAIL);
        }

        $categoryIds = $categories = [];
        foreach ($item->getCategories()->toArray() as $blogCategory) {
            /* @var $blogCategory BlogCategory1 */
            $categories[] = $blogCategory->getCategory();
            $categoryIds[] = Category::create()
                ->setId($blogCategory->getCategory()->getId())
                ->setModule(ParameterHandler::MODULE_BLOG);
        }

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_BLOG);

        $twig = $this->container->get("twig");

        $twig->addGlobal('bannerCategories', $categoryIds);
        $twig->addGlobal('item', $item);
        $twig->addGlobal('categories', $categories);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::BLOG_DETAIL_PAGE);

        return $this->render('::modules/blog/detail.html.twig', [
            'pageId' => $page->getId(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allcategoriesAction()
    {
        /* Loading and setting wysiwyg */
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_BLOG);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::BLOG_CATEGORIES_PAGE);

        $categories = $this->get('search.repository.category')
            ->findCategoriesWithItens(ParameterHandler::MODULE_BLOG);

        $twig = $this->get('twig');

        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('routing', ParameterHandler::MODULE_BLOG);

        return $this->render('::base.html.twig', [
            'pageId' => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }
}
