<?php

namespace ArcaSolutions\DealBundle\Repository;

use ArcaSolutions\CoreBundle\Interfaces\EntityModulesRowInterface;
use ArcaSolutions\CoreBundle\Repository\EntityModulesRowRepository;
use Doctrine\ORM\QueryBuilder;

class PromotionRepository extends EntityModulesRowRepository implements EntityModulesRowInterface
{
    /**
     * Returns module name in lowercase
     *
     * @return string
     */
    function getModuleName()
    {
        return 'deal';
    }

    /**
     * Count valid deals.
     *
     * @return int Row count
     */
    public function countValidDeals()
    {
        $qb = $this->findValidDeals();

        $qb->select('COUNT(deal.id)');

        return $qb->getQuery()->getSingleScalarResult();
    }

    /**
     * Find valid deals.
     *
     * @return QueryBuilder
     */
    public function findValidDeals()
    {
        $qb = $this->createQueryBuilder('deal');

        $qb->select('deal.id')
            ->join('deal.listing', 'listing')
            ->andWhere('deal.listingId IS NOT NULL')
            ->andWhere('deal.endDate >= CURRENT_DATE()')
            ->andWhere('deal.startDate <= CURRENT_DATE()')
            ->andWhere('listing.status = :status')
            ->setParameter('status', 'A')
        ;

        return $qb;
    }
}
