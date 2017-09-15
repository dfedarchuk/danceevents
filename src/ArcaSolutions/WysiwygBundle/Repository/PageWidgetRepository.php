<?php

namespace ArcaSolutions\WysiwygBundle\Repository;

use Doctrine\ORM\EntityRepository;

/**
 * Class PageWidgetRepository
 * @package ArcaSolutions\WysiwygBundle\Repository
 */
class PageWidgetRepository extends EntityRepository
{
    /**
     * @param integer $pageId
     * @param integer $themeId
     * @return \Doctrine\ORM\QueryBuilder
     */
    public function DeletePageWidgetByPageId($pageId, $themeId)
    {
        return $this->createQueryBuilder('pw')
            ->delete('WysiwygBundle:PageWidget', 'pw')
            ->where('pw.pageId = :pageId AND pw.themeId = :themeId')
            ->setParameters(
                [
                    'pageId'  => $pageId,
                    'themeId' => $themeId,
                ]
            )
            ->getQuery()
            ->execute();
    }

    /**
     * @param $pageId
     * @param $themeId
     * @return mixed
     */
    public function findLastOrder($pageId, $themeId)
    {
        $lastOrder = $this->createQueryBuilder('pw')
            ->select('Max(pw.order)')
            ->where('pw.pageId = :pageId AND pw.themeId = :themeId')
            ->setParameters(
                [
                    'pageId'  => $pageId,
                    'themeId' => $themeId,
                ]
            )
            ->getQuery()
            ->getOneOrNullResult();

        $lastOrder = current($lastOrder) + 1;

        return $lastOrder;
    }

    /**
     * @param $widgetIds
     * @param $pageId
     * @param $themeId
     * @return array
     */
    public function getPageWidgetIdByWidgetId($widgetIds, $pageId, $themeId)
    {
        return $this->createQueryBuilder('p')
            ->select('p.id')
            ->where('p.widgetId IN (:widgetIds)')
            ->andWhere('p.themeId = :themeId')
            ->andWhere('p.pageId = :pageId')
            ->setParameter('pageId', $pageId)
            ->setParameter('themeId', $themeId)
            ->setParameter('widgetIds', $widgetIds)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param $widgetId
     * @param $themeId
     * @param $content
     * @return mixed
     */
    public function updateWidgetContentForAllPages($widgetId, $themeId, $content)
    {
        return $this->createQueryBuilder('p')
            ->update()
            ->set('p.content', ':content')
            ->where('p.widgetId = :widgetId')
            ->andWhere('p.themeId = :themeId')
            ->setParameter('widgetId', $widgetId)
            ->setParameter('themeId', $themeId)
            ->setParameter('content', $content)
            ->getQuery()
            ->execute();
    }

    /**
     * @param $widgetType
     * @param $widgetId
     * @param $themeId
     * @return array
     */
    public function getPageWidgetByTypeOfAllPages($widgetType, $widgetId, $themeId)
    {
        return $this->createQueryBuilder('pw')
            ->leftJoin('pw.widget', 'w')
            ->where('pw.themeId = :themeId')
            ->andWhere('w.type = :widgetType')
            ->andWhere('pw.widgetId <> :widgetId')
            ->setParameter('widgetType', $widgetType)
            ->setParameter('widgetId', $widgetId)
            ->setParameter('themeId', $themeId)
            ->getQuery()
            ->getResult();
    }

    /**
     * @param null $pageId integer
     * @param null $widgetTitle string
     * @param null $themeId integer
     * @return array
     */
    public function getPageWithWidget($pageId = null, $widgetTitle = null, $themeId = null)
    {
        return  $this->createQueryBuilder('pw')
            ->leftJoin('pw.widget', 'w')
            ->where('w.title LIKE :widgetTitle')
            ->andWhere('pw.pageId = :pageId')
            ->andWhere('pw.themeId = :themeId')
            ->setParameter('widgetTitle', '%'.$widgetTitle.'%')
            ->setParameter('pageId', $pageId)
            ->setParameter('themeId', $themeId)
            ->getQuery()
            ->getResult();
    }

}
