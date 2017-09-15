<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-manager.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/account/myaccount.php") === false && sess_getSMIdFromSession() != $id || !sess_getSMIdFromSession()) {
        $myAdminAccount = false;
    } else {
        $myAdminAccount = true;
    }

    if ($message_smpassword) { ?>
        <p class="alert alert-warning"><?=$message_smpassword?></p>
    <? } ?>

    <? if ($message_smaccount) { ?>
        <? if ($success) { ?>
            <p class="alert alert-success"><?=$message_smaccount?></p>
        <?} else {?>
            <p class="alert alert-warning"><?=$message_smaccount?></p>
        <? } ?>
    <? } ?>

    <div class="col-md-7 col-xs-12">

        <!-- Panel Basic Informartion  -->
        <div class="panel panel-form">

            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_SMACCOUNT_ACCOUNTINFORMATION)?>
            </div>

            <div class="panel-body">

                <div class="form-group row">
                    <div class="col-sm-<?=($myAdminAccount ? "12" : "6")?>">
                        <label for="username"><?=system_showText(LANG_SITEMGR_LABEL_USERNAME)?></label>
                        <input id="username" type="email" name="username" value="<?=$username?>" class="form-control" onblur="populateField(this.value, 'email');"/>
                        <input type="text" id="email" name="email" value="<?=$email?>" style="display:none;" />
                    </div>
                    <? if (!$myAdminAccount) { ?>
                    <div class="col-sm-6">
                        <label for="status"><?=system_showText(LANG_LABEL_STATUS)?></label>
                        <select class="form-control status-select" name="status" id="status">
                            <option value="1" <?=($active == "y" ? "selected" : "")?>><?=system_showText(LANG_SITEMGR_LABEL_ENABLED);?></option>
                            <option value="2"><?=system_showText(LANG_SITEMGR_LABEL_DISABLED);?></option>
                        </select>
                    </div>
                    <? } ?>
                </div>

                <div class="form-group row">
                    <div class="col-sm-6">
                        <label for="name"><?=system_showText(LANG_SITEMGR_LABEL_NAME)?></label>
                        <input type="text" name="name" id="name" value="<?=$name?>" class="form-control" />
                    </div>
                    <div class="col-sm-6">
                        <label for="phone"><?=system_showText(LANG_SITEMGR_LABEL_PHONE)?> <small class="small text-muted"><?=system_showText(LANG_SITEMGR_LABEL_SPAN_OPTIONAL)?></small></label>
                        <input type="tel" name="phone" id="phone" value="<?=$phone?>" class="form-control" />
                    </div>
                </div>

                <div class="form-group row">
                    <? if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/account/myaccount.php") !== false) { ?>
                    <div class="col-sm-4">
                        <label for="cpassword"><?=system_showText(LANG_SITEMGR_LABEL_CURRENTPASSWORD)?></label>
                        <input type="password" name="current_password" class="form-control" id="cpassword">
                    </div>
                    <div class="col-sm-4">
                        <label for="password"><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?></label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="col-sm-4">
                        <label for="retpassword"><?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?></label>
                        <input type="password" name="retype_password" class="form-control" id="retpassword">
                    </div>
                    <? } else { ?>
                    <div class="col-xs-6">
                        <label for="password"><?=system_showText(LANG_SITEMGR_LABEL_PASSWORD)?></label>
                        <input type="password" name="password" class="form-control" id="password">
                    </div>
                    <div class="col-xs-6">
                        <label for="retpassword"><?=system_showText(LANG_SITEMGR_LABEL_RETYPEPASSWORD)?></label>
                        <input type="password" name="retype_password" class="form-control" id="retpassword">
                    </div>
                    <? } ?>
                </div>

            </div>
            
        </div>
        
        <? 
        unset($account_permission);
        if ($_POST["permission"]) {
            $account_permission = $_POST["permission"];
        } elseif ($permission) {
            $account_permission = $permission;
        }
        
        if (!$myAdminAccount && !sess_getSMIdFromSession()) { ?>
        
        <div class="panel panel-form">
            
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_SMACCOUNT_LABEL_SITEMANAGERPERMISSION)?>
            </div>
            
            <div class="panel-body">
                <?=permission_getSMTable($account_permission, $myAdminAccount);?>
            </div>

        </div>
        
        <? } else {
            echo permission_getSMTable($account_permission, $myAdminAccount);
        } ?>

    </div>
            
    <? if (string_strpos($_SERVER["PHP_SELF"], "/".SITEMGR_ALIAS."/account/myaccount.php") === false) { ?>
            
    <div class="col-lg-5 col-xs-12">
        <br>
        <div class="panel panel-form-media">
            
            <div class="panel-heading">
                <?=system_showText(LANG_SITEMGR_LABEL_IPRESTRICTION);?>
            </div>
            
            <div class="panel-body">
                <div class="form-group">
                <label><?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP1)?></label>
                <textarea class="form-control" name="iprestriction" id="iprestriction" rows="5"><?=$iprestriction?></textarea>
                <p class="help-block">
                    <?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP3)?>
                </p>
                <p class="help-block">
                    <?=system_showText(LANG_SITEMGR_SMACCOUNT_TIP4)?>
                </p>
                </div>
            </div>
            
        </div>
        
    </div>
            
    <? } ?>