<?php
namespace ArcaSolutions\WebBundle\Services;

use ArcaSolutions\CoreBundle\Services\Settings;
use GuzzleHttp\Client;

class SubscriptionMailer
{
    const URL_API = 'http://arcamailer.com/api/api.php';
    const TIMEOUT = 60;

    /**
     * @var mixed
     */
    protected $arcamailerCustomerListId;

    /**
     * @var mixed
     */
    protected $action;

    /**
     * @var mixed
     */
    protected $subscriberName;

    /**
     * @var mixed
     */
    protected $subscriberEmail;

    /**
     * @var mixed
     */
    protected $subscriberType;

    /**
     * @var Settings
     */
    protected $settings;

    /**
     * @var Array
     */
    protected $messageErrors;

    /**
     * SubscriptionMailer constructor.
     *
     * @param Settings $settings
     */
    public function __construct(Settings $settings)
    {
        $this->settings = $settings;
        $this->setArcamailerCustomerListId($this->settings->getDomainSetting('arcamailer_customer_listid'));
    }

    /**
     * Send a Request to ArcaMailer API
     *
     * It is called to save a new visitor ArcaMailer API
     *
     * @return bool
     */
    public function sendSubscription()
    {
        $client = new Client();
        $response = $client->post(self::URL_API, [
            'body'    => [
                'action'           => $this->action,
                'listID'           => $this->arcamailerCustomerListId,
                'subscriber_name'  => $this->subscriberName,
                'subscriber_email' => $this->subscriberEmail,
                'subscriber_type'  => $this->subscriberType,
            ],
            'timeout' => self::TIMEOUT
        ]);
        $body = unserialize($response->getBody()->getContents());

        if (false === $body['success']) {
            $this->setMessageErrors($body['arrayReturn']);
        }

        return $body['success'];
    }

    /**
     * @return mixed
     */
    public function getArcamailerCustomerListId()
    {
        return $this->arcamailerCustomerListId;
    }

    /**
     * @param mixed $arcamailerCustomerListId
     */
    public function setArcamailerCustomerListId($arcamailerCustomerListId)
    {
        $this->arcamailerCustomerListId = $arcamailerCustomerListId;
    }

    /**
     * @return mixed
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * @param mixed $action
     */
    public function setAction($action)
    {
        $this->action = $action;
    }

    /**
     * @return mixed
     */
    public function getSubscriberName()
    {
        return $this->subscriberName;
    }

    /**
     * @param mixed $subscriberName
     */
    public function setSubscriberName($subscriberName)
    {
        $this->subscriberName = $subscriberName;
    }

    /**
     * @return mixed
     */
    public function getSubscriberEmail()
    {
        return $this->subscriberEmail;
    }

    /**
     * @param mixed $subscriberEmail
     */
    public function setSubscriberEmail($subscriberEmail)
    {
        $this->subscriberEmail = $subscriberEmail;
    }

    /**
     * @return mixed
     */
    public function getSubscriberType()
    {
        return $this->subscriberType;
    }

    /**
     * @param mixed $subscriberType
     */
    public function setSubscriberType($subscriberType)
    {
        $this->subscriberType = $subscriberType;
    }

    /**
     * @return mixed
     */
    public function getMessageErrors()
    {
        return $this->messageErrors;
    }

    /**
     * @param mixed $messageErrors
     */
    public function setMessageErrors($messageErrors)
    {
        $this->messageErrors = $messageErrors;
    }
}
