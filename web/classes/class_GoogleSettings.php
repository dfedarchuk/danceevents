<?

/* ==================================================================*\
  ######################################################################
  #                                                                    #
  # Copyright 2005 Arca Solutions, Inc. All Rights Reserved.           #
  #                                                                    #
  # This file may not be redistributed in whole or part.               #
  # eDirectory is licensed on a per-domain basis.                      #
  #                                                                    #
  # ---------------- eDirectory IS NOT FREE SOFTWARE ----------------- #
  #                                                                    #
  # http://www.edirectory.com | http://www.edirectory.com/license.html #
  ######################################################################
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_googleSettings.php
# ----------------------------------------------------------------------------------------------------

class GoogleSettings
{
    /* Google Maps */

    /**
     * Whether or not google maps is activated on this domain
     * @var boolean
     */
    public $mapsStatus;

    /**
     * Stores google maps' Key
     * @var string
     */
    public $mapsKey;

    /* Google Analytics */

    /**
     * Google Analytics account id
     * @var string
     */
    public $analyticsAccount;


    /**
     * Whether or not google analytics will collect data from the Front area (end users)
     * @var boolean
     */
    public $analyticsFront;
    /**
     * Whether or not google analytics will collect data from the Members area (sponsors)
     * @var boolean
     */
    public $analyticsMembers;
    /**
     * Whether or not google analytics will collect data from the Site Manager area (admins)
     * @var boolean
     */
    public $analyticsSiteManager;

    /* Google Ads */

    /**
     * Whether or not google ads are activated on this domain
     * @var boolean
     */
    public $adStatus;

    /**
     * Google ads client ID
     * @var string
     */
    public $adClient;

    /* Google reCAPTCHA */

    /**
     * Whether or not google reCAPTCHA is activated on this domain
     * @var boolean
     */
    public $recaptchaStatus;

    /**
     * Google recaptcha public key
     * @var string
     */
    public $recaptchaSiteKey;

    /**
     * Google recaptcha private key
     * @var string
     */
    public $recaptchaSecretKey;

    /**
     * Unknown Variable
     *
     * <Lucas Trentim (2015)>
     * @todo May be Obsolete? should we wipe it out?
     *
     * @var string
     */
    public $adChannel;
    /**
     * Controls what kind of advertisements will be shown
     * Possible Values :
     * 3 (text_image)
     * 2 (image)
     * 1 (text)
     * @var int
     */
    public $adType;

    /* Google Tag */

    /**
     * Whether or not google tag is activated on this domain
     * @var boolean
     */
    public $tagStatus;
    /**
     * Google Tag's client
     * @var string
     */
    public $tagClient;

    /**
     * Google GeoLocation Status
     * @var string
     */
    public $geoLocationStatus;

    /**
     * Google GeoLocation key
     * @var string
     */
    public $geoLocationKey;

    /**
     * The mysql object connection to the DB
     * @var mysql
     */
    private static $dataBase;

    /**
     * The name of the table containing all the settings in the Domain Database
     * @var type
     */
    private static $table = "Setting_Google";

    /**
     * Stores the id => property address pair for each variable.
     * @var type
     */
    private $settingDictionary;

    public function __construct($domainID = null)
    {
        $mainDB = db_getDBObject(DEFAULT_DB, true);

        if ($domainID) {
            self::$dataBase = (is_numeric($domainID) ? db_getDBObjectByDomainID($domainID,
                $mainDB) : db_getDBObjectByDomainID(0, $mainDB, str_replace("www.", "", $domainID)));
        } else {
            if (defined("SELECTED_DOMAIN_ID")) {
                self::$dataBase = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $mainDB);
            } else {
                self::$dataBase = db_getDBObject();
            }
        }

        /**
         * @todo Is name AND id reeeeally necessary? Name could be the primary key or be removed altogether.
         */

        /* This maps each id to its corresponding property in this object */
        $this->settingDictionary = [
            "ad_client"           => &$this->adClient,
            "maps_status"         => &$this->mapsStatus,
            "maps_key"            => &$this->mapsKey,
            "analytics_account"   => &$this->analyticsAccount,
            "analytics_front"     => &$this->analyticsFront,
            "analytics_members"   => &$this->analyticsMembers,
            "analytics_sitemgr"   => &$this->analyticsSiteManager,
            "ad_channel"          => &$this->adChannel,
            "ad_status"           => &$this->adStatus,
            "ad_type"             => &$this->adType,
            "tag_status"          => &$this->tagStatus,
            "tag_client"          => &$this->tagClient,
            "recaptcha_status"    => &$this->recaptchaStatus,
            "recaptcha_sitekey"   => &$this->recaptchaSiteKey,
            "recaptcha_secretkey" => &$this->recaptchaSecretKey,
            'geolocation_status'  => &$this->geoLocationStatus,
            'geolocation_key'     => &$this->geoLocationKey,
        ];

        /* fetches all records from the table and attributes them to the proper variable */
        $sql = "SELECT name, value FROM ".self::$table;
        $query = self::$dataBase->query($sql);
        while ($row = mysql_fetch_array($query)) {
            $this->settingDictionary[$row['name']] = $row['value'];
        }
    }

    function Save()
    {
        $success = true;

        foreach ($this->settingDictionary as $key => $value) {
            /* Filters out everything except letters, numbers, underscore(_) and minus(-) */
            $filteredValue = preg_replace("/[^\w\d\-]/", "", $value);

            $sql = "SELECT id FROM ".self::$table." WHERE name='".$key."'";
            $query = self::$dataBase->query($sql);

            if ($row = mysql_fetch_array($query)) {
                $sql = "UPDATE ".self::$table." SET value='".$filteredValue."' WHERE name = '".$key."'";
            } else {
                $sql = "INSERT INTO ".self::$table." (name, value)"." VALUES( '{$key}', '{$filteredValue}')";
            }

            if (!self::$dataBase->query($sql)) {
                $success = false;
                break;
            }
        }

        return $success;
    }

    /**
     * Returns google's code for the ad type.
     * @return string
     */
    function getTypeCode()
    {
        $adTypes = null;

        switch ($this->adType) {
            case 1:
                $adTypes = "text";
                break;
            case 2:
                $adTypes = "image";
                break;
            case 3:
                $adTypes = "text_image";
                break;
        }

        return $adTypes;
    }
}
