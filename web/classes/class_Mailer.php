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
    # * FILE: /classes/class_eDirMailer.php
    # ----------------------------------------------------------------------------------------------------

    require_once CLASSES_DIR . '/phpmailer/PHPMailerAutoload.php';

    class Mailer
    {
        /**
         * The PHPMailer instance.
         * @var PHPMailer
         */
        private $phpMailer;

        public $mailingMethod;
        public $secureAuthentication;

        public static $languageLibrary = array(
            "pt_br" => "br",
            "ge_ge" => "de",
            "en_us" => "en",
            "es_es" => "es",
            "fr_fr" => "fr",
            "it_it" => "it",
            "tr_tr" => "tr",
        );

        function __construct()
        {
            $this->phpMailer = new PHPMailer( true );

            /* Checks whether to use mail() or SMTP */
            if( setting_get( 'emailconf_method', $this->mailingMethod ) && $this->mailingMethod == "smtp" )
            {
                $this->phpMailer->IsSMTP();
                setting_get( 'emailconf_host', $this->phpMailer->Host );

                /* Checks whether to use Authentication */
                if ( setting_get( 'emailconf_auth', $this->secureAuthentication ) && $this->secureAuthentication != 'noauth' )
                {
                    $this->phpMailer->SMTPAuth = true;

                    setting_get( 'emailconf_port',     $this->phpMailer->Port );
                    setting_get( 'emailconf_username', $this->phpMailer->Username );

                    $password = null;
                    setting_get( 'emailconf_password', $password );
                    $password and $this->phpMailer->Password = crypt_decrypt( $password );

                    /* Checks whether to use Secure Authentication */
                    $protocol = "";
                    if( $this->secureAuthentication == "secure" )
                    {
                        setting_get( 'emailconf_protocol', $protocol );
                        /* Protocol defaults to SSL if unset */
                        $protocol or $protocol = "ssl";
                    }
                    $this->phpMailer->SMTPSecure = $protocol;
                }
            }
            else
            {
                $this->phpMailer->isMail();
            }

            /* Retrieves the default sender email */
            $senderEmail = null;
            if( setting_get( 'emailconf_email', $senderEmail ) or setting_get( 'sitemgr_email', $senderEmail ) )
            {
                /* We only want the first email, so filter everything after the comma */
                $senderEmail = preg_replace( "/\,(.)*/i", "", $senderEmail );
                $this->phpMailer->setFrom( $senderEmail, EDIRECTORY_TITLE );
            }

            /* Set mail character Encoding */
            $this->phpMailer->CharSet = "UTF-8";

            /* If no language file is found, it defaults to english */
            $this->phpMailer->setLanguage( self::$languageLibrary[EDIR_LANGUAGE] );
        }

        private function addRecipient( $recipientEmails, $function )
        {
            if( is_array( $recipientEmails ) )
            {
                foreach ( $recipientEmails as $name => $email )
                {
                    if ( is_string( $email ) )
                    {
                        call_user_func( array( $this->phpMailer, $function ), $email, ( is_string( $name ) ? ucwords( strtolower($name)) : null ) );
                    }
                }
            }
            else if ( is_string( $recipientEmails ) )
            {
                if( strpos( $recipientEmails, ',' ) === false )
                {
                    call_user_func( array( $this->phpMailer, $function ), $recipientEmails );
                }
                else
                {
                    $this->addRecipient( explode(',', $recipientEmails ), $function);
                }
            }
        }

        public function addTo( $recipientEmails )
        {
            $this->addRecipient($recipientEmails, "addAddress");
        }

        public function addCC( $recipientEmails )
        {
            $this->addRecipient($recipientEmails, "addCC");
        }

        public function addBCC( $recipientEmails )
        {
            $this->addRecipient($recipientEmails, "addBCC");
        }

        public function sendMail( $recipientEmails, $subject, $body, $isHTML = false, $ccRecipients = null, $bccRecipients = null, $replyTo = null, $replyName = null )
        {
            $result = false;

            if( !empty( $recipientEmails ) && !empty( $subject ) && !empty( $body ) )
            {
                /* Loads emissor and all recipients */
                $this->addTo( $recipientEmails );

                $ccRecipients  and $this->addCC( $ccRecipients );
                $bccRecipients and $this->addBCC( $bccRecipients );
                $replyTo and $this->phpMailer->addReplyTo( $replyTo, $replyName );

                /* Set subject and mail body*/
                $this->phpMailer->Subject = $subject;

                if( $isHTML )
                {
                   $this->phpMailer->msgHTML( $body );
                }
                else
                {
                    /* Swaps all <br> tags for new lines \n */
                    $this->phpMailer->Body = preg_replace( "/\<br(\s)*\/?\>/i", "\n", $body );
                }

                $result = $this->phpMailer->send();
            }

            return $result;
        }

        public static function mail( $recipientEmails, $subject, $body, $isHTML = false, $ccRecipients = null, $bccRecipients = null, $replyTo = null, $replyName = null, $attachPath = null, $attachName = null )
        {
            $return = false;

            is_bool( $isHTML ) or $isHTML = ($isHTML == "text/html");

            try
            {
                $mailer = new Mailer();
                $attachPath and $attachName and $mailer->phpMailer->addAttachment( $attachPath, $attachName );
                $return = $mailer->sendMail( $recipientEmails, $subject, $body, $isHTML, $ccRecipients, $bccRecipients, $replyTo, $replyName );
            }
            catch ( Exception $e )
            {
            }
            /**
             * <Lucas Trentim (2015)>
             * @todo: We could create an error handling system in the future where exceptions
             * such as these would be caught and logged to a table.
             */

            return $return;
        }

        public static function mailSiteManager( $subject, $body, $isHTML = false, $replyTo = null, $replyName = null, $attachPath = null, $attachName = null )
        {
            $return           = false;
            $siteManagerEmail = null;

            if( setting_get( 'sitemgr_email', $siteManagerEmail ) )
            {
                $return = self::mail($siteManagerEmail, $subject, $body, $isHTML, null, null, $replyTo, $replyName, $attachPath, $attachName);
            }

            return $return;
        }
    }
