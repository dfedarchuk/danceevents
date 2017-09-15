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
	# * FILE: /includes/forms/form_googlelogin.php
	# ----------------------------------------------------------------------------------------------------

    setting_get("foreignaccount_google_clientid", $foreignaccount_google_clientid);
    setting_get("foreignaccount_google_clientsecret", $foreignaccount_google_clientsecret);

    if ($foreignaccount_google_clientid && $foreignaccount_google_clientsecret) {

        if (!$goLabel) {
            if (string_strpos($_SERVER["PHP_SELF"], "order") !== false || string_strpos($_SERVER["REQUEST_URI"], ALIAS_CLAIM_URL_DIVISOR."/") !== false) {
                $goLabel = "Google";
            } else {
                $goLabel = system_showText(LANG_LOGINGOOGLEUSER);
            }
        }

        /*
         * Workaround to pin a bookmark without login
         */
        if ($_GET['bookmark_remember']) {
            $urlRedirect .= '&bookmark_remember=' . $_GET['bookmark_remember'];
        }

        /*
         * Workaround for make a redeem without login
         */
        if ($_GET['redeem_remember']) {
            $urlRedirect .= '&redeem_remember=' . $_GET['redeem_remember'];
        }

        if ($urlRedirect[0] != "?") {
            $urlRedirect = "?".$urlRedirect;
        }

?>

        <script type="text/javascript">

            (function() {
                var po = document.createElement('script');
                po.type = 'text/javascript';
                po.async = true;
                po.src = 'https://apis.google.com/js/client:plusone.js';
                var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(po, s);
            })();

            var auxCode = "";

            function signinCallback(authResult) {
                if (authResult['g-oauth-window']) {
                    auxCode = authResult['code'];
                    gapi.auth.setToken(authResult);
                    getEmail();
                }
            }

            function getEmail() {
                gapi.client.load('oauth2', 'v2', function() {
                    var request = gapi.client.oauth2.userinfo.get();
                    request.execute(getEmailCallback);
                });
            }

            function getEmailCallback(obj) {
                var email = '';
                var name = '';

                if (obj['email']) {
                    email = obj['email'];
                }

                if (obj['name']) {
                    name = obj['name'];
                }
                var destiny = '<?=DEFAULT_URL."/".MEMBERS_ALIAS."/googleauth.php$urlRedirect"?>';
                destiny = destiny + "&user_email="+email+'&user_name='+name+'&aux_code='+auxCode;
                window.open(destiny, "_top");
            }

        </script>

        <br>

        <div class="g-signin"

            data-callback="signinCallback"
            data-clientid="<?=$foreignaccount_google_clientid;?>"
            data-cookiepolicy="single_host_origin"
            data-scope="https://www.googleapis.com/auth/plus.login https://www.googleapis.com/auth/userinfo.email">

            <a href="javascript: void(0);" class="btn btn-google btn-block"><span class="fa fa-google"> </span><?=$goLabel?></a>

        </div>

    <? } ?>
