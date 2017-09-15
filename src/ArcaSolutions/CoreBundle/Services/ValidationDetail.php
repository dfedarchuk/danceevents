<?php

namespace ArcaSolutions\CoreBundle\Services;

use ArcaSolutions\CoreBundle\Interfaces\ItemDetailInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;

/**
 * Class ValidationDetail
 *
 * @package ArcaSolutions\CoreBundle\Services
 */
final class ValidationDetail
{
    /**
     * Checks if item can show detail
     *
     * @param ItemDetailInterface $itemDetail
     *
     * @return bool
     * @throws \Exception When item is not seated
     */
    public static function isDetailAllowed(ItemDetailInterface $itemDetail)
    {
        if (is_null($itemDetail) || is_null($itemDetail->getItem())) {
            throw new \Exception('You must set the item');
        }

        if (static::isPreviewSitemgr($itemDetail->getContainer())) {
            return true;
        }

        if (static::isPreviewSponsors($itemDetail->getContainer(), $itemDetail)) {
            return true;
        }

        /* Negates the condition to show detail */
        if ($itemDetail->getLevel() && !($itemDetail->getLevel()->isActive && $itemDetail->getLevel()->hasDetail)) {
            return false;
        }

        /* Shows detail of just active item */
        if ('A' !== $itemDetail->getItem()->getStatus()) {
            return false;
        }

        return true;
    }

    /**
     * It checks if the access is from sponsor or sitemgr
     * @param ItemDetailInterface $itemDetail
     * @return bool
     */
    public static function isSponsorsOrSitemgr(ItemDetailInterface $itemDetail)
    {
        return static::isPreviewSponsors($itemDetail->getContainer(), $itemDetail) || static::isPreviewSitemgr($itemDetail->getContainer());
    }

    /**
     * Verify if the request came from sitemgr
     *
     * @param ContainerInterface $container
     *
     * @return bool
     */
    private static function isPreviewSitemgr(ContainerInterface $container)
    {
        $request = $container->get('request_stack')->getCurrentRequest();
        $refererSitemgr = strpos($request->headers->get('referer'),
                $container->getParameter('alias_sitemgr_module')) !== false;

        return $request->getSession()->get('SM_LOGGEDIN') && $refererSitemgr;
    }

    /**
     * Verify if the request came from sponsors area and if sitemgr is logged as sponsor
     *
     * @param ContainerInterface $container
     * @param ItemDetailInterface $itemDetail
     *
     * @return bool
     */
    private static function isPreviewSponsors(ContainerInterface $container, ItemDetailInterface $itemDetail)
    {
        $request = $container->get('request_stack')->getCurrentRequest();
        $refererSponsors = strpos($request->headers->get('referer'),
                $container->getParameter('alias_members_module')) !== false;

        if (!method_exists($itemDetail->getItem(), 'getAccountId')) {
            return false;
        }

        return ($request->getSession()->get('SM_LOGGEDIN')
            || $request->getSession()->get('SESS_ACCOUNT_ID') == $itemDetail->getItem()->getAccountId())
        && $refererSponsors;
    }
}
