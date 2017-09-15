<?php

namespace ArcaSolutions\ReportsBundle\Services;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\ArticleBundle\Entity\ReportArticle;
use ArcaSolutions\BlogBundle\Entity\Post;
use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\ClassifiedBundle\Entity\ReportClassified;
use ArcaSolutions\DealBundle\Entity\Promotion;
use ArcaSolutions\DealBundle\Entity\ReportPromotion;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\EventBundle\Entity\ReportEvent;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\ReportsBundle\Entity\ReportBanner;
use ArcaSolutions\ReportsBundle\Entity\ReportListing;
use ArcaSolutions\BlogBundle\Entity\ReportPost;
use ArcaSolutions\ReportsBundle\Entity\ReportStatistic;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use Symfony\Component\DependencyInjection\Container;

class ReportHandler
{
    const ARTICLE_SUMMARY = 1;
    const ARTICLE_DETAIL = 2;

    const BANNER_CLICK = 1;
    const BANNER_VIEW = 2;

    const CLASSIFIED_SUMMARY = 1;
    const CLASSIFIED_DETAIL = 2;

    const DEAL_SUMMARY = 1;
    const DEAL_DETAIL = 2;

    const EVENT_SUMMARY = 1;
    const EVENT_DETAIL = 2;

    const LISTING_SUMMARY = 1;
    const LISTING_DETAIL = 2;
    const LISTING_CLICK = 3;
    const LISTING_EMAIL = 4;
    const LISTING_PHONE = 5;
    const LISTING_FAX = 6;
    const LISTING_SMS = 7;
    const LISTING_CLICK_CALL = 8;

    const POST_SUMMARY = 1;
    const POST_DETAIL = 2;

    const SEARCH_SECTION_ARTICLE = 'a';
    const SEARCH_SECTION_BLOG = 'p';
    const SEARCH_SECTION_CLASSIFIED = 'c';
    const SEARCH_SECTION_DEAL = 'd';
    const SEARCH_SECTION_EVENT = 'e';
    const SEARCH_SECTION_LISTING = 'l';
    const SEARCH_SECTION_GLOBAL = 'h';

    /**
     * @var Container
     */
    private $container;

    /**
     * @param $container
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function addListingReport($listingId, $type, $amount = 1)
    {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("ReportsBundle:ReportListing");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "listingId"  => $listingId,
                    "date"       => new \DateTime(),
                    "reportType" => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportListing();
                    $report->setListingId($listingId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::LISTING_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('ListingBundle:Listing')->find($listingId), ParameterHandler::MODULE_LISTING);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create listing report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    /**
     * Increase column of number view in every module's table
     *
     * @param Listing|Classified|Promotion|Article|Post|Event $item
     *
     * @param string $module The module must be one of the ParameterHandler module constants
     */
    private function increaseNumberViews($item, $module)
    {
        $doctrine = $this->container->get("doctrine");

        $item->setNumberViews($item->getNumberViews() + 1);

        $doctrine->getManager()->flush($item);

        $this->container->get($module.".synchronization")->addUpsert($item->getId());
    }

