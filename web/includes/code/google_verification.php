<?

    /*==================================================================*\
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
    \*==================================================================*/

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /includes/code/google_verification.php
    # ----------------------------------------------------------------------------------------------------

    // Google Code
    $searchMetaObj = new SearchMetaTag( 'google' );
    $error = null;

    if ( $_POST["google_tag"] )
    {
        $domain = new Domain(SELECTED_DOMAIN_ID);
        if ( validate_form( "search_metatag", $_POST, $error ) )
        {
            $metatagaux = $_POST["google_tag"];
            $metatagaux = str_replace( "<META ", "<meta ", $metatagaux );
            $metatagaux = str_replace( " NAME=", " name=", $metatagaux );
            $metatagaux = str_replace( " CONTENT=", " content=", $metatagaux );

            if ( string_strpos( $metatagaux, "/>" ) === false )
            {
                $metatagaux = str_replace( ">", " />", $metatagaux );
            }
            $_POST["google_tag"] = $metatagaux;

            if ( $searchMetaObj->isSetField() )
            {
                $searchMetaObj->setString( 'value', $_POST["google_tag"] );
                $searchMetaObj->Save();
            }
            else
            {
                $searchMetaObj->setString( 'name', 'google' );
                $searchMetaObj->setString( 'value', $_POST["google_tag"] );
                $searchMetaObj->Save( false );
            }

            MessageHandler::registerSuccess( array( "SeoSettSucc" => system_showText(LANG_SITEMGR_SETTINGS_SEARCHVERIFY_MSGSUCCESS) ));
        }

    }
    else
    {
        $searchMetaObj->Delete();
    }