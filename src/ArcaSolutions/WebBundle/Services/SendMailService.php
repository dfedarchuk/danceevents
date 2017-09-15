<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\ClassifiedBundle\Entity\Classified;
use ArcaSolutions\EventBundle\Entity\Event;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\ReportsBundle\Services\ReportHandler;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Form;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class SendMailService
 *
 * @package \ArcaSolutions\WebBundle\Services
 */
class SendMailService
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var EmailNotificationService
     */
    private $emailNotification;

    /**
     * @var ReportHandler
     */
    private $reportHandler;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var LeadHandler
     */
    private $leadHandler;

    /**
     * @var TimelineHandler
     */
    private $timelineHandler;

    /**
     * SendMailService constructor.
     * @param DoctrineRegistry $doctrine
     * @param EmailNotificationService $emailNotification
     * @param ReportHandler $reportHandler
     * @param TranslatorInterface $translator
     * @param LeadHandler $leadHandler
     * @param TimelineHandler $timelineHandler
     */
    public function __construct(DoctrineRegistry $doctrine, EmailNotificationService $emailNotification, ReportHandler $reportHandler, TranslatorInterface $translator, LeadHandler $leadHandler, TimelineHandler $timelineHandler)
    {
        $this->doctrine = $doctrine;
        $this->emailNotification = $emailNotification;
        $this->reportHandler = $reportHandler;
        $this->translator = $translator;
        $this->leadHandler = $leadHandler;
        $this->timelineHandler = $timelineHandler;
    }

    /**
     * @param Listing|Event|Classified $item
     * @param Form $form
     * @return bool
     * @throws \Exception
     */
    public function send($item, Form $form)
    {
        $leadType = $this->getLeadType($item);

        $translator = $this->translator;
        /* getting notification object */
        $notification = $this->emailNotification->getEmailMessage(EmailNotificationService::NEW_LEAD);
        $doctrine = $this->doctrine;

        $to = ['email' => $item->getEmail()];

        $account = [];
        if ($item->getAccountId() and 0 != $item->getAccountId()) { /* it has owner */
            $owner = $doctrine->getRepository('CoreBundle:Contact', 'main')->find($item->getAccountId());
            $account = [
                'email' => $owner->getEmail(),
                'name' => $owner->getFirstName() . ' ' . $owner->getLastName()
            ];
        }

        /* The item can not be account */
        if (!empty($to['email'])) {
            $from_sitemgr = explode(
                ',',
                $doctrine->getRepository('WebBundle:Setting')->getSetting('sitemgr_email')
            );

            /* adds subject from user */
            $notification->setSubject($notification->getSubject() . ' ' . $form->get('subject')->getData());

            /* set appropriated EOL */
            $eol = strpos($notification->getMessage(),'<br />') === false ? PHP_EOL : '<br />';

            /* making the lead body */
            $body = $translator->trans('Item') . ": " . $item->getTitle();
            $body .= $eol . $eol . $translator->trans('Name') . ": " . $form->get('name')->getData();
            $body .= $eol . $eol . $translator->trans('Email') . ": " . $form->get('email')->getData();
            $body .= $eol . $eol . $translator->trans('Message') . ": " . $eol . $eol . ($eol == PHP_EOL ? $form->get('text')->getData() : str_replace(PHP_EOL, $eol, $form->get('text')->getData()));

            /* replacing placeholders and sending message */
            $notification->setTo($to['email']);
            $notification->setFrom($from_sitemgr);
            $notification->setPlaceholder('ACCOUNT_NAME', count($account) ? $account['name'] : '');
            $notification->setPlaceholder('ACCOUNT_USERNAME', count($account) ? $account['email'] : '');
            $notification->setPlaceholder('LEAD_MESSAGE', $body);
            $sending = $notification->sendEmail($errors, true);

            if ($sending) {
                /* Prepares information for lead insertion */
                $names = explode(" ", trim($form->get('name')->getData()));
                $lastName = array_pop($names);
                $firstName = implode(" ", $names);
                $email = $form->get('email')->getData();
                $subject = $form->get('subject')->getData();
                $message = $form->get('text')->getData();

                /* Adds to sitemanager's timeline */
                $lead = $this->leadHandler->add(
                    $leadType,
                    $item->getId(),
                    $firstName,
                    $lastName,
                    $email,
                    "",
                    $subject,
                    $message
                );

                $this->timelineHandler->add(
                    $lead->getId(),
                    TimelineHandler::ITEMTYPE_LEAD,
                    TimelineHandler::ACTION_NEW
                );

                /* Just listing has this kind of report */
                if ($item instanceof Listing) {
                    $this->reportHandler->addListingReport($item->getId(), ReportHandler::LISTING_EMAIL);
                }

                return true;
            }

            /* it not sent the email */
            return false;
        }

        return false;
    }

    /**
     * @param Listing|Event|Classified $item
     * @return string
     * @throws \Exception
     */
    private function getLeadType($item)
    {
        if ($item instanceof Listing) {
            return LeadHandler::ITEMTYPE_LISTING;
        }

        if ($item instanceof Event) {
            return LeadHandler::ITEMTYPE_EVENT;
        }

        if ($item instanceof Classified) {
            return LeadHandler::ITEMTYPE_CLASSIFIED;
        }

        throw new \Exception(sprintf('Lead type not implemented.(%s given)', get_class($item)));
    }
}