    public function addEventReport($eventId, $type, $amount = 1)
    {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {

            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("EventBundle:ReportEvent");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "eventId"    => $eventId,
                    "date"       => new \DateTime(),
                    "reportType" => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportEvent();
                    $report->setEventId($eventId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::EVENT_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('EventBundle:Event')->find($eventId), ParameterHandler::MODULE_EVENT);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create event report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addArticleReport($articleId, $type, $amount = 1)
    {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("ArticleBundle:ReportArticle");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "articleId"  => $articleId,
                    "date"       => new \DateTime(),
                    "reportType" => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportArticle();
                    $report->setArticleId($articleId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::ARTICLE_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('ArticleBundle:Article')->find($articleId), ParameterHandler::MODULE_ARTICLE);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create article report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addClassifiedReport($classifiedId, $type, $amount = 1)
    {
        $return = false;


        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("ClassifiedBundle:ReportClassified");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "classifiedId" => $classifiedId,
                    "date"         => new \DateTime(),
                    "reportType"   => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportClassified();
                    $report->setClassifiedId($classifiedId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::CLASSIFIED_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('ClassifiedBundle:Classified')
                        ->find($classifiedId), ParameterHandler::MODULE_CLASSIFIED);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create classified report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addBannerReport($bannerId, $type, $amount = 1)
    {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("ReportsBundle:ReportBanner");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "bannerId"   => $bannerId,
                    "date"       => new \DateTime(),
                    "reportType" => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportBanner();
                    $report->setBannerId($bannerId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create banner report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addPostReport($postId, $type, $amount = 1)
    {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("BlogBundle:ReportPost");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "postId"     => $postId,
                    "date"       => new \DateTime(),
                    "reportType" => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportPost();
                    $report->setPostId($postId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::POST_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('BlogBundle:Post')->find($postId), ParameterHandler::MODULE_BLOG);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create post report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addDealReport($promotionId, $type, $amount = 1)
    {
        $return = false;


        if (!$this->container->get("utility")->isRobotUser()) {
            try {
                $doctrine = $this->container->get("doctrine");

                $repository = $doctrine->getRepository("DealBundle:ReportPromotion");

                $date = new \DateTime();

                $report = $repository->findOneBy([
                    "promotionId" => $promotionId,
                    "date"        => new \DateTime(),
                    "reportType"  => $type
                ]);

                if ($report) {
                    $report->setReportAmount($report->getReportAmount() + $amount);
                } else {
                    $report = new ReportPromotion();
                    $report->setPromotionId($promotionId);
                    $report->setReportType($type);
                    $report->setReportAmount($amount);
                    $report->setDate($date);
                }

                /* Increases column of number views in module's table if it's detail page */
                if ($type == $this::DEAL_DETAIL) {
                    $this->increaseNumberViews($doctrine->getRepository('DealBundle:Promotion')->find($promotionId), ParameterHandler::MODULE_DEAL);
                }

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create deal report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addCategorySearchReport($module, $categoryId)
    {
        return $this->addSearchReport($module, null, null, $categoryId);
    }

    public function addSearchReport(
        $module,
        $keyword = "",
        $where = null,
        $categoryId = null,
        $location1 = null,
        $location2 = null,
        $location3 = null,
        $location4 = null,
        $location5 = null
    ) {
        $return = false;

        if (!$this->container->get("utility")->isRobotUser()) {
            if ($keyword === null) {
                $keyword = " ";
            }

            try {
                $doctrine = $this->container->get("doctrine");

                $date = new \DateTime();
                $report = new ReportStatistic();

                $report->setModule($module);
                $report->setSearchDate($date);

                $report->setKeyword((string)$keyword);
                $where and $report->setSearchWhere((string)$where);
                $categoryId and $report->setCategoryId((int)$categoryId);
                $location1 and $report->setLocation1((int)$location1);
                $location2 and $report->setLocation2((int)$location2);
                $location3 and $report->setLocation3((int)$location3);
                $location4 and $report->setLocation4((int)$location4);
                $location5 and $report->setLocation5((int)$location5);

                $doctrine->getManager()->persist($report);
                $doctrine->getManager()->flush($report);

                $return = true;
            } catch (\Exception $e) {
                $this->container->get("logger")->error("Unable to create search report.", ["Exception" => $e]);
            }
        }

        return $return;
    }

    public function addKeywordSearchReport($module, $keyword, $where = null)
    {
        return $this->addSearchReport($module, $keyword, $where);
    }

    public function addLocationSearchReport(
        $module,
        $where = null,
        $location1 = null,
        $location2 = null,
        $location3 = null,
        $location4 = null,
        $location5 = null
    ) {
        return $this->addSearchReport(
            $module,
            null,
            $where,
            null,
            $location1,
            $location2,
            $location3,
            $location4,
            $location5
        );
    }

    /**
     * Creates Summary Report
     *
     * @param null $items
     * @return bool
     */
    public function addSummaryReport($items = null)
    {
        if (null === $items) {
            return false;
        }

        foreach ($items as $item) {
            switch ($item->getType()) {
                case 'listing':
                    $this->addListingReport($item->getId(), static::LISTING_SUMMARY);
                    break;
                case 'classified':
                    $this->addClassifiedReport($item->getId(), static::CLASSIFIED_SUMMARY);
                    break;
                case 'event':
                    $this->addEventReport($item->getId(), static::EVENT_SUMMARY);
                    break;
                case 'article':
                    $this->addArticleReport($item->getId(), static::ARTICLE_SUMMARY);
                    break;
                case 'deal':
                    $this->addDealReport($item->getId(), static::DEAL_SUMMARY);
                    break;
                case 'blog':
                    $this->addPostReport($item->getId(), static::POST_SUMMARY);
            }
        }
    }

    /**
     * @param string $module
     * @return string
     */
    public function getReportModule($module)
    {
        switch ($module) {
            case "article":
                $return = ReportHandler::SEARCH_SECTION_ARTICLE;
                break;
            case "blog":
                $return = ReportHandler::SEARCH_SECTION_BLOG;
                break;
            case "classified":
                $return = ReportHandler::SEARCH_SECTION_CLASSIFIED;
                break;
            case "listing":
                $return = ReportHandler::SEARCH_SECTION_LISTING;
                break;
            case "event":
                $return = ReportHandler::SEARCH_SECTION_EVENT;
                break;
            case "promotion":
            case "deal":
                $return = ReportHandler::SEARCH_SECTION_DEAL;
                break;
            case "global":
            default:
                $return = ReportHandler::SEARCH_SECTION_GLOBAL;
                break;
        }

        return $return;
    }
}
