<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\WebBundle\Entity\Timeline;
use Symfony\Component\DependencyInjection\Container;

class TimelineHandler
{
    //region Item Type Constants
    const ITEMTYPE_ACCOUNT = "account";
    const ITEMTYPE_ARTICLE = "article";
    const ITEMTYPE_BANNER = "banner";
    const ITEMTYPE_CLAIM = "claim";
    const ITEMTYPE_CLASSIFIED = "classified";
    const ITEMTYPE_EVENT = "event";
    const ITEMTYPE_INVOICE = "invoice";
    const ITEMTYPE_LEAD = "lead";
    const ITEMTYPE_LISTING = "listing";
    const ITEMTYPE_NEWSLETTER = "newsletter";
    const ITEMTYPE_PROMOTION = "promotion";
    const ITEMTYPE_REVIEW = "review";
    const ITEMTYPE_TRANSACTION = "transaction";
    //endregion

    //region Action Constants
    const ACTION_EDIT = "edit";
    const ACTION_NEW = "new";
    //endregion

    /**
     * @var Container
     */
    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    public function add($itemId, $itemType, $action)
    {
        if ($itemType && $action && $itemId) {
            $timelineItem = new Timeline();
            $timelineItem->setItemId($itemId);
            $timelineItem->setItemType($itemType);
            $timelineItem->setAction($action);
            $timelineItem->setNew("y");

            $em = $this->container->get("doctrine")->getManager();
            $em->persist($timelineItem);
            $em->flush();
        }
    }
}
