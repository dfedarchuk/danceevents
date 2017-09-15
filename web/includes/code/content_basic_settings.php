<?php
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
    # * FILE: /includes/code/content_basic_settings.php
    # ----------------------------------------------------------------------------------------------------

    if ( $_SERVER['REQUEST_METHOD'] == "POST" && !DEMO_LIVE_MODE )
    {
        /* fixing urls if needed. */
        if (trim($setting_facebook_link) != "")
        {
			if (string_strpos($setting_facebook_link, "://") === false)
            {
				$setting_facebook_link = "https://".$setting_facebook_link;
			}
		}

        if (trim($setting_linkedin_link) != "")
        {
			if (string_strpos($setting_linkedin_link, "://") === false)
            {
				$setting_linkedin_link = "https://".$setting_linkedin_link;
			}
		}

        if (trim($setting_instagram_link) != "")
        {
            if (string_strpos($setting_instagram_link, "://") === false)
            {
                $setting_instagram_link = "https://".$setting_instagram_link;
            }
        }

        if (trim($setting_googleplus_link) != "")
        {
            if (string_strpos($setting_googleplus_link, "://") === false)
            {
                $setting_googleplus_link = "https://".$setting_googleplus_link;
            }
        }

        if (trim($setting_pinterest_link) != "")
        {
            if (string_strpos($setting_pinterest_link, "://") === false)
            {
                $setting_pinterest_link = "https://".$setting_pinterest_link;
            }
        }

        customtext_set( "header_title", $header_title )                   or customtext_new( "header_title", $header_title )                   or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        customtext_set( "header_author", $header_author )                 or customtext_new( "header_author", $header_author )                 or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        customtext_set( "header_description", $header_description )       or customtext_new( "header_description", $header_description )       or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        customtext_set( "header_keywords", $header_keywords )             or customtext_new( "header_keywords", $header_keywords )             or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        customtext_set( "footer_copyright", $copyright )                  or customtext_new( "footer_copyright", $copyright )                  or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "setting_facebook_link", $setting_facebook_link )    or setting_new( "setting_facebook_link", $setting_facebook_link ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "setting_linkedin_link", $setting_linkedin_link )    or setting_new( "setting_linkedin_link", $setting_linkedin_link ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "twitter_account", $twitter_account )                or setting_new( "twitter_account", $twitter_account )                or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "setting_instagram_link", $setting_instagram_link )  or setting_new( "setting_instagram_link", $setting_instagram_link ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "setting_googleplus_link", $setting_googleplus_link )          or setting_new( "setting_googleplus_link", $setting_googleplus_link ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );
        setting_set( "setting_pinterest_link", $setting_pinterest_link )  or setting_new( "setting_pinterest_link", $setting_pinterest_link ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );

        $domain = new Domain(SELECTED_DOMAIN_ID);

        /* Writes new header title to config file. */
        if ( !MessageHandler::haveErrors() && ( $header_title = trim( $header_title ) ) )
        {
            $fileConstPath       = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/conf/constants.inc.php";
            system_writeConstantsFile( $fileConstPath, SELECTED_DOMAIN_ID, array( "name" => $header_title ) ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );

            // saves name site in yml file
            $classSymfonyYml = new Symfony('domain.yml');
            $theme_domain = array(
                'multi_domain' => array(
                    'hosts' => array(
                        $domain->getString('url') => array(
                            'title' => $header_title,
                        )
                    )
                )
            );
            $classSymfonyYml->save('Configs', $theme_domain);
            unset($classSymfonyYml);
        }

        if ( $_FILES["header_image"]["tmp_name"] && $_FILES["header_image"]["error"] == 0 )
        {
            $filename     = EDIRECTORY_ROOT.IMAGE_HEADER_PATH;
            $image_upload = image_uploadForHeader( $filename, $_FILES["header_image"]["tmp_name"] );
            $image_upload["success"] or MessageHandler::registerError( system_showText( LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE2 ) );

            // @todo image cte
            $classSymfonyYml = new Symfony('domains/'.$domain->getString('url').'.configs.yml');
            $classSymfonyYml->save('Configs', array('parameters' => array(
                'domain.header.image' => IMAGE_HEADER_PATH
            )));
            unset($classSymfonyYml);
        }

        /* noimage image file */
        if ( $_FILES["noimage_image"]["tmp_name"] && $_FILES["noimage_image"]["error"] == 0 )
        {
            $filename = EDIRECTORY_ROOT.NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT;
            $image_upload = image_uploadForNoImage( $filename, $_FILES["noimage_image"]["tmp_name"] );
            $image_upload["success"] or MessageHandler::registerError( system_showText( LANG_SITEMGR_MSGERROR_ALERTUPLOADIMAGE2 ) );

            // adds no image
            // @todo image cte
            $domain = new Domain(SELECTED_DOMAIN_ID);
            $classSymfonyYml = new Symfony('domains/'.$domain->getString('url').'.configs.yml');
            $classSymfonyYml->save('Configs', array('parameters' => array(
                'domain.noimage' => NOIMAGE_PATH."/".NOIMAGE_NAME.".".NOIMAGE_IMGEXT
            )));

        }


        if ( $_FILES['favicon_file']['name'] )
        {
            $arr_favicon         = explode( ".", $_FILES['favicon_file']['name'] );
            $favicon_extension   = $arr_favicon[count( $arr_favicon ) - 1];

            if( string_strtolower( $favicon_extension ) == "ico" )
            {
                setting_get( "last_favicon_id", $last_favicon_id );
                $last_favicon_id or ( $last_favicon_id = "1" and setting_new( "last_favicon_id", "1" ) );

                // FAVICON FILE UPLOAD
                if ( file_exists( $_FILES['favicon_file']['tmp_name'] ) && filesize( $_FILES['favicon_file']['tmp_name'] ) )
                {
                    /* Let's open it and check if there is php code inside*/
                    if ( $handle = fopen( $_FILES['favicon_file']['tmp_name'], "r" ) )
                    {
                        while ( ($line = fgets( $handle )) !== false )
                        {
                            if( strpos( $line, "<?") !== false || strpos( $line, "<script") !== false )
                            {
                                MessageHandler::registerError( system_showText( LANG_MSGERROR_ERRORUPLOADINGIMAGE ) );
                                break;
                            }
                        }
                    }
                    fclose( $handle );

                    if( !MessageHandler::haveErrors() )
                    {
                        if ( file_exists( EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico" ) )
                        {
                            @unlink( EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico" );
                        }
                        $last_favicon_id++;

                        $file_path = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico";

                        // adds favicon
                        // @todo image cte
                        $domain = new Domain(SELECTED_DOMAIN_ID);
                        $classSymfonyYml = new Symfony('domains/'.$domain->getString('url').'.configs.yml');
                        $classSymfonyYml->save('Configs', array('parameters' => array(
                            'domain.favicon' => "/custom/domain_".SELECTED_DOMAIN_ID."/content_files/favicon_".$last_favicon_id.".ico"
                        )));
                        unset($classSymfonyYml);

                        copy( $_FILES['favicon_file']['tmp_name'], $file_path );
                        setting_set( "last_favicon_id", $last_favicon_id );
                    }
                }
                else
                {
                    MessageHandler::registerError( system_showText( LANG_MSGERROR_ERRORUPLOADINGIMAGE ) );
                }
            }
            else
            {
                MessageHandler::registerError( system_showText( LANG_UPLOAD_MSG_NOTALLOWED_WRONGFILETYPE." ".LANG_MSG_ALLOWED_FILE_TYPES.": <b>.ico</b>" ) );
            }
        }

        if ($contact_email)
        {
            if (!validate_email($contact_email))
            {
                MessageHandler::registerError( system_showText( LANG_MSG_ENTER_VALID_EMAIL_ADDRESS ) );
            }
        }

        if( !MessageHandler::haveErrors() )
        {
            $contactInfo = array(
                "contact_company",
                "contact_address",
                "contact_zipcode",
                "contact_country",
                "contact_state",
                "contact_city",
                "contact_phone",
                "contact_fax",
                "contact_email",
                "contact_mapzoom",
                "contact_latitude",
                "contact_longitude"
            );

            $contactArray = array();
            foreach ( $contactInfo as $info )
            {
                setting_set( $info, $$info ) or setting_new( $info, $$info ) or MessageHandler::registerError( array( "DBerror" => system_showText( LANG_SITEMGR_SETTINGS_PAYMENTS_GATEWAY_ERROR_DATABASE ) ) );

                $contactArray['domain.'.str_replace('_','.',$info)] = $$info;
            }
        }

        MessageHandler::haveErrors() or MessageHandler::registerSuccess( LANG_SITEMGR_SETTINGS_GENERAL_HEADER_SUCCESS );
    }

    # ----------------------------------------------------------------------------------------------------
    # FORMS DEFINES
    # ----------------------------------------------------------------------------------------------------

    customtext_get( "header_title", $header_title );
    customtext_get( "header_author", $header_author );
    customtext_get( "header_description", $header_description );
    customtext_get( "header_keywords", $header_keywords );
    customtext_get( "footer_copyright", $copyright );
    setting_get( "setting_linkedin_link", $setting_linkedin_link );
    setting_get( "setting_facebook_link", $setting_facebook_link );
    setting_get( "twitter_account", $twitter_account );
    setting_get( "setting_instagram_link", $setting_instagram_link );
    setting_get( "setting_googleplus_link", $setting_googleplus_link );
    setting_get( "setting_pinterest_link", $setting_pinterest_link );


    setting_get("last_favicon_id", $last_favicon_id);

    if (!$last_favicon_id){
        setting_new("last_favicon_id", "1");
        $last_favicon_id = "1";
    }

    setting_get( "contact_company", $contact_company );
    setting_get( "contact_address", $contact_address );
    setting_get( "contact_zipcode", $contact_zipcode );
    setting_get( "contact_country", $contact_country );
    setting_get( "contact_state", $contact_state );
    setting_get( "contact_city", $contact_city );
    setting_get( "contact_phone", $contact_phone );
    setting_get( "contact_fax", $contact_fax );
    setting_get( "contact_email", $contact_email );
    setting_get( "contact_latitude", $contact_latitude );
    setting_get( "contact_longitude", $contact_longitude );
    setting_get( "contact_mapzoom", $contact_mapzoom );
//    $map_zoom = $contact_mapzoom;

    //Map Control
    $loadMap = false;
    $mapObj  = new GoogleSettings(SELECTED_DOMAIN_ID);

    if ( GOOGLE_MAPS_ENABLED == "on" && $mapObj->mapsStatus == "on" ) {
        $loadMap = true;
        $hasValidCoord = false;

        if ( $contact_latitude && $contact_longitude && is_numeric( $contact_latitude ) && is_numeric( $contact_longitude ) )
        {
            $hasValidCoord = true;
        }

    }

