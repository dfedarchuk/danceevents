<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\CoreBundle\Helper\ModuleHelper;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use ArcaSolutions\WebBundle\Entity\Quicklist;

/**
 * Class QuicklistHandler
 *
 * @package \ArcaSolutions\WebBundle\Services
 */
final class QuicklistHandler
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;
    /**
     * @var ModuleHelper
     */
    private $moduleHelper;

    /**
     * QuicklistHandler constructor.
     * @param $doctrine
     * @param $moduleHelper
     */
    public function __construct($doctrine, $moduleHelper)
    {
        $this->doctrine = $doctrine;
        $this->moduleHelper = $moduleHelper;
    }

    /**
     * Gets all items bookmarked
     * @param int|Accountprofilecontact $account Account Id or Account object
     * @return array
     * @throws \Exception
     */
    public function getAllItemsByAccountId($account)
    {
        $account = $this->verifiesAndGetAccount($account);

        $quicklist = $this->doctrine->getRepository('WebBundle:Quicklist')->findByAccountId($account->getAccountId());

        $list = [];
        foreach ($quicklist as $item) {
            /* @var $item \ArcaSolutions\WebBundle\Entity\Quicklist */
            $repository = $this->moduleHelper->getModuleRepositoryName($item->getItemType());

            $itemRow = $this->doctrine->getRepository($repository)->find($item->getItemId());

            if ($item->getId()) {
                $itemRow->setFavoriteId($item->getId());
                $itemRow->setType($item->getItemType());

                $itemRow and $itemRow->getStatus() == 'A' and $list[sprintf('%s', $item->getItemType())][] = $itemRow;
            }
        }

        return $list;
    }

    /**
     * Saves item
     * @param int|Accountprofilecontact $account
     * @param string $module
     * @param int $itemId
     * @return Quicklist
     * @throws \Exception
     */
    public function saveItem($account, $module, $itemId)
    {
        $account = $this->verifiesAndGetAccount($account);
        /* It is used here to check if the type is a valid type */
        $repository = $this->moduleHelper->getModuleRepositoryName($module);
        /* get item */
        $item = $this->doctrine->getRepository($repository)->find($itemId);

        /* Item validation */
        if ($item === null) {
            throw new \Exception(sprintf('Item does not exist (#%d given).', $itemId));
        }
        if ($item->getStatus() != 'A') {
            throw new \Exception('Item is not available');
        }

        /* check if it already bookmarked it */
        $quicklist = $this->doctrine->getRepository('WebBundle:Quicklist')->findOneBy([
            'accountId' => $account->getAccountId(),
            'itemId' => $itemId,
            'itemType' => $module
        ]);

        if ($quicklist) {
            throw new \Exception('You already did this');
        }

        /* saves item */
        $quicklist = new Quicklist();
        $quicklist->setAccountId($account->getAccountId());
        $quicklist->setItemId($itemId);
        $quicklist->setItemType($module);

        $objectManager = $this->doctrine->getManager();
        $objectManager->persist($quicklist);
        $objectManager->flush($quicklist);

        return $quicklist;
    }

    public function deleteItem($account, $module, $itemId)
    {
        $account = $this->verifiesAndGetAccount($account);
        /* It is used here to check if the type is a valid type */
        $this->moduleHelper->getModuleRepositoryName($module);

        /* check if it already bookmarked it */
        $quicklist = $this->doctrine->getRepository('WebBundle:Quicklist')->findOneBy([
            'accountId' => $account->getAccountId(),
            'itemId' => $itemId,
            'itemType' => $module
        ]);

        if (!$quicklist) {
            throw new \Exception('You do not have it bookmarked');
        }

        $objectManager = $this->doctrine->getManager();
        $objectManager->remove($quicklist);
        $objectManager->flush($quicklist);
    }

    public function deleteItemById($account, $favoriteId)
    {
        $account = $this->verifiesAndGetAccount($account);

        /* check if it already bookmarked it */
        $quicklist = $this->doctrine->getRepository('WebBundle:Quicklist')->findOneBy([
            'accountId' => $account->getAccountId(),
            'id' => $favoriteId
        ]);

        if (!$quicklist) {
            throw new \Exception('You do not have it bookmarked');
        }

        $objectManager = $this->doctrine->getManager();
        $objectManager->remove($quicklist);
        $objectManager->flush($quicklist);

        return $account;
    }

    /**
     * @param $account
     * @return Accountprofilecontact
     * @throws \Exception
     */
    private function verifiesAndGetAccount($account)
    {
        if (!($account instanceof Accountprofilecontact || is_int($account))) {
            throw new \Exception('You must pass the account id.');
        }

        if (is_int($account)) {
            $account = $this->doctrine->getRepository('WebBundle:Accountprofilecontact')->find($account);
            if ($account === null) {
                throw new \Exception('Account not found');
            }
        }

        return $account;
    }

    /**
     * Check is an entity is favorite of an account
     *
     * @param int $id Entity id
     * @param int $accountId Account id
     * @param string $module Module name
     * @return bool|int Quicklist id or FALSE if is not favorite
     */
    public function getFavoriteId($id, $accountId, $module){
        $favorite = $this->doctrine
            ->getRepository('WebBundle:Quicklist')
            ->getQuicklistByAccountItemModule($accountId, $id, $module);

        if(!$favorite){
            return null;
        }

        return $favorite->getId();
    }
}
