<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\WebBundle\Entity\Quicklist;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\HttpFoundation\RequestStack;

final class UserBookmark
{
    /**
     * Hash used to search easier in array
     */
    const HASH = '%s%s';

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var array
     */
    private $userBookmark;

    /**
     * @var int
     */
    private $userId;

    /**
     * Control variable that shows if class was already called
     *
     * @var bool
     */
    private $initialised = false;

    /**
     * @param ContainerInterface $containerInterface
     * @param RequestStack       $requestStack
     */
    public function __construct(ContainerInterface $containerInterface, RequestStack $requestStack)
    {
        $this->container = $containerInterface;
        $this->request = $requestStack;
    }

    /**
     * @param Listing|Event $item
     *
     * @return bool
     */
    public function checkItem($item = null, $module = '')
    {
        if (is_null($item)) {
            return false;
        }

        /* get out if user is not logged */
        if (true === $this->initialised && is_null($this->userId)) {
            return false;
        }

        /* gets user and sets bookmarks if it's the first time */
        if (false === $this->initialised) {
            $this->getsUser();
        }

        /* it's used is_int because array_search return, if found, the key of the value and it can be zero */

        return $this->userBookmark
        && is_int(array_search(sprintf(self::HASH, $module, $item->getId()), $this->userBookmark)) ? : false;
    }

    /**
     * Gets User info like ID and list of bookmarks
     *
     * @return void
     */
    private function getsUser()
    {
        /* gets user Id using profile credentials */
        $this->userId = $this->request->getCurrentRequest()->getSession()->get('SESS_ACCOUNT_ID');

        /* sets initialization for true */
        $this->initialised = true;
        $this->populateUserBookmark();
    }

    /**
     * Fill bookmark list, if user exist
     *
     * @return void
     */
    private function populateUserBookmark()
    {
        if (!$this->userId) {
            return;
        }

        $bookmarks = $this->container->get('doctrine')->getRepository('WebBundle:Quicklist')->findBy([
            'accountId' => $this->userId
        ]);

        /* reorganize bookmark list */
        $this->userBookmark = array_map(function ($row) {
            /* @var Quicklist $row */
            /* creates a hash to search */
            return sprintf(self::HASH, $row->getItemType(), $row->getItemId());
        }, $bookmarks);
    }
}
