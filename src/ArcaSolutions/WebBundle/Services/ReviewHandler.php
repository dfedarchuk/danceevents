<?php

namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\ArticleBundle\Entity\Article;
use ArcaSolutions\CoreBundle\Exception\DuplicateItemException;
use ArcaSolutions\CoreBundle\Helper\ModuleHelper;
use ArcaSolutions\CoreBundle\Mailer\Mailer;
use ArcaSolutions\CoreBundle\Services\Settings;
use ArcaSolutions\ListingBundle\Entity\Listing;
use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\WebBundle\Entity\Accountprofilecontact;
use ArcaSolutions\WebBundle\Entity\Review;
use ArcaSolutions\WebBundle\Form\Type\ReviewsType;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\Form\Form;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpKernel\Exception\HttpException;
use Symfony\Component\Translation\TranslatorInterface;

/**
 * Class ReviewHandler
 * This class can (or should be) handle all things related to review.
 *
 * @package \ArcaSolutions\WebBundle\Services
 */
class ReviewHandler
{
    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var RequestStack
     */
    private $requestStack;

    /**
     * @var TranslatorInterface
     */
    private $translator;

    /**
     * @var TimelineHandler
     */
    private $timelinehandler;

    /**
     * @var Settings
     */
    private $settings;

    /**
     * @var EmailNotificationService
     */
    private $emailNotification;

    /**
     * @var \ArcaSolutions\MultiDomainBundle\Services\Settings
     */
    private $multiDomainInformation;

    /**
     * @var ModuleHelper
     */
    private $moduleHelper;

    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var Logger
     */
    private $logger;

    /**
     * ReviewHandler constructor.
     * @param DoctrineRegistry $doctrine
     * @param RequestStack $requestStack
     * @param TranslatorInterface $translator
     * @param TimelineHandler $timelinehandler
     * @param Settings $settings
     * @param EmailNotificationService $emailNotification
     * @param \ArcaSolutions\MultiDomainBundle\Services\Settings $multiDomainInformation
     * @param ModuleHelper $moduleHelper
     * @param \Swift_Mailer $mailer
     * @param Logger $logger
     */
    public function __construct(
        DoctrineRegistry $doctrine,
        RequestStack $requestStack,
        TranslatorInterface $translator,
        TimelineHandler $timelinehandler,
        Settings $settings,
        EmailNotificationService $emailNotification,
        \ArcaSolutions\MultiDomainBundle\Services\Settings $multiDomainInformation,
        ModuleHelper $moduleHelper,
        \Swift_Mailer $mailer,
        Logger $logger
    ) {
        $this->doctrine = $doctrine;
        $this->requestStack = $requestStack;
        $this->translator = $translator;
        $this->timelinehandler = $timelinehandler;
        $this->settings = $settings;
        $this->emailNotification = $emailNotification;
        $this->multiDomainInformation = $multiDomainInformation;
        $this->moduleHelper = $moduleHelper;
        $this->mailer = $mailer;
        $this->logger = $logger;
    }

    /**
     * @param $module
     * @param $id
     * @param Accountprofilecontact $memberAccount
     * @param ReviewsType|Form $reviewsType
     * @return Review
     * @throws \Exception
     */
    public function save($module, $id, Accountprofilecontact $memberAccount = null, Form $reviewsType)
    {
        $memberAccount !== null and $this->isDuplicated($module, $id, $memberAccount);

        $review = $this->doctrine->getRepository('WebBundle:Review')->addReview(
            $module,
            $id,
            $memberAccount,
            $reviewsType
        );

        $this->timelinehandler->add(
            $review->getId(),
            TimelineHandler::ITEMTYPE_REVIEW,
            TimelineHandler::ACTION_NEW
        );

        $moduleEntityName = $this->moduleHelper->getModuleRepositoryName($module);
        $item = $this->doctrine->getRepository($moduleEntityName)->find($id);

        $this->updateItemAvgReview($item, $module, $review->getRating());

        $this->sendNotificationOwner($item);
        $this->sendNotificationSitemgr($review, $item);

        return $review;
    }

