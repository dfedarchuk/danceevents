<?php

    if ( version_compare( PHP_VERSION, '5.1.2', '>=' ) )
    {
        if ( version_compare( PHP_VERSION, '5.3.0', '>=' ) )
        {
            spl_autoload_register( 'eDirectoryAutoload', true, true );
        }
        else
        {
            spl_autoload_register( 'eDirectoryAutoload' );
        }
    }
    else
    {
        function __autoload( $classname )
        {
            eDirectoryAutoload( $classname );
        }
    }

    function eDirectoryAutoload( $classname )
    {
        static $s = DIRECTORY_SEPARATOR;

        $filename = dirname( __FILE__ ) . $s . "class_" . $classname . ".php";

        if ( is_readable( $filename ) )
        {
            require $filename;
        }
    }
