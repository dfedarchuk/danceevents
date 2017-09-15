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
    # * FILE: /classes/class_reCAPTCHA.php
    # ----------------------------------------------------------------------------------------------------

    /* We'll put this here just to force session start.
     * Tip: @ is an error supressor operator */
    @session_start();

    class reCAPTCHA
    {
        /**
         * Keeps the google settings instance to avoid loading data from the DB
         * @var GoogleSettings
         */
        public $settings;

        /**
         * Is it the old or new captcha?
         * @var boolean
         */
        public $isNew;

        /**
         * What language will reCAPTCHA use?
         * @var string
         */
        public $language;

        /**
         * This translates eDirectory language codes into reCAPTCHA language codes.
         * @var string[]
         */
        public static $languageLibrary = array(
            "en_us" => "en",
            "pt_br" => "pt-BR",
            "es_es" => "es",
            "tr_tr" => "tr",
            "ge_ge" => "de",
            "fr_fr" => "fr",
            "it_it" => "it",
        );

        public function __construct()
        {
            $this->settings = new GoogleSettings();
            $this->isNew    = $this->settings->recaptchaStatus == "on";
            $this->language = self::$languageLibrary[ EDIR_LANGUAGE ];
        }

        /**
         * This function will render the right recaptcha form field according to user's settings
         */
        public function render()
        {
            if( $this->isNew )
            {
                /* Google's reCAPTCHA library. The parameters indicate we'll defer it's loading and call onloadCallback
                 * when it finally loads. The reason for this is to avoid putting scripts in the page's HEAD, which is
                 * to the present date, a bad programming practice. */
                JavaScriptHandler::registerLone("", "src=\"//www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl={$this->language}\" async defer");
                JavaScriptHandler::registerLoose("
                    var onloadCallback = function() {
                        grecaptcha.render(\"reCaptchaContainer\", {
                            \"sitekey\" : \"{$this->settings->recaptchaSiteKey}\"
                        });
                    };
                    ");

                echo "<div id='reCaptchaContainer'></div>";
            }
            else
            {
                echo '
                    <div class="row-fluid">
                        <div class="captcha">
                            <img class="pull-left" src="'.DEFAULT_URL.'/includes/code/captcha.php" alt="'.system_showText(LANG_CAPTCHA_ALT).'" title="'.system_showText(LANG_CAPTCHA_TITLE).'" />
                            <input type="text" value="" name="captchatext" class="text span7 pull-right" />
                        </div>
                    </div>';
            }
        }

        /**
         * This will validate recaptcha to make sure the user has entered the right code.
         * @return boolean
         */
        public function validate()
        {
            $return = false;

            if( $this->isNew )
            {
                $request = file_get_contents("https://www.google.com/recaptcha/api/siteverify?secret={$this->settings->recaptchaSecretKey}&response={$_POST['g-recaptcha-response']}&remoteip={$_SERVER['REMOTE_ADDR']}");

                if( $response = json_decode($request) )
                {
                    $return = $response->success;
                }
            }
            else
            {
                $return = ( md5( $_POST["captchatext"] ) == $_SESSION["captchakey"] );
            }

            return (bool)$return;
        }
    }
