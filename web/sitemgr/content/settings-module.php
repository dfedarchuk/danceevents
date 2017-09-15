<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/content/settings-module.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	if (isset($_GET["domain_id"])) define("SELECTED_DOMAIN_ID", $_GET["domain_id"]);
	if (isset($_POST["domain_id"])) define("SELECTED_DOMAIN_ID", $_POST["domain_id"]);
    $loadSitemgrLangs = true;
    include("../../conf/loadconfig.inc.php");

    header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
	header("Accept-Encoding: gzip, deflate");
	header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check", FALSE);
	header("Pragma: no-cache");

    # ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    extract($_GET);
    extract($_POST);

    if (!$id) {
        echo "error";
        exit;
    }

    switch ($manageModule) {
        case "listing":     $moduleObj = new Listing($id);
                            $levelObj = new ListingLevel();
                            $logObjStr = "PaymentListingLog";
                            $emailNotifType = SYSTEM_ACTIVE_LISTING;
                            break;

        case "banner":      $moduleObj = new Banner($id);
                            $levelObj = new BannerLevel();
                             $logObjStr = "PaymentBannerLog";
                             $emailNotifType = SYSTEM_ACTIVE_BANNER;
                            break;

        case "event":       $moduleObj = new Event($id);
                            $levelObj = new EventLevel();
                            $logObjStr = "PaymentEventLog";
                            $emailNotifType = SYSTEM_ACTIVE_EVENT;
                            break;

        case "classified":  $moduleObj = new Classified($id);
                            $levelObj = new ClassifiedLevel();
                            $logObjStr = "PaymentClassifiedLog";
                            $emailNotifType = SYSTEM_ACTIVE_CLASSIFIED;
                            break;

        case "article":     $moduleObj = new Article($id);
                            $levelObj = new ArticleLevel();
                            $logObjStr = "PaymentArticleLog";
                            $emailNotifType = SYSTEM_ACTIVE_ARTICLE;
                            break;

        case "blog":        $moduleObj = new Post($id);
                            break;
    }

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
    if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if ($manageModule != "blog") {

            if ($_POST["amount"]) $_POST["amount"] = format_money($_POST["amount"]);
            else $_POST["amount"] = false;

            if ($hasrenewaldate == "no") {
                unset($_POST['renewal_date']);
            }

        }

		if (validate_form($manageModule."settings", $_POST, $message_modulesettings)) {

			$moduleObj->setString("status", $_POST['status']);

            if ($manageModule != "blog") {
                $moduleObj->setDate("renewal_date", $_POST['renewal_date']);
            }

            if ($manageModule == "banner") {
                $moduleObj->setNumber("impressions", $_POST['impressions']);
                $moduleObj->setString("expiration_setting", $_POST['expiration_setting']);
            }

            if ($manageModule != "blog") {
                if (!$moduleObj->hasRenewalDate()) {
                    $moduleObj->setString("renewal_date", "0000-00-00");
                }
            }

            if ($manageModule == "banner") {
                if (!$moduleObj->hasImpressions()) {
                    $moduleObj->setNumber("unpaid_impressions", 0);
                    $moduleObj->setString("unlimited_impressions", "y");
                } else {
                    $moduleObj->setString("unlimited_impressions", "n");
                }
                $moduleObj->setNumber("unpaid_impressions", 0);
            }

			$moduleObj->Save();

			if ($_POST["add_transaction"] == 1 && $manageModule != "blog") {

				$accountObj = new Account($_POST["account_id"]);
				$contactObj = new Contact($_POST["account_id"]);

                if ($manageModule == "listing") {
                    // retrieving categories related with listing
                    $dbMain = db_getDBObject(DEFAULT_DB, true);
                    $db = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);

                    $category_amount = 0;
                    $sql = "SELECT category_id FROM Listing_Category WHERE listing_id = ".$moduleObj->getNumber("id");
                    $result = $db->query($sql);
                    if(mysql_num_rows($result)){
                        while($row = mysql_fetch_assoc($result)){
                            $category_amount++;
                        }

                    }
                }

				$log["account_id"]				= $_POST["account_id"];
				$log["username"]				= $accountObj->getString("username");;
				$log["ip"]						= $_SERVER["REMOTE_ADDR"];
				$log["transaction_id"]			= "MAN_".string_strtoupper(uniqid(""));
				$log["transaction_status"]		= MANUAL_STATUS;
				$log["transaction_datetime"]	= date("Y-m-d H:i:s");
				$log["transaction_amount"]		= str_replace(",", "", $_POST["amount"]);
				$log["transaction_currency"]	= MANUAL_CURRENCY;
				$log["system_type"]				= "manual";
				$log["notes"]					= $_POST["notes"];

				$paymentLogObj = new PaymentLog($log);
				$paymentLogObj->Save(SELECTED_DOMAIN_ID);

				$payment_module_log["payment_log_id"]      = $paymentLogObj->getString("id");
				$payment_module_log[$manageModule."_id"]   = $moduleObj->getString("id");
				$payment_module_log[($manageModule == "banner" ? "banner_caption" : $manageModule."_title")] = $moduleObj->getString($manageModule == "banner" ? "caption" : "title", false);
				$payment_module_log["discount_id"]         = $moduleObj->getString("discount_id");
				$payment_module_log["level"]               = $moduleObj->getString("level");
				$payment_module_log["level_label"]         = $levelObj->getName($moduleObj->getString("level"));
				$payment_module_log["renewal_date"]        = $moduleObj->getString("renewal_date");
				$payment_module_log["amount"]              = str_replace(",", "", $_POST["amount"]);

                if ($manageModule == "listing") {
                    $payment_module_log["categories"] = $category_amount;
                    $payment_module_log["extra_categories"] = 0;

                    if (($category_amount > 0) && (($category_amount - $levelObj->getFreeCategory($moduleObj->getString("level"))) > 0)) {
                        $payment_module_log["extra_categories"] = $category_amount - $levelObj->getFreeCategory($moduleObj->getString("level"));
                    } else {
                        $payment_module_log["extra_categories"] = 0;
                    }

                    $payment_module_log["listingtemplate_title"] = "";
                    if (LISTINGTEMPLATE_FEATURE == "on" && CUSTOM_LISTINGTEMPLATE_FEATURE == "on") {
                        if ($moduleObj->getString("listingtemplate_id")) {
                            $listingTemplateObj = new ListingTemplate($moduleObj->getString("listingtemplate_id"));
                            $payment_module_log["listingtemplate_title"] = $listingTemplateObj->getString("title", false);
                        }
                    }
                }

                if ($manageModule == "banner") {
                    $payment_module_log["impressions"] = $moduleObj->getString("impressions");
                }

				$paymentLogObj = new $logObjStr($payment_module_log);
				$paymentLogObj->Save();

			}

			# ------------------------------------------------------------------------------
			# SENDING EMAIL OF ACTIVATION TO MEMBER
			# ------------------------------------------------------------------------------
			if ( $_POST['email_notification'] == 1 && $_POST['status'] == "A" && $manageModule != "blog" )
            {
                if ( $moduleObj->getNumber( "account_id" ) > 0 )
                {
                    $contactObj = new Contact( $moduleObj->getNumber( "account_id" ) );

                    if ( $emailNotificationObj = system_checkEmail( $emailNotifType ) )
                    {
                        $domain = new Domain( SELECTED_DOMAIN_ID );

                        $subject = $emailNotificationObj->getString( "subject" );
                        $subject = system_replaceEmailVariables( $subject, $moduleObj->getNumber( 'id' ), $manageModule );
                        $subject = html_entity_decode( $subject );

                        $body = $emailNotificationObj->getString( "body" );
                        $body = system_replaceEmailVariables( $body, $moduleObj->getNumber( 'id' ), $manageModule );
                        $body = str_replace( $_SERVER["HTTP_HOST"], $domain->getstring( "url" ), $body );
                        $body = html_entity_decode( $body );

                        Mailer::mail( $contactObj->getString( "email" ), $subject, $body, $emailNotificationObj->getString( "content_type" ), null, $emailNotificationObj->getString( "bcc" ) );
                    }
                }
            }

            echo "1";
            exit;

		} else {
            echo $message_modulesettings;
            exit;
        }

	}

    # ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	$renewal_date = $moduleObj->getDate("renewal_date");

	// Status Drop Down
    if ($manageModule == "blog") {
        unset($arrayValueDD);
        unset($arrayNameDD);
        $arrayNameDD = Array("Active", "Suspended", "Pending");
        $arrayValueDD = Array("A", "S", "P");
    } else {
        $statusObj = new ItemStatus();
        unset($arrayValue);
        unset($arrayName);
        $arrayValue = $statusObj->getValues();
        $arrayName = $statusObj->getNames();
        unset($arrayValueDD);
        unset($arrayNameDD);
        for ($i=0; $i<count($arrayValue); $i++) {
            if ($arrayValue[$i] != "E") {
                $arrayValueDD[] = $arrayValue[$i];
                $arrayNameDD[] = $arrayName[$i];
            }
        }
    }
	$statusDropDown = html_selectBox("status", $arrayNameDD, $arrayValueDD, $moduleObj->getString("status"), "", "class='input-dd-form-settings'", "-- ".system_showText(LANG_LABEL_SELECT_ALLSTATUS)." --");

	if (!$_POST["account_id"]) $account_id = $moduleObj->getString("account_id");

    include(INCLUDES_DIR."/forms/form-modulesettings.php");

    //Auxiliary code to build accounts dropdown
    if (is_array($auxAccountSelectize) && count($auxAccountSelectize)) { ?>
        <script>

            $('.mail-select').selectize({
                sortField: null,
                persist: false,
                maxItems: 1,
                openOnFocus: false,
                valueField: 'id',
                labelField: 'name',
                searchField: ['name', 'email'],
                options: [
                    <? foreach ($auxAccountSelectize as $accSelectize) { ?>
                    {email: '<?=$accSelectize["email"]?>', name: '<?=addslashes($accSelectize["name"])?>', id: <?=db_formatNumber($accSelectize["id"])?>},
                    <? } ?>
                ],
                render: {
                    item: function(item, escape) {
                        return '<div class="selectize-dropdown-content">' +
                            (item.name ? '<span class="name">' + escape(item.name) + ' </span> ' : ' <span class="email">' + escape(item.email) + ' </span> ')
                        '</div>';
                    },
                    option: function(item, escape) {
                        var label = item.name || item.email;
                        var caption = item.name ? item.email : null;
                        return '<div>' +
                            '<span class="label-name">' + escape(label) + '</strong>' +
                            (caption ? '<i>' + escape(caption) + '</i>' : '') +
                            '</div>';
                    }
                }
            });

        </script>
    <? } ?>
