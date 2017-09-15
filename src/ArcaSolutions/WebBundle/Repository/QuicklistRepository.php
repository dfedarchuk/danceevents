<?php

namespace ArcaSolutions\WebBundle\Repository;


use Doctrine\ORM\EntityRepository;

class QuicklistRepository extends EntityRepository
{
    /**
     * @param $account_id
     * @param $item_id     
     * @param $module
     * @return mixed
     * @throws \Doctrine\ORM\NonUniqueResultException
     */
    public function getQuicklistByAccountItemModule($account_id , $item_id, $module)
    {
        return $this->findOneBy([
            'accountId' => $account_id,
            'itemId' => $item_id,
            'itemType' => $module
        ]);
    }
}