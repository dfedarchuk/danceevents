<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/design/email-editor/email.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSMSession();
    permission_hasSMPerm();

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    if ($_REQUEST['id'] && $_REQUEST['id'] <= SYSTEM_LASTEMAIL_ID) {
        $_GET = format_magicQuotes($_GET);
        extract($_GET);
        $_POST = format_magicQuotes($_POST);
        extract($_POST);
        include(INCLUDES_DIR."/code/email_notification.php");
    } else {
        header("Location: ./");
        exit;
    }

    if ($_SERVER['REQUEST_METHOD'] != 'POST') {
		$_GET = format_magicQuotes($_GET);
		extract($_GET);
		$_POST = format_magicQuotes($_POST);
		extract($_POST);
	}

    # ----------------------------------------------------------------------------------------------------
	# AVAILABLE VARS
	# ----------------------------------------------------------------------------------------------------
	$defaultVAR = array	(
		"ACCOUNT_NAME"              =>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_NAME_HELP),
		"ACCOUNT_USERNAME"          =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_USERNAME_HELP),
		"ACCOUNT_PASSWORD"          =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_PASSWORD_HELP),
		"KEY_ACCOUNT"               =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_KEY_ACCOUNT_HELP),
		"DEFAULT_URL"               =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DEFAULTURL_HELP)." (\"".DEFAULT_URL."\").",
		"MEMBERS_URL"               =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_MEMBERSURL_HELP)." (\"".MEMBERS_ALIAS."\").",
		"SITEMGR_EMAIL"             =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_SITEMGR_EMAIL_HELP),
		"EDIRECTORY_TITLE"          =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EDIRECTORY_TITLE_HELP)." (".EDIRECTORY_TITLE.").",
		"LISTING_TITLE"             =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_TITLE)."\").",
		"EVENT_TITLE"               =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_EVENT_TITLE)."\").",
		"BANNER_TITLE"              =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_BANNER_TITLE)."\").",
		"CLASSIFIED_TITLE"          =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CLASSIFIED_TITLE)."\").",
		"ARTICLE_TITLE"             =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ARTICLE_TITLE)."\").",
		"LISTING_RENEWAL_DATE"      =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LISTING_RENEWAL_DATE_HELP),
		"DAYS_INTERVAL"         	=>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_DAYS_INTERVAL),
		"CUSTOM_INVOICE_AMOUNT"     =>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_CUSTOM_INVOICE_AMOUNT),
		"ITEM_TITLE"                =>	system_showText(LANG_SITEMGR_TITLE)." (\"".system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_TITLE)."\").",
		"ITEM_URL"                  =>	DEFAULT_URL."/item/title.html",
		"CUSTOM_INVOICE_TAX"        =>	system_showText(LANG_SITEMGR_SETTINGS_TAX_LABEL),
		"ARTICLE_DEFAULT_URL"       =>	ARTICLE_DEFAULT_URL,
		"CLASSIFIED_DEFAULT_URL"	=>	CLASSIFIED_DEFAULT_URL,
		"EVENT_DEFAULT_URL"         =>	EVENT_DEFAULT_URL,
		"LISTING_DEFAULT_URL"       =>	LISTING_DEFAULT_URL,
        "ACCOUNT_LOGIN_INFORMATION"	=>	system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACCOUNT_LOGIN_INFORMATION_HELP),
		"TABLE_STATS"               =>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_TABLE_STATS),
		"REDEEM_CODE"               =>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_REDEEMCODE),
		"LINK_ACTIVATE_ACCOUNT"     =>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ACTIVATE_ACCOUNT),
		"LEAD_MESSAGE"              =>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LEAD_MESSAGE),
		"LOGO"						=>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_LOGO),
		"ITEM_LINK"					=>  system_showText(LANG_SITEMGR_EMAILNOTIFICATION_VAR_ITEM_LINK)
	);

    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $dbObj = db_getDBObjectByDomainID(SELECTED_DOMAIN_ID, $dbMain);
    $sql = "SELECT use_variables FROM Email_Notification WHERE id = $id";
    $row = mysql_fetch_assoc($dbObj->query($sql));
    $variables = explode(",", $row["use_variables"]);

	$body = str_replace("LOGO", system_getHeaderLogo(false), $body);

    # ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

    # ----------------------------------------------------------------------------------------------------
	# SIDEBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-design.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

		<form name="emailnotifications" id="emailnotifications" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">

            <input name="id" type="hidden" value="<?=$_REQUEST['id']?>" >
			<input name="email" type="hidden" value="<?=$emailNotificationObj->getString("email")?>" >
			<input type="hidden" name="deactivate" value="<?=($deactivate ? 1 : "")?>" >

            <section class="row heading">
	           	<div class="container">
	           		<h1><?=system_showText(LANG_SITEMGR_EMAILNOTIFICATION_EDIT);?></h1>
	           		<p><?=system_showText(@constant("LANG_SITEMGR_EMAILNOTIF_DESC_".$emailNotificationObj->getNumber("id")))?></p>
				</div>
            </section>

           <section class="row edit-listing">
	           	<div class="container">
                    <? include(INCLUDES_DIR."/forms/form-email.php"); ?>
	           	</div>
           </section>

           <section class="row footer-action">
           		<div class="container">
	           		<div class="col-xs-12 text-right">
		           		<a href="<?=DEFAULT_URL."/".SITEMGR_ALIAS."/design/email-editor/"?>" class="btn btn-default"><?=system_showText(LANG_CANCEL)?></a>
	           			<span class="separator"> <?=system_showText(LANG_OR)?> </span>
						<button type="submit" name="save" value="<?=system_showText(LANG_SITEMGR_SAVE)?>" class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>"><?=system_showText(LANG_SITEMGR_SAVE)?></button>
					</div>
				</div>
           </section>

       </form>
    </main>

<?php
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
    $controlSidebar = true;
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/general.php";
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/email-editor.php";
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
