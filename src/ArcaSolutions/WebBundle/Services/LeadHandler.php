<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\WebBundle\Entity\Leads;
use Symfony\Component\DependencyInjection\Container;

class LeadHandler
{
    //region Item Type Constants
    const ITEMTYPE_GENERAL = "general";
    const ITEMTYPE_CLASSIFIED = "classified";
    const ITEMTYPE_EVENT = "event";
    const ITEMTYPE_LISTING = "listing";
    //endregion

    //region Status Constants
    const STATUS_READ = "A";
    const STATUS_UNREAD = "P";
    //endregion

    /**
     * @var Container
     */
    private $container;

    function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * @param $type
     * @param int $itemId
     * @param string $firstName
     * @param string $lastName
     * @param string $email
     * @param string $phone
     * @param string $subject
     * @param string $message
     * @return Leads
     */
    public function add(
        $type,
        $itemId = 0,
        $firstName = "",
        $lastName = "",
        $email = "",
        $phone = "",
        $subject = "",
        $message = ""
    ) {
        $session = $this->container->get("request_stack")->getCurrentRequest()->getSession();

        $lead = new Leads();
        $lead->setItemId($itemId);
        $lead->setMemberId($session->get('SESS_ACCOUNT_ID', 0));
        $lead->setType($type);
        $lead->setFirstName($firstName);
        $lead->setLastName($lastName);
        $lead->setEmail($email);
        $lead->setPhone($phone);
        $lead->setSubject($subject);
        $lead->setMessage($message);
        $lead->setEntered(new \DateTime());
        $lead->setStatus(self::STATUS_UNREAD);
        $lead->setNew("y");

        $em = $this->container->get("doctrine")->getManager();
        $em->persist($lead);
        $em->flush();

        return $lead;
    }
}
