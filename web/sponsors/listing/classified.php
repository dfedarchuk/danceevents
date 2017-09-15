<?php
/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
#                                                                    #
######################################################################
\*==================================================================*/

# ----------------------------------------------------------------------------------------------------
# * FILE: /sponsors/listing/listing.php
# ----------------------------------------------------------------------------------------------------

# ----------------------------------------------------------------------------------------------------
# LOAD CONFIG
# ----------------------------------------------------------------------------------------------------
include("../../conf/loadconfig.inc.php");

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

$url_redirect = "".DEFAULT_URL."/".MEMBERS_ALIAS;
$url_base = "".DEFAULT_URL."/".MEMBERS_ALIAS."";
$members = 1;
$item_form = 1;

# ----------------------------------------------------------------------------------------------------
# CODE
# ----------------------------------------------------------------------------------------------------
include(EDIRECTORY_ROOT."/includes/code/listing_classified.php");

# ----------------------------------------------------------------------------------------------------
# HEADER
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT."/layout/header.php");

# ----------------------------------------------------------------------------------------------------
# NAVBAR
# ----------------------------------------------------------------------------------------------------
include(MEMBERS_EDIRECTORY_ROOT."/layout/navbar.php");

// validate this page
?>

    <section class="top-search">

        <? include(EDIRECTORY_ROOT."/frontend/coverimage.php"); ?>

        <div class="well well-translucid">
            <div class="container">
                <br>
                <h2>
                    <?= system_showText(
                        $id ? LANG_LABEL_EDIT : LANG_ADD
                    ) ?> <?= system_showText(LANG_LISTING_FEATURE_NAME); ?>
                </h2>
                <br>
            </div>
        </div>
    </section>

    <section class="block">
        <div class="container">
            <?php
            if ($id) {
                include(MEMBERS_EDIRECTORY_ROOT."/".LISTING_FEATURE_FOLDER."/navbar.php");
            }
            ?>

            <div class="well">

                <h2 class="theme-title">
                    <?= system_showText(LANG_CLASSIFEID_ASSOCIATION) ?>
                </h2>

                <div class="row">
                    <form name="listing"
                          id="listing"
                          action="<?= system_getFormAction(
                              $_SERVER["PHP_SELF"]
                          ) ?>"
                          method="post">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <? include(INCLUDES_DIR."/forms/form-listing-classified.php"); ?>
                        <div class="row text-center">
                            <button class="btn btn-success" type="submit">
                                <?= system_showText(LANG_BUTTON_CONTINUE) ?>
                            </button>
                        </div>
                    </form>
                </div>
            </div>


        </div>
    </section>


<?php
# ----------------------------------------------------------------------------------------------------
# FOOTER
# ----------------------------------------------------------------------------------------------------
$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/modules.php";
include(MEMBERS_EDIRECTORY_ROOT."/layout/footer.php");
