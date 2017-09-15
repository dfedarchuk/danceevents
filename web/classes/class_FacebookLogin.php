<?php
/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2017 Arca Solutions, Inc. All Rights Reserved.           #
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
# * FILE: /classes/class_FacebookLogin.php
# ----------------------------------------------------------------------------------------------------

use Facebook\Facebook;

class FacebookLogin
{

    public $fb;
    public $helper;

    public function __construct() {
        $this->fb = new \Facebook\Facebook([
            'app_id' => FACEBOOK_API_ID,
            'app_secret' => FACEBOOK_API_SECRET,
            'default_graph_version' => 'v2.8',
        ]);
        $this->helper = $this->fb->getRedirectLoginHelper();
    }

    public function getFBLoginURL($urlRedirect = "")
    {
        $permissions = [FACEBOOK_PERMISSION_SCOPE]; // Optional permissions

        $loginUrl = $this->helper->getLoginUrl(FACEBOOK_REDIRECT_URI.$urlRedirect, $permissions);

        return $loginUrl;

    }

    public function getUserInfo(&$userInfo)
    {
        try {

            $fields = array(
                'uid' => 'id',
                'nickname' => 'name',
                'first_name' => 'first_name',
                'last_name' => 'last_name',
                'email' => 'email',
                'location' => 'location',
            );

            $_fields = implode(',', $fields);

            // Returns a `Facebook\FacebookResponse` object
            $response = $this->fb->get('/me?fields='.$_fields, $_SESSION['fb_access_token']);
        } catch(Facebook\Exceptions\FacebookResponseException $e) {
            echo 'Graph returned an error: ' . $e->getMessage();
            exit;
        } catch(Facebook\Exceptions\FacebookSDKException $e) {
            echo 'Facebook SDK returned an error: ' . $e->getMessage();
            exit;
        }

        $user = $response->getGraphUser();

        foreach ($fields as $key => $value)
        {
            $userInfo[$key] = $user[$value];
        }

        $userInfo["picture"] = "https://graph.facebook.com/" . $user["id"] . "/picture?type=large";

        if (validate_email($user["email"])) {
            $userInfo["email"] = $user["email"];
        }

    }

    public function handleError($message, $changeHeader = false) {
        if (DEMO_DEV_MODE) {
            if ($changeHeader) {
                header('HTTP/1.0 400 Bad Request');
            }
            echo $message;
            exit;
        }
        header("Location: ".DEFAULT_URL."/".MEMBERS_ALIAS."/login.php?facebookerror");
        exit;
    }

}
