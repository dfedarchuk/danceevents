<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\CoreBundle\Entity\Account;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use Symfony\Component\HttpFoundation\RequestStack;

class UserLogin
{
    /**
     * Edir Session name. It is set in sitemgr
     */
    const SESSION_EDIR = 'SESS_ACCOUNT_ID';

    /**
     * @var RequestStack
     */
    private $request;

    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var Accountprofilecontact
     */
    private $user;

    /**
     * @var Account
     */
    private $account;

    /**
     * @var bool
     */
    private $initialized = false;

    /**
     * UserLogin constructor.
     * @param DoctrineRegistry $doctrine
     * @param RequestStack $request
     */
    public function __construct(DoctrineRegistry $doctrine, RequestStack $request)
    {
        $this->request = $request;
        $this->doctrine = $doctrine;
    }

    /**
     * @return Accountprofilecontact|false
     */
    public function getUser()
    {
        if (!$this->initialized) {
            $this->setUserFromEdirectory();
        }

        return $this->user;
    }

    public function getAccount()
    {
        if (!$this->initialized) {
            $this->setUserFromEdirectory();
        }

        return $this->account;
    }

    /**
     * @return void
     */
    private function setUserFromEdirectory()
    {
        if ($session = $this->request->getCurrentRequest()->getSession() and $id = $session->get($this::SESSION_EDIR)) {
            $this->user = $this->doctrine->getRepository('WebBundle:Accountprofilecontact')->find($id);

            /* Gets Account from User Logged */
            $this->account = $this->doctrine->getRepository('CoreBundle:Account', 'main')->find($this->user->getAccountId());

            $this->initialized = true;
        }
    }
}
