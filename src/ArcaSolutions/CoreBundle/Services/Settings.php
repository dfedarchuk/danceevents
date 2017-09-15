<?php
namespace ArcaSolutions\CoreBundle\Services;

use ArcaSolutions\MultiDomainBundle\Doctrine\DoctrineRegistry;
use ArcaSolutions\WebBundle\Entity\Setting;

class Settings
{
    const PAYMENT_AUTHORIZE_LOGIN = "AUTHORIZE_LOGIN";
    const PAYMENT_AUTHORIZE_RECURRING = "AUTHORIZE_RECURRING";
    const PAYMENT_AUTHORIZE_RECURRINGLENGTH = "AUTHORIZE_RECURRINGLENGTH";
    const PAYMENT_AUTHORIZE_RECURRINGUNIT = "AUTHORIZE_RECURRINGUNIT";
    const PAYMENT_AUTHORIZE_STATUS = "AUTHORIZE_STATUS";
    const PAYMENT_AUTHORIZE_TXNKEY = "AUTHORIZE_TXNKEY";
    const PAYMENT_CURRENCY_SYMBOL = "CURRENCY_SYMBOL";
    const PAYMENT_INVOICEPAYMENT_FEATURE = "INVOICEPAYMENT_FEATURE";
    const PAYMENT_MANUALPAYMENT_FEATURE = "MANUALPAYMENT_FEATURE";
    const PAYMENT_PAGSEGURO_EMAIL = "PAGSEGURO_EMAIL";
    const PAYMENT_PAGSEGURO_STATUS = "PAGSEGURO_STATUS";
    const PAYMENT_PAGSEGURO_TOKEN = "PAGSEGURO_TOKEN";
    const PAYMENT_PAYFLOW_LOGIN = "PAYFLOW_LOGIN";
    const PAYMENT_PAYFLOW_PARTNER = "PAYFLOW_PARTNER";
    const PAYMENT_PAYFLOW_STATUS = "PAYFLOW_STATUS";
    const PAYMENT_PAYMENT_CURRENCY = "PAYMENT_CURRENCY";
    const PAYMENT_PAYPAL_ACCOUNT = "PAYPAL_ACCOUNT";
    const PAYMENT_PAYPAL_RECURRING = "PAYPAL_RECURRING";
    const PAYMENT_PAYPAL_RECURRINGCYCLE = "PAYPAL_RECURRINGCYCLE";
    const PAYMENT_PAYPAL_RECURRINGTIMES = "PAYPAL_RECURRINGTIMES";
    const PAYMENT_PAYPAL_RECURRINGUNIT = "PAYPAL_RECURRINGUNIT";
    const PAYMENT_PAYPAL_STATUS = "PAYPAL_STATUS";
    const PAYMENT_PAYPALAPI_PASSWORD = "PAYPALAPI_PASSWORD";
    const PAYMENT_PAYPALAPI_SIGNATURE = "PAYPALAPI_SIGNATURE";
    const PAYMENT_PAYPALAPI_STATUS = "PAYPALAPI_STATUS";
    const PAYMENT_PAYPALAPI_USERNAME = "PAYPALAPI_USERNAME";
    const PAYMENT_TWOCHECKOUT_LOGIN = "TWOCHECKOUT_LOGIN";
    const PAYMENT_TWOCHECKOUT_STATUS = "TWOCHECKOUT_STATUS";
    const PAYMENT_WORLDPAY_INSTID = "WORLDPAY_INSTID";
    const PAYMENT_WORLDPAY_STATUS = "WORLDPAY_STATUS";


    /**
     * @var DoctrineRegistry
     */
    private $doctrine;

    /**
     * @var array
     */
    private $parameters = [];

    /**
     * Settings constructor.
     *
     * @param DoctrineRegistry $doctrine
     */
    public function __construct(DoctrineRegistry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    /**
     * Gets key from Settings table of the database main
     *
     * @param string $key
     *
     * @return mixed|null|string
     */
    public function getSetting($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('CoreBundle:Setting')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * @param string $key
     *
     * @return bool
     */
    private function checkKeyExists($key = '')
    {
        return isset($this->parameters[$key]);
    }

    /**
     * @param string $key
     *
     * @return mixed
     */
    private function getValue($key = '')
    {
        return $this->parameters[$key];
    }

    /**
     * @param string $key
     * @param string $value
     */
    private function setKey($key = '', $value = '')
    {
        $this->parameters[$key] = $value;
    }

    /**
     * Gets key from Settings table
     *
     * @param string $key
     *
     * @return mixed|null|string
     */
    public function getDomainSetting($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('WebBundle:Setting')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * Gets Items from Navigation Settings table
     *
     * @param string $area
     * @return \ArcaSolutions\WebBundle\Entity\SettingNavigation[]|array|mixed|null
     * @throws \Exception
     */
    public function getNavigationSetting($area = 'all')
    {
        if ($this->checkKeyExists($area)) {
            $values = $this->getValue($area);
        }

        if (!isset($values)) {
            if ($area !== 'all') {
                $values = $this->doctrine->getRepository('WebBundle:SettingNavigation')->getMenuByArea($area);
            } else {
                $values = $this->doctrine->getRepository('WebBundle:SettingNavigation')->findAll();
            }
        }

        if (null == $values) {
            return null;
        }

        $this->setKey($area, $values);

        return $values;
    }

    /**
     * Gets key from Settings Search Tag table
     *
     * @param string $key
     *
     * @return mixed|string
     */
    public function getSettingSearchTag($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('WebBundle:SettingSearchTag')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * Gets key from Settings google table
     *
     * @param string $key
     *
     * @return mixed|string
     */
    public function getSettingGoogle($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('WebBundle:SettingGoogle')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * Gets key from Settings Payment table
     *
     * @param string $key
     *
     * @return mixed|string
     */
    public function getSettingPayment($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('WebBundle:SettingPayment')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * Gets key from Settings Social Network
     *
     * @param string $key
     *
     * @return mixed|string
     */
    public function getSettingSocialNetwork($key = '')
    {
        if ($this->checkKeyExists($key)) {
            return $this->getValue($key);
        }

        $value = $this->doctrine->getRepository('WebBundle:SettingSocialNetwork')->findOneBy(['name' => $key]);

        if (null === $value) {
            return null;
        }

        $this->setKey($key, $value->getValue());

        return $value->getValue();
    }

    /**
     * Update or add a new setting on table Setting
     *
     * @param string $name
     * @param string $value
     * @since 11.2.00
     */
    public function setSetting($name, $value)
    {
        $value = trim($value);
        // Settings that must check if the url contains ://
        $checkUrlArr = [
            'setting_facebook_link', 'setting_linkedin_link', 'setting_instagram_link',
            'setting_googleplus_link', 'setting_pinterest_link', 'twitter_account'
        ];

        if (in_array($name, $checkUrlArr) and strpos($value, "://") === false and !empty($value))
        {
            $value = "https://".$value;
        }

        if ($setting = $this->doctrine->getRepository('WebBundle:Setting')->findOneBy(['name' => $name])) {
            $setting->setValue($value);
        } else {
            $setting = new Setting();
            $setting->setName($name);
            $setting->setValue($value);
            $this->doctrine->getManager('domain')->persist($setting);
        }

        $this->doctrine->getManager('domain')->flush($setting);
    }
}
