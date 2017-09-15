<?php

    class LocalizedError
    {
        /**
         * The field HTML 'name' attribute in which the errors will be shown
         * @var string
         */
        private $field        = null;
        /**
         * The error message
         * @var string
         */
        private $message      = null;
        /**
         * Any classes to be added to the bootstrap form-group element in which
         * this input is contained
         * @var type
         */
        private $classes      = array();

        public function __construct( $field, $message, $classes = 'has-error' )
        {
            $this->field = $field;
            $this->message = $message;
            $this->addClass($classes);
        }

        /**
         * Adds a class to the class array
         *
         * @param string/array $class A String or an array of strings to be fed.
         * @param array $array The array in which the message(s) will be saved.
         */
        public function addClass( $class )
        {
            if ( is_array( $class ) )
            {
                $this->classes = array_merge( $this->classes, $class );
            }
            else
            {
                $this->classes[] = $class;
            }
        }

        /**
         * Renders the error message into a javascript code which will be run on page load
         * and automatically disappear after the user reads it.
         *
         * @return string The Javascript code
         */
        public function getJavascript()
        {
            static $number = 1;
            static $totalReadingTime = 0;
            $javascriptCode = null;

            /* each popover will appear separatedly, one after the other */
            $delayShow = $number++ * 250 + 1500;

            /* the time it will stay on screen deppends on how much text
             * the user will (presumably) read
             * The average is 75 miliseconds per letter.
             * One extra second is added to extend.
             */
            $totalReadingTime += strlen($this->message) * 75;

            $delayHide = $delayShow + $totalReadingTime + 1000;

            $classes = implode(" ", $this->classes);
            $javascriptCode .= "$('#{$this->field}').parent('.form-group').addClass( '{$classes}' );
                                $('#{$this->field}').parent('.form-group').on('shown.bs.popover', function() {
                                    setTimeout(function() {
                                        $('#{$this->field}').parent('.form-group').popover('hide');
                                    }, {$delayHide});
                                });
                                $('#{$this->field}').parent('.form-group').popover({
                                    container : 'body',
                                    content   : '{$this->message}',
                                    placement : 'auto right',
                                    trigger   : 'hover',
                                    html      : true
                                });

                                $('#{$this->field}').focusout( function(){
                                    $('#{$this->field}').parent('.form-group').popover('destroy');
                                    $('#{$this->field}').parent('.form-group').removeClass( '{$classes}' );
                                });

                                setTimeout(function() {
                                    $('#{$this->field}').parent('.form-group').popover('show');
                                }, {$delayShow});";

            return $javascriptCode;
        }
    }