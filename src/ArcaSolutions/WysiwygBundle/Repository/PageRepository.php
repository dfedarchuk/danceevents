<?php

namespace ArcaSolutions\WysiwygBundle\Repository;


use Doctrine\ORM\EntityRepository;

/**
 * Class PageRepository
 */
class PageRepository extends EntityRepository
{
    /**
     * Return the Page by it's type title
     *
     * @param null $pageType Page type title, it will always be one of the constants of wysiwyg.service
     * @return mixed
     */
    public function getPageByType($pageType = null)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.pageType', 't')
            ->where('t.title = :pageType')
            ->setParameter('pageType', $pageType)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * Return the Page by it's type title and Url
     * Used for Custom pages
     *
     * @param null $pageType
     * @param null $friendlyUrl
     * @return mixed
     */
    public function getPageByTypeAndUrl($pageType = null, $friendlyUrl = null)
    {
        return $this->createQueryBuilder('p')
            ->leftJoin('p.pageType', 't')
            ->where('t.title = :pageType')
            ->andWhere('p.url = :friendlyUrl')
            ->setParameter('pageType', $pageType)
            ->setParameter('friendlyUrl', $friendlyUrl)
            ->getQuery()
            ->getOneOrNullResult();
    }

    /**
     * @param string $url The page url
     * @param array $pageTypes The pageType
     * @param integer $id The page id
     * @return mixed
     */
    public function uniqueUrl($url, array $pageTypes, $id)
    {
        $query = $this->createQueryBuilder('p')
            ->leftJoin('p.pageType', 'pt')
            ->where('p.url = :url')
            ->setParameter('url', $url)
            ->setParameter('pageTypes', $pageTypes);

        if (count($pageTypes) == 1) {
            $query->andWhere('pt.title NOT IN (:pageTypes) OR p.id != :id');
            $query->setParameter('id', $id);
        } else {
            $query->andWhere('pt.title NOT IN (:pageTypes)');
        }

        return $query->getQuery()->getResult();
    }

}
