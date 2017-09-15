<?php
    /**
     * MessageHandler
     *
     * Static class, contains methods to store and display messages.
     */
    class MessageHandler
    {
        public static $successMessages = array();
        public static $warningMessages = array();
        public static $errorMessages   = array();

        public static $successBoxHeader = LANG_SITEMGR_MESSAGEHANDLER_HEADER_SUCCESS;
        public static $warningBoxHeader = LANG_SITEMGR_MESSAGEHANDLER_HEADER_WARNING;
        public static $errorBoxHeader   = LANG_SITEMGR_MESSAGEHANDLER_HEADER_ERROR;

        public static function haveErrors()
        {
            return !empty( self::$errorMessages );
        }

        /**
         * Feeds an array with a string,
         *
         * @param string/array $message A String or an array of strings to be fed.
         * @param array $array The array in which the message(s) will be saved.
         */
        private static function feedArray( $message, &$array )
        { 
            if( !empty( $message ) )
            {
                if ( is_array( $message ) )
                {
                    $array = array_merge( $array, $message );
                }
                else
                {
                    $array[] = $message;
                }
            }
        }

        /**
         * Registers one string or an array of string into the error messages
         * to be shown.
         *
         * @param string/array $errorMessage A String or an array of strings to be fed.
         */
        public static function registerError( $errorMessage )
        {
            self::feedArray($errorMessage, self::$errorMessages);
        }

        /**
         * Registers one or an array of \LocalizedError Objects
         *
         * @param string/array $errorMessage one or an array of \LocalizedError
         */
        public static function registerLocalizedError( $field, $message, $classes = null, $canClose = true )
        {
            $localizedError = new LocalizedError($field, $message, $classes, $canClose);
            self::feedArray($localizedError, self::$errorMessages);
        }

        /**
         * Prints all errors in a Bootstrap alert div with alert-danger class
         */
        public static function printErrors()
        {
            if ( !empty( self::$errorMessages ) )
            {
                echo '<div class="alert alert-danger" id="errormsgbox">'
                . '<strong>'. self::$errorBoxHeader . '</strong><br>';

                foreach ( self::$errorMessages as $message )
                {
                    if ( is_a( $message, "LocalizedError" ) )
                    {
                        JavaScriptHandler::registerOnReady( $message->getJavascript() );
                    }
                    else
                    {
                        echo "{$message}<br>";
                    }
                }

                echo '</div>';
            }
        }

        /**
         * Registers one string or an array of string into the warning messages
         * to be shown.
         *
         * @param string/array $warningMessage A String or an array of strings to be fed.
         */
        public static function registerWarning( $warningMessage )
        {
            self::feedArray($warningMessage, self::$warningMessages);
        }

        /**
         * Prints all warnings in a Bootstrap alert div with alert-warning class
         */
        public static function printWarning()
        {
            if ( !empty( self::$warningMessages ) )
            {
                echo '<div class="alert alert-warning" id="warningmsgbox">'
                . '<strong>'. self::$warningBoxHeader . '</strong><br>';

                foreach ( self::$warningMessages as $message )
                {
                    echo "{$message}<br>";
                }

                echo '</div>';
            }
        }

        /**
         * Registers one string or an array of string into the success messages
         * to be shown.
         *
         * @param string/array $successMessage A String or an array of strings to be fed.
         */
        public static function registerSuccess( $successMessage )
        {
            self::feedArray($successMessage, self::$successMessages);
        }

        /**
         * Prints all messages in a Bootstrap alert div with alert-success class
         */
        public static function printSuccess()
        {
            if ( !empty( self::$successMessages ) )
            {
                echo '<div class="alert alert-success" id="successmsgbox">'
                . '<strong>'. self::$successBoxHeader . '</strong><br>';

                foreach ( self::$successMessages as $message )
                {
                    echo "{$message}<br>";
                }

                echo '</div>';
            }
        }

        public static function hasThingsToDisplay()
        {
            return !empty( self::$errorMessages ) || !empty( self::$warningMessages ) || !empty( self::$successMessages );
        }

        /**
         * Renders all errors, warnings and success messages inside a
         * div with class container
         */
        public static function render( $withScroll = false )
        {
            if( self::hasThingsToDisplay() )
            {
                self::printErrors();
                self::printWarning();
                self::printSuccess();

                $withScroll and JavaScriptHandler::registerOnReady("$(\"html,body\").animate({ scrollTop: $(\".alert\").first().offset().top - $(\"#main-navbar\").height() - 10 }, 'slow');");
            }
        }

        public static function serialize()
        {
            if ( session_id() == '' || !isset( $_SESSION ) )
            {
                // session isn't started
                session_start();
            }

            $_SESSION["MessageHandler"]["Error"]   = serialize( self::$errorMessages );
            $_SESSION["MessageHandler"]["Success"] = serialize( self::$successMessages );
            $_SESSION["MessageHandler"]["Warning"] = serialize( self::$warningMessages );
        }

        public static function unserialize()
        {
            if ( session_id() == '' || !isset( $_SESSION ) )
            {
                // session isn't started
                session_start();
            }

            if( !empty($_SESSION["MessageHandler"]) )
            {

                $error   = unserialize( $_SESSION["MessageHandler"]["Error"] );
                $success = unserialize( $_SESSION["MessageHandler"]["Success"] );
                $warning = unserialize( $_SESSION["MessageHandler"]["Warning"]);

                if( is_array( $error ) )
                {
                    self::$errorMessages   = array_merge( self::$errorMessages, $error );
                }

                if( is_array( $success ) )
                {
                    self::$successMessages = array_merge( self::$successMessages, $success );
                }

                if( is_array( $warning ) )
                {
                    self::$warningMessages = array_merge( self::$warningMessages, $warning );
                }

                unset( $_SESSION["MessageHandler"] );
            }
        }

    }