<?php
    /*==================================================================*\
    ######################################################################
    #                                                                    #
    # Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
    # * FILE: /sponsors/ajax.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../conf/loadconfig.inc.php");

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

    extract($_POST);

    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    if ($ajax_type == "setItemAsViewed") {

        if ($type == "review") {
            $itemObj = new Review($id);
        } elseif ($type == "lead") {
            $itemObj = new Lead($id);
        }
        $itemObj->setString("new", "n");
        $itemObj->save();

    } elseif ($ajax_type == "lead_reply") {

        extract($_POST);
        $isAjax = true;
        include(EDIRECTORY_ROOT."/includes/code/lead.php");

    } elseif ($ajax_type == "load_dashboard") {

        $acctId = sess_getAccountIdFromSession();

        if ($item_id) {
            $itemObj = new $item_type($item_id);

            //Prepare code for dashboard
            include(INCLUDES_DIR."/code/member_dashboard.php");

            //Build dashboard
            include(INCLUDES_DIR."/views/view_member_dashboard.php");

            JavaScriptHandler::render();
        }

    } elseif ($ajax_type == "review_reply") {

        if (string_strlen(trim($_POST["reply"])) > 0) {

            setting_get("review_approve", $review_approve);
            $responseapproved = 0;
            if (!$review_approve == "on") $responseapproved = 1;

            $reviewObj = new Review($_POST["idReview"]);
            $reviewObj->setString("response", trim($_POST["reply"]));
            $reviewObj->setString("responseapproved", $responseapproved);
            $reviewObj->save();

            /* send e-mail to sitemgr */
            setting_get("sitemgr_rate_email", $sitemgr_rate_email);
            $sitemgr_rate_emails = explode(",", $sitemgr_rate_email);

            $reviewObj = new Review($_POST["idReview"]);

            $domain = new Domain(SELECTED_DOMAIN_ID);
            $domain_url = DEFAULT_URL;
            $domain_url = str_replace($_SERVER["HTTP_HOST"],$domain->getstring("url"),$domain_url);

            // site manager warning message /////////////////////////////////////
            $emailSubject = "[".EDIRECTORY_TITLE."] ".system_showText(LANG_NOTIFY_NEWREPLY);
            $sitemgr_msg = system_showText(LANG_LABEL_SITE_MANAGER).",<br><br>"
                            ."".system_showText(LANG_NOTIFY_NEWREPLY_1)." <strong>" . $reviewObj->getString("review_title", true) . "</strong> ".system_showText(LANG_NOTIFY_NEWREPLY_2).".</strong><br><br>"
                            ."".system_showText(LANG_NOTIFY_NEWREPLY_3).":<br>"
                            ."<a href=\"".$domain_url."/".SITEMGR_ALIAS."/activity/reviews-comments/\" target=\"_blank\">".$domain_url."/".SITEMGR_ALIAS."/activity/reviews-comments/</a><br><br>"
                        ."</div>
                    </body>
                </html>";

            system_notifySitemgr($sitemgr_rate_emails, $emailSubject, $sitemgr_msg);

            /* */

            if ( !$review_approve == "on" )
            {
                if ( $reviewObj->getString( "item_type" ) == "listing" )
                {
                    $itemObj    = new Listing( $reviewObj->getNumber( "item_id" ) );
                    $contactObj = new Contact( $itemObj->getNumber( "account_id" ) );

                    if ( $emailNotificationObj = system_checkEmail( SYSTEM_APPROVE_REPLY ) )
                    {
                        $subject = $emailNotificationObj->getString( "subject" );
                        $subject = system_replaceEmailVariables( $subject, $itemObj->getNumber( "id" ), "listing" );
                        $subject = html_entity_decode( $subject );

                        $body = $emailNotificationObj->getString( "body" );
                        $body = system_replaceEmailVariables( $body, $itemObj->getNumber( "id" ), "listing" );
                        $body = html_entity_decode( $body );

                        Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                    }
                }

                if ( $reviewObj->getString( "item_type" ) == "article" )
                {
                    $itemObj    = new Article( $reviewObj->getNumber( "item_id" ) );
                    $contactObj = new Contact( $itemObj->getNumber( "account_id" ) );

                    if ( $emailNotificationObj = system_checkEmail( SYSTEM_APPROVE_REPLY ) )
                    {
                        $subject = $emailNotificationObj->getString( "subject" );
                        $subject = system_replaceEmailVariables( $subject, $itemObj->getNumber( "id" ), "article" );
                        $subject = html_entity_decode( $subject );

                        $body = $emailNotificationObj->getString( "body" );
                        $body = system_replaceEmailVariables( $body, $itemObj->getNumber( "id" ), "article" );
                        $body = html_entity_decode( $body );

                        Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                    }
                }

                if ( $reviewObj->getString( "item_type" ) == "promotion" )
                {
                    $itemObj    = new Promotion( $reviewObj->getNumber( "item_id" ) );
                    $contactObj = new Contact( $itemObj->getNumber( "account_id" ) );

                    if ( $emailNotificationObj = system_checkEmail( SYSTEM_APPROVE_REPLY ) )
                    {
                        $subject = $emailNotificationObj->getString( "subject" );
                        $subject = system_replaceEmailVariables( $subject, $itemObj->getNumber( "id" ), "promotion" );
                        $subject = html_entity_decode( $subject );

                        $body = $emailNotificationObj->getString( "body" );
                        $body = system_replaceEmailVariables( $body, $itemObj->getNumber( "id" ), "promotion" );
                        $body = html_entity_decode( $body );

                        Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                    }
                }
            }

            echo "ok";
        } else {
            echo "error";
        }

    } elseif ($ajax_type == "getunpaidItems") {

        include(INCLUDES_DIR."/code/billing.php");

        $toPayItems[] = "listings";
        $toPayItems[] = "events";
        $toPayItems[] = "banners";
        $toPayItems[] = "classifieds";
        $toPayItems[] = "articles";
        $toPayItems[] = "custominvoices";

        $countUnpaid = 0;

        foreach ($toPayItems as $toPayItem) {

            if ($bill_info[$toPayItem]) {

                if ($toPayItem == "custominvoices") {
                    $countUnpaid++;
                } else {
                    foreach($bill_info[$toPayItem] as $id => $info){
                        if ($info["needtocheckout"] == "y") {
                            $countUnpaid++;
                        }
                    }
                }
            }

        }

        echo $countUnpaid;

    } elseif ($ajax_type == "getFacebookImage") {

        $dbObj = db_getDBObject(DEFAULT_DB, true);
        $sql = " SELECT facebook_uid FROM Profile WHERE account_id = ".$_POST["id"];
        $result = $dbObj->query($sql);

        $row = mysql_fetch_assoc($result);
        $uid = $row["facebook_uid"];

        $imgURL = "https://graph.facebook.com/".$uid."/picture?type=large";

        $ch = curl_init($imgURL);
        curl_setopt($ch, CURLOPT_URL, $imgURL);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_USERAGENT, $agent);
        curl_setopt($ch, CURLOPT_REFERER, $ref);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HEADER, false);

        $data = curl_exec($ch);

        curl_close($ch);
        $filename = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/tmp/temp.".time();

        $fp = fopen($filename, "w+");
        fwrite($fp, $data);
        fclose($fp);

        $info = getimagesize($filename);

        @unlink($filename);
        image_getNewDimension(PROFILE_MEMBERS_IMAGE_WIDTH, PROFILE_MEMBERS_IMAGE_HEIGHT, $info[0], $info[1], $newWidth, $newHeight);

        echo $imgURL."[FBIMG]".$newWidth."[FBIMG]".$newHeight;

    }
