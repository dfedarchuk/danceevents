<div>
    <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="<?= system_showText(LANG_CLOSE); ?>"><span
            aria-hidden="true">&times;</span></button>
        <h4 class="modal-title"><?= system_showText(LANG_LABEL_LOGIN); ?></h4>
    </div>
    <div class="modal-body">
        <div class="col-md-12">
            <div class="panel panel-theme">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-8 col-md-offset-2">

                            <div class="text-center">
                                <a href="<?= SOCIALNETWORK_URL ?>/add.php?<?=sprintf('%s%s%s', $bookmarkQueryString, $redeemQueryString, $userpermQueryString)?>"
                                   class="btn btn-success btn-block"><?= system_showText(LANG_JOIN_PROFILE); ?></a>
                            </div>

                            <? if ($foreignaccount_google == "on" || FACEBOOK_APP_ENABLED == "on") { ?>

                                <p class="text-center"><?= system_showText(LANG_OR_SIGNUPACCOUNT); ?></p>

                                <? if (FACEBOOK_APP_ENABLED == "on") {
                                    $urlRedirect = "?destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                                    include(INCLUDES_DIR."/forms/form_facebooklogin.php");
                                }

                                if ($foreignaccount_google == "on") {
                                    $urlRedirect = "?destiny=".urlencode($_SERVER["HTTP_REFERER"]);
                                    include(INCLUDES_DIR."/forms/form_googlelogin.php");
                                } ?>

                                <p class="text-center"><br><?= system_showText(LANG_OR_SIGNINEMAIL); ?></p>
                            <? } ?>

                            <form role="form" class="form" name="login" method="post"
                                  action="<?=DEFAULT_URL?><?= $url ?>">
                                <?
                                $members_section = true;
                                include(INCLUDES_DIR."/forms/form_login.php"); ?>
                            </form>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-footer"></div>
</div>
