<?php


namespace ArcaSolutions\WysiwygBundle\Repository;


use Doctrine\ORM\EntityRepository;

class WidgetRepository extends EntityRepository
{
    public function findTypes()
    {
        return $this->createQueryBuilder('p')
            ->select('p.type')
            ->groupBy('p.type')
            ->getQuery()
            ->getResult();
    }

    public function findAllGrouped($pageTypeId, $themeId)
    {
        $groupedResult = [];
        $results = $this->createQueryBuilder('p')
            ->select('p.id', 'p.title', 'p.type')
            ->leftJoin('p.themes', 't')
            ->andWhere('t.themeId = :themeId')
            ->leftJoin('p.widgetPageTypes', 'wpt')
            ->andWhere('wpt.pageTypeId IS NULL OR wpt.pageTypeId = :pageTypeId')
            ->setParameter('pageTypeId', $pageTypeId)
            ->setParameter('themeId', $themeId)
            ->orderBy('p.type')
            ->getQuery()
            ->getResult();

        foreach ($results as $result) {
            $groupedResult[$result['type']][] = $result;
        }

        return $groupedResult;
    }

    /**
     * @param $widgetType
     * @param $themeId
     * @return array
     */
    public function  getWidgetsMostUsedByType($widgetType, $themeId)
    {
        return $this->createQueryBuilder('w')
            ->select('w', 'count(pw.widgetId) as HIDDEN widgetCount')
            ->leftJoin('w.pageWidgets', 'pw')
            ->where('w.type = :widgetType')
            ->andWhere('pw.themeId = :themeId')
            ->setParameter('widgetType', $widgetType)
            ->setParameter('themeId', $themeId)
            ->groupBy('w.id')
            ->orderBy('widgetCount', 'DESC')
            ->getQuery()
            ->getResult();
    }
}
