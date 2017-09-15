<?php

namespace ArcaSolutions\ArticleBundle\Controller;

use ArcaSolutions\ArticleBundle\ArticleItemDetail;
use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ArticleBundle\Entity\Articlecategory;
use ArcaSolutions\ArticleBundle\Sample\ArticleSample;
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
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_ARTICLE);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ARTICLE_HOME_PAGE);

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
     * @throws ItemNotFoundException
     * @throws \Exception
     */
    public function detailAction($friendlyUrl)
    {
        /*
         * Validation
         */
        /* @var $item Article For phpstorm get properties of entity Article */
        $item = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'article', 'ArticleBundle:Article');
        /* event not found by friendlyURL */
        if (is_null($item)) {
            throw new ItemNotFoundException();
        }

        /* normalizes item to validate detail */
        $articleItemDetail = new ArticleItemDetail($this->container, $item);

        /* validating if article is enabled, if article's level is active and if level allows detail */
        if (!ValidationDetail::isDetailAllowed($articleItemDetail)) {
            /* error page */
            throw new UnavailableItemException();
        }

        /*
         * Report
         */
        if (false === ValidationDetail::isSponsorsOrSitemgr($articleItemDetail)) {
            /* Counts the view towards the statistics */
            $this->container->get("reporthandler")->addArticleReport($item->getId(), ReportHandler::ARTICLE_DETAIL);
        }

        /* gets item's gallery */
        $gallery = null;
        if ($articleItemDetail->getLevel()->imageCount > 0) {
            $gallery = $this->get('doctrine')->getRepository('ArticleBundle:Article')
                ->getGallery($item, $articleItemDetail->getLevel()->imageCount);
        }

        /* gets item reviews */
        $reviews = $this->get('doctrine')->getRepository('WebBundle:Review')->findBy([
            'itemType' => 'article',
            'approved' => '1',
            'itemId'   => $item->getId(),
        ], [
            'rating' => 'DESC',
            'added'  => 'DESC',
        ], 3);

        /* Gets total of reviews */
        $reviews_total = $this->get('doctrine')->getRepository('WebBundle:Review')
            ->getTotalByItemId($item->getId(), 'article');

        $reviews_active = $this->getDoctrine()->getRepository('WebBundle:Setting')
            ->getSetting('review_article_enabled');


        /* Gets profile image from main DB */
        if ($account = $item->getAccount()) {
            /* sets profile image manually because doctrine can't make a relationship using tables from another DB  */
            $account->profileImage = $this->get('profile.image.service')->getProfileImage($account);
            $item->setAccount($account);
        }

        $categoryIds = array_map(function ($item) {
            /* @var $item ArticleCategory */
            return Category::create()
                ->setId($item->getId())
                ->setModule(ParameterHandler::MODULE_ARTICLE);
        }, $item->getCategories());

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_ARTICLE);

        $twig = $this->container->get("twig");

        $twig->addGlobal('bannerCategories', $categoryIds);
        $twig->addGlobal('item', $item);
        $twig->addGlobal('level', $articleItemDetail->getLevel());
        $twig->addGlobal('categories', $item->getCategories());
        $twig->addGlobal('gallery', $gallery);
        $twig->addGlobal('reviews_active', $reviews_active);
        $twig->addGlobal('reviews', $reviews);
        $twig->addGlobal('reviews_total', $reviews_total);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ARTICLE_DETAIL_PAGE);

        return $this->render('::modules/article/detail.html.twig', [
            'pageId' => $page->getId(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @param int $level
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     * @throws \Ivory\GoogleMap\Exception\MapException
     * @throws \Ivory\GoogleMap\Exception\OverlayException
     */
    public function sampleDetailAction($level = 0)
    {
        $item = new ArticleSample($level, $this->get("translator"), $this->get('doctrine'));
        $articleItemDetail = new ArticleItemDetail($this->container, $item);

        /* Validates if article has the review active */
        $reviews_active = $this->getDoctrine()->getRepository('WebBundle:Setting')
            ->getSetting('review_article_enabled');

        $twig = $this->container->get("twig");

        $twig->addGlobal('item', $item);
        $twig->addGlobal('level', $articleItemDetail->getLevel());
        $twig->addGlobal('gallery', $item->getGallery($articleItemDetail->getLevel()->imageCount));
        $twig->addGlobal('reviews_active', $reviews_active);
        $twig->addGlobal('reviews', $item->getReviews());
        $twig->addGlobal('reviews_total', $item->getReviewCount());
        $twig->addGlobal('categories', $item->getCategories());
        $twig->addGlobal('isSample', true);

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_ARTICLE);
        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ARTICLE_DETAIL_PAGE);

        return $this->render('::modules/article/detail.html.twig', [
            'pageId' => $page->getId(),
            'customTag' => $page->getCustomTag()
        ]);
    }

    /**
     * @param $friendlyUrl
     * @param $page
     *
     * @return \Symfony\Component\HttpFoundation\Response
     * @throws \Exception
     */
    public function reviewAction($friendlyUrl, $page)
    {
        $page = $this->get("search.engine")->convertFromPaginationFormat($page);

        /* Validates if article has the review active */
        $active = $this->getDoctrine()->getRepository('WebBundle:Setting')->getSetting('review_article_enabled');
        if (is_null($active) or $active == '') {
            throw $this->createNotFoundException('Article has not reviews activated');
        }

        /* Gets article and validation if exist */
        /* @var $article Article For phpstorm get properties of entity article */
        $article = $this->get('search.engine')->itemFriendlyURL($friendlyUrl, 'article', 'ArticleBundle:Article');
        if (is_null($article)) {
            throw $this->createNotFoundException('This Article does not exist');
        }

        /* Gets reviews of article */
        $reviews = $this->getDoctrine()
            ->getRepository('WebBundle:Review')
            ->findBy([
                'itemType' => 'article',
                'approved' => 1,
                'itemId'   => $article->getId(),
            ], ['added' => 'DESC']);

        // Creates the pagination to reviews
        $pagination = $this->get('knp_paginator')->paginate($reviews, $page);

        /* Gets total of reviews */
        $reviews_total = $this->get('doctrine')->getRepository('WebBundle:Review')
            ->getTotalByItemId($article->getId(), 'article');

        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_ARTICLE);

        $twig = $this->container->get("twig");

        $twig->addGlobal('review', $article);
        $twig->addGlobal('reviews_total', $reviews_total);
        $twig->addGlobal('pagination', $pagination);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ARTICLE_REVIEWS);

        return $this->render('::base.html.twig', [
            'pageId'          => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function allcategoriesAction()
    {
        /* Loading and setting wysiwyg */
        $this->get('wysiwyg.service')->setModule(ParameterHandler::MODULE_ARTICLE);

        $page = $this->container->get('doctrine')->getRepository('WysiwygBundle:Page')->getPageByType(Wysiwyg::ARTICLE_CATEGORIES_PAGE);

        $categories = $this->get('search.repository.category')
            ->findCategoriesWithItens(ParameterHandler::MODULE_ARTICLE);

        $twig = $this->get('twig');

        $twig->addGlobal('categories', $categories);
        $twig->addGlobal('routing', ParameterHandler::MODULE_ARTICLE);

        return $this->render('::base.html.twig', [
            'pageId' => $page->getId(),
            'pageTitle'       => $page->getTitle(),
            'metaDescription' => $page->getMetaDescription(),
            'metaKeywords'    => $page->getMetaKey(),
            'customTag'       => $page->getCustomTag(),
        ]);
    }
}
