<?php

    class JavaScriptHandler
    {
        /**
         * JS files to be included at the bottom of the page
         * @var string[]
         */
        private static $files   = array();

        /**
         * Javascript code to be added to a jQuery $( document ).onReady()
         * event.
         * @var string[]
         */
        private static $onReady = array();

        /**
         * Javascript code to be added inside a <script> tag.
         * @var type
         */
        private static $loose   = array();

        /**
         * Javascript code to be added inside it's own <script> tag.
         * @var type
         */
        private static $lone   = array();

        /**
         * Adds $js to the $lone static array
         *
         * Each entry will be added to the page's footer
         * inside its own <script> tag with custom parameters
         *
         * @param string $js
         * @param string $tagAttributes
         */
        public static function registerLone( $js, $tagAttributes )
        {
            if( is_array( $js ) )
            {
                self::$lone = array_merge( self::$lone, $js );
            }
            else if( is_string( $js ) )
            {
                self::$lone[] = array(
                    "code"       => $js,
                    "attributes" => $tagAttributes
                );
            }
        }

        /**
         * Adds $js to the OnReady static array
         *
         * These will be added to the page's footer
         * inside a jQuery $( document ).onReady()
         * anonymous function.
         *
         * @param string $js
         */
        public static function registerOnReady( $js )
        {
            if( is_array( $js ) )
            {
                self::$onReady = array_merge( self::$onReady, $js );
            }
            else if( is_string( $js ) )
            {

                self::$onReady[] = $js;
            }
        }

        /**
         * Adds $js to the files static array
         *
         * These will be added to the page's footer
         * as: <script src="$js"></script>
         *
         * @param string $js
         */
        public static function registerFile( $js )
        {
            if( is_array( $js ) )
            {
                self::$files = array_merge( self::$files, $js );
            }
            else if( is_string( $js ) )
            {

                self::$files[] = $js;
            }
        }

        /**
         * Adds $js to the loose static array
         *
         * These will be added to the page's footer
         * as: <script> $js </script>
         *
         * @param string $js
         */
        public static function registerLoose( $js )
        {
            if( is_array( $js ) )
            {
                self::$loose = array_merge( self::$loose, $js );
            }
            else if( is_string( $js ) )
            {

                self::$loose[] = $js;
            }
        }

        /**
         * Renders all $lone as individual script tags
         */
        public static function renderLoneJS()
        {
            if ( !empty( self::$lone ) )
            {
                foreach ( self::$lone as $loneArray )
                {
                    echo "<script {$loneArray["attributes"]}>{$loneArray['code']}</script>";
                }
            }
        }

        /**
         * Renders all $files as script includes
         */
        public static function renderFilesJS()
        {
            if ( !empty( self::$files ) )
            {
                foreach ( self::$files as $file )
                {
                    echo "<script src=\"{$file}\"></script>";
                }
            }
        }

        /**
         * renders all $onReady inside a jQuery $( document ).onReady()
         * annonymous function.
         */
        public static function renderonReadyJS()
        {
            if ( !empty( self::$onReady ) )
            {
                echo "<script>\n".
                     "    $(document).ready(function(){ ";
                foreach ( self::$onReady as $js )
                {
                    echo $js;
                }
                echo "    });\n".
                     "</script>";
            }
        }

        /**
         * renders all $loose js inside a <script> tag
         */
        public static function renderLooseJS()
        {
            if ( !empty( self::$loose ) )
            {
                echo "<script>";
                foreach ( self::$loose as $js )
                {
                    echo $js;
                }
                echo '</script>';
            }
        }

        /**
         * Renders all stored javascript in its appropriate formats
         */
        public static function render()
        {
            self::renderFilesJS();
            self::renderLoneJS();
            self::renderLooseJS();
            self::renderonReadyJS();
        }

    }