    /**
     * It checks if this entry is duplicated or not
     * @param $module
     * @param $id
     * @param Accountprofilecontact $memberAccount
     * @throws \Exception
     */
    private function isDuplicated($module, $id, Accountprofilecontact $memberAccount)
    {
        $review = $this->doctrine->getRepository("WebBundle:Review")->findOneBy(
            [
                "memberId" => $memberAccount->getAccountId(),
                "itemType" => $module,
                "itemId"   => $id,
            ]
        );

        if ($review) {
            throw new DuplicateItemException("You already reviewed this one.");
        }
    }

    /**
     * It checks if the module has review feature and if it is enabled.
     *
     * @param string listing|article $module
     * @return bool
     * @throws \Exception
     * @throws HttpException
     */
    public function isModuleEnabled($module)
    {
        if (!in_array($module, ['listing', 'article'])) {
            throw new \Exception($this->translator->trans('This module does not have review feature.'));
        }

        if (($module == 'listing' && empty($this->settings->getDomainSetting("review_listing_enabled")))
            || ($module == 'article' && empty($this->settings->getDomainSetting("review_article_enabled")))
        ) {
            return false;
        }

        return true;
    }

    /**
     * It returns the message that shows after save review, following sitemgr configs.
     *
     * @return string
     * @throws \Doctrine\ORM\NonUniqueResultException
     * @throws \Exception
     */
    public function successMessage()
    {
        $review_approve = $this->settings->getDomainSetting('review_approve');

        return ($review_approve == 'on') ?
            $this->translator->trans('Your review has been submitted for approval.') :
            $this->translator->trans('Thank you for submitting your review!');
    }

    /**
     * It returns if sitemgr is forcing the login in this module for review
     *
     * @param string listing|article $module
     * @return bool
     * @throws \Exception
     */
    public function forceLogin($module)
    {
        switch ($module) {
            case 'listing':
                $setKey = 'listing_rate';
                break;

            case 'article':
                $setKey = 'article_rate';
                break;

            default:
                throw new \Exception(sprintf('Forced login for this %s was not implemented.', ucfirst($module)));
                break;
        }

        return $this->settings->getSettingSocialNetwork($setKey) === 'yes' ? true : false;
    }

    /**
     * Get all reviews from an user
     * @param Accountprofilecontact $memberAccount
     * @return \ArcaSolutions\WebBundle\Entity\Review[]
     */
    public function getReviewsByAccountId(Accountprofilecontact $memberAccount)
    {
        return $this->doctrine->getRepository('WebBundle:Review')->findBy(
            [
                'memberId' => $memberAccount->getAccountId(),
            ],
            ['added' => 'DESC']
        );
    }

    /**
     * @param Accountprofilecontact $memberAccount
     * @param $module
     * @param $id
     * @return bool
     * @throws \Exception
     */
    public function deleteReview(Accountprofilecontact $memberAccount, $module, $id)
    {
        $review = $this->doctrine->getRepository('WebBundle:Review')->findOneBy(
            [
                'itemType' => $module,
                'memberId' => $memberAccount->getAccountId(),
                'itemId'   => $id,
            ]
        );

        if (!$review) {
            throw new \Exception('Review does not exist');
        }

        $objectManager = $this->doctrine->getManager();
        $objectManager->remove($review);
        $objectManager->flush($review);

        return true;
    }

    /**
     * @param Accountprofilecontact $account
     * @param $reviewId
     * @return Accountprofilecontact
     * @throws \Exception
     */
    public function deleteReviewById(Accountprofilecontact $account, $reviewId)
    {
        $review = $this->doctrine->getRepository('WebBundle:Review')->findOneBy(
            [
                'memberId' => $account->getAccountId(),
                'id'       => $reviewId,
            ]
        );

        if (!$review) {
            throw new \Exception('Review does not exist');
        }

        $objectManager = $this->doctrine->getManager();
        $objectManager->remove($review);
        $objectManager->flush($review);

        return $account;
    }

    /**
     * Updates avg review in listing if the flag of review_approve is not checked
     *
     * @param Listing|Article $item Item object
     * @param string $module Module's name
     * @throws \Doctrine\ORM\Query\QueryException
     */
    private function updateItemAvgReview($item, $module)
    {
        $review_approve = $this->settings->getDomainSetting('review_approve');
        /* if it is checked, the update will be made manual (in sitemgr) */
        if ($review_approve == 'on') {
            return;
        }

        $newAvg = $this->doctrine->getRepository('WebBundle:Review')->getAvgReviewByItemId($item->getId(), $module);

        $item->setAvgReview((int)round($newAvg, 0));
        $objectManager = $this->doctrine->getManager();

        try {
            $objectManager->persist($item);
            $objectManager->flush($item);
        } catch (\Exception $e) {
            $this->logger->addError(
                sprintf(
                    'AvgReview of %s item (#%d) was not updated. New rate given: %d. New average review was: %d',
                    $module,
                    $item->getId(),
                    $newAvg
                )
            );
        }
    }

    /**
     * Sends Email notification
     *
     * @param Listing|Article $item
     * @throws \Exception
     */
    private function sendNotificationOwner($item)
    {
        $baseUrl = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

        /* Sending owner */
        $newReview = $this->emailNotification->getEmailMessage(EmailNotificationService::NEW_REVIEW);
        $owner = $this->doctrine->getRepository('CoreBundle:Contact', 'main')->findOneByAccountId(
            $item->getAccountId()
        );

        $from_sitemgr = $this->doctrine->getRepository('WebBundle:Setting')->getSetting('sitemgr_email');

        if ($owner) {
            $newReview
                ->setTo($owner->getEmail())
                ->setFrom(explode(',', $from_sitemgr))
                ->setPlaceholder('ACCOUNT_NAME', sprintf('%s %s', $owner->getFirstName(), $owner->getLastName()))
                ->setPlaceholder('ACCOUNT_USERNAME', $owner->getEmail())
                ->setPlaceholder('SITEMGR_EMAIL', $from_sitemgr)
                ->setPlaceholder('EDIRECTORY_TITLE', $this->multiDomainInformation->getTitle())
                ->setPlaceholder('DEFAULT_URL', $baseUrl);

            if (!$newReview->sendEmail()) {
                throw new \Exception(sprintf('An error occurred sending an email.'));
            }
        }
    }

    /**
     * @param Review $review
     * @param $item
     */
    private function sendNotificationSitemgr(Review $review, $item)
    {
        $baseUrl = $this->requestStack->getCurrentRequest()->getSchemeAndHttpHost();

        $sitemgr_rate_email = $this->settings->getDomainSetting('sitemgr_rate_email');
        $sitemgr_rate_email and $sitemgr_rate_email = explode(",", $sitemgr_rate_email);

        $subject = sprintf(
            '[%s] %s',
            $this->multiDomainInformation->getTitle(),
            $this->translator->trans('Rating Notification')
        );

        /* it is just a port of the old way. We must improve it */
        $body = sprintf(
            '%s,
                <br /><br />
                 "%s" %s - %s %s <br />
                 %s (%s) %s %s %s: <br />
                 %s <br />
                 %s <br />
                 %s <br /><br />
                 %s :<br />
                 <a href="%s/sitemgr/activity/reviews-comments/index.php?item_type=%s&search_id=%d" target="_blank">
                    %s/activity/reviews-comments/index.php?search_id=%d
                 <a/>
                 <br /><br />
                ',
            $this->translator->trans('Site Manager'),
            $item->getTitle(),
            $this->translator->trans('has a new review'),
            $review->getRating(),
            $this->translator->trans('stars'),
            $review->getReviewerName(),
            $review->getReviewerEmail(),
            $this->translator->trans('from'),
            $review->getReviewerLocation(),
            $this->translator->trans('wrote'),
            $review->getReviewTitle(),
            $review->getReview(),
            $review->getAdded()->format($this->translator->trans('date.format', [], 'units').' H:i:s'),
            $this->translator->trans('Click on the link below to go to the review administration'),
            $baseUrl,
            $review->getItemType(),
            $review->getId(),
            $baseUrl,
            $review->getId()
        );

        try {
            /** @var Mailer */
            $send = Mailer::newMail($this->mailer, $this->settings);
            $send->setSubject($subject);
            $send->setFrom(
                $this->settings->getDomainSetting('emailconf_email'),
                $this->multiDomainInformation->getTitle()
            );
            $send->setTo($sitemgr_rate_email);
            $send->setBody($body, 'text/html');
            $send->send();
        } catch (\Exception $e) {
            $this->logger->addAlert(sprintf('An error occurred sending an email to sitemgr: %s', $e->getMessage()));
        }
    }
}
