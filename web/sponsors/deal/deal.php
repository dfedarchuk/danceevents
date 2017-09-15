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
    # * FILE: /sponsors/deal/deal.php
    # ----------------------------------------------------------------------------------------------------

    # ----------------------------------------------------------------------------------------------------
    # LOAD CONFIG
    # ----------------------------------------------------------------------------------------------------
    include("../../conf/loadconfig.inc.php");

    # ----------------------------------------------------------------------------------------------------
    # VALIDATION
    # ----------------------------------------------------------------------------------------------------
    if ( PROMOTION_FEATURE != "on" || CUSTOM_PROMOTION_FEATURE != "on" || CUSTOM_HAS_PROMOTION != "on"){
        exit;
    }

    # ----------------------------------------------------------------------------------------------------
    # SESSION
    # ----------------------------------------------------------------------------------------------------
    sess_validateSession();
    $acctId = sess_getAccountIdFromSession();

    # ----------------------------------------------------------------------------------------------------
    # AUX
    # ----------------------------------------------------------------------------------------------------
    extract($_GET);
    extract($_POST);

    # ----------------------------------------------------------------------------------------------------
    # CODE
    # ----------------------------------------------------------------------------------------------------
    $url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
    $members = 1;

    if ($_POST["action"] == "useDeal" && $_POST["promotion_id"]){
        $dealObj = new Promotion();
        $dealObj->setPromoCode($_POST["promotion_id"], 1);
        die("OK");
    }
    if ($_POST["action"]== "freeUpDeal" && $_POST["promotion_id"]){
        $dealObj = new Promotion();
        $dealObj->setPromoCode($_POST["promotion_id"], 0);
        die("OK");
    }


    include(EDIRECTORY_ROOT."/includes/code/promotion.php");

    # ----------------------------------------------------------------------------------------------------
    # HEADER
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

    # ----------------------------------------------------------------------------------------------------
    # NAVBAR
    # ----------------------------------------------------------------------------------------------------
    include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h2>
                    <?=system_showText($id ? LANG_LABEL_EDIT : LANG_ADD)?> <?=system_showText(LANG_PROMOTION_FEATURE_NAME);?>
                </h2>
                <br>
            </div>
        </div>
    </section>

    <section class="block">
        <div class="container">
            <div class="well">

                <h2 class="theme-title"><?=system_showText(LANG_PROMOTION_INFORMATION)?></h2>

                <div class="row">

                    <form name="promotion" id="promotion" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post" enctype="multipart/form-data">
                        <input type="hidden" name="id" id="id" value="<?=$id?>">
                        <input type="hidden" name="listing_id" value="<?=$listing_id?>">
                        <input type="hidden" name="account_id" id="account_id" value="<?=$acctId?>">

                        <? if ($message_promotion) { ?>
                            <div class="col-sm-12 alert alert-warning" role="alert">
                                <p><?=$message_promotion;?></p>
                            </div>
                        <? } ?>

                        <? include(INCLUDES_DIR."/forms/form-promotion.php"); ?>
                    </form>

                </div>

                <div class="row">
                    <form action="<?=DEFAULT_URL?>/<?=MEMBERS_ALIAS?>/" method="get">
                        <div class="row text-center">
                            <button class="btn btn-link" type="submit"><?=system_showText(LANG_BUTTON_CANCEL)?></button>
                            <button class="btn btn-success" type="button" onclick="document.promotion.submit();"><?=system_showText(LANG_MSG_SAVE_CHANGES)?></button>
                        </div>
                    </form>
                </div>

            </div>
        </div>
    </section>

    <? include(INCLUDES_DIR."/modals/modal-crop.php"); ?>

<?php
    # ----------------------------------------------------------------------------------------------------
    # FOOTER
    # ----------------------------------------------------------------------------------------------------
    $customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
    include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");