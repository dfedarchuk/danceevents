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
	# * FILE: /includes/code/navigation.php
	# ----------------------------------------------------------------------------------------------------

    /*
     * ATTENTION
     * This file controls the navigation functionality for both Web version navigation (Site manager > Site Content > Navigation) and iOS/Android App navigation (Site manager > Build your App > Step 6)
     */

    # ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	if ($_SERVER["REQUEST_METHOD"] == "POST" && !DEMO_LIVE_MODE) {

        /**
         * Validate reset by Ajax
         */
        if ($_POST["resetNavigation"] == "reset") {
            $navigationObj = new Navigation();
            $navigationObj->ResetNavbar($_POST["area"]);

            header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/menu/?successMessage=1");
            exit;
        }

        $_POST["order_options"] = str_replace("sortable-title,", "", $_POST["order_options"]);
        $_POST["order_options"] = str_replace("sortable-title", "", $_POST["order_options"]);

		if (validate_form("navigation", $_POST, $errorMessage)) {

            /**
             * Get order
             */
            unset($array_nav_order, $new_navigation, $navbarObj);
            $array_nav_order = explode(",", $_POST["order_options"]);

            $navbarObj = new Navigation();
            $navbarObj->ClearNavigation($_POST["navigation_area"]);

            // fixes some route names
            for ($i = 0; $i < count($array_nav_order); $i++) {

                unset($new_navigation);
                $new_navigation["order"] = $i;
                $new_navigation["label"] = $_POST["navigation_text_".$array_nav_order[$i]];
                if ($_POST["dropdown_link_to_".$array_nav_order[$i]] == "custom") {

                    if (string_strpos($_POST["custom_link_".$array_nav_order[$i]], "://") === false) {
                        $_POST["custom_link_".$array_nav_order[$i]] = "http://".$_POST["custom_link_".$array_nav_order[$i]];
                    }

                    $new_navigation["link"] = $_POST["custom_link_".$array_nav_order[$i]];
                    $new_navigation["custom"] = "y";

                } else {
                    $new_navigation["link"] = $_POST["dropdown_link_to_".$array_nav_order[$i]];
                    $new_navigation["custom"] = "n";
                }
                $new_navigation["area"] = $_POST["navigation_area"];

                $navbarObj->makeFromRow($new_navigation);
                $navbarObj->Save();

                /* User has done step 3 successfully */
                setting_set("appbuilder_step_6", "done") or setting_new("appbuilder_step_6", "done");
            }

            /**
            * Validate to "View the Site"
            */
            if ($_POST["SaveByAjax"] == "true") {

                header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
                header("Accept-Encoding: gzip, deflate");
                header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check", FALSE);
                header("Pragma: no-cache");

                echo "ok";
                exit;
            } else {
                header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/mobile/menu/?successMessage=1");
                exit;
            }

		} else {

            /**
             * Recreating options
             */
            unset($arrayOptions);
            $array_nav_order = explode(",", $_POST["order_options"]);
            for ($i = 0; $i < count($array_nav_order); $i++) {

                $arrayOptions[$i]["label"] = $_POST["navigation_text_".$array_nav_order[$i]];

                if ($_POST["dropdown_link_to_".$array_nav_order[$i]] == "custom") {
                    $arrayOptions[$i]["link"] = $_POST["custom_link_".$array_nav_order[$i]];
                    $arrayOptions[$i]["custom"] = "y";
                } else {
                    $arrayOptions[$i]["link"] = $_POST["dropdown_link_to_".$array_nav_order[$i]];
                    $arrayOptions[$i]["custom"] = "n";
                }
            }

            /**
            * Validate to "View the Site" and show the error
            */
           if ($_POST["SaveByAjax"] == "true") {

                header("Content-Type: text/html; charset=".EDIR_CHARSET, TRUE);
                header("Accept-Encoding: gzip, deflate");
                header("Expires: Sat, 01 Jan 2000 00:00:00 GMT");
                header("Cache-Control: no-store, no-cache, must-revalidate");
                header("Cache-Control: post-check=0, pre-check", FALSE);
                header("Pragma: no-cache");

               echo $errorMessage;
               exit;
           }
        }

		// removing slashes added if required
		$_POST = format_magicQuotes($_POST);
		$_GET  = format_magicQuotes($_GET);
	}

    extract($_POST);
    extract($_GET);

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
    if (!$arrayOptions) {
        /*
         * Get configuration from navigation
         */
        if (!$navigation_area) {
            $navigation_area = ($appBuilder ? "tabbar" : "header");
        }
        unset($navbarObj, $arrayOptions);
        Navigation::getNavbar($arrayOptions, $navigation_area);

        if (!$arrayOptions) {
            unset($navbarObj);
            $navbarObj = new Navigation();
            $navbarObj->ResetNavbar($navigation_area, $appBuilder);
            $navbarObj->getNavbar($arrayOptions, $navigation_area);
        }
    }

    if ($appBuilder) {
        $auxArrayModules = unserialize(APPBUILDER_MENU);

        $array_modules = $auxArrayModules[$navigation_area];
        $customPageOptions = AppCustomPage::getMenuOptions();
    } else {

        $domainObj = new Domain(SELECTED_DOMAIN_ID);
        $domainURL = "http://".$domainObj->getString("url");

        /**
        * Array with Modules and URL
        */
        $auxArrayModules = unserialize(THEME_NAVIGATION_MENU);

        $array_modules[] = array("name" => LANG_SITEMGR_NAVIGATION_CUSTOM_LINK, "url" => "custom");

        $array_modules = array_merge($auxArrayModules[$navigation_area], $array_modules);

    }

    $aux_selectModuleLink = "";

    if ($appBuilder) {
        $aux_selectModuleLink = "<option>---</option>";
    }

    for ($j = 0; $j < count($array_modules); $j++) {

        $moduleOn = false;
        if ($array_modules[$j]["module"]) {
            if ((constant($array_modules[$j]["module"]) == "on") && (constant("CUSTOM_".$array_modules[$j]["module"]) == "on")) {
                $moduleOn = true;
            }

        } else {
            $moduleOn = true;
        }

        if ($moduleOn) {
            $labelName = strpos($array_modules[$j]["name"], "LANG_") !== false ? constant($array_modules[$j]["name"]) : $array_modules[$j]["name"];
            $aux_selectModuleLink .= "<option value=".$array_modules[$j]["url"].">".string_ucwords($labelName)."</option>";
        }
    }

    if ($appBuilder) {

        if ( AppCustomPage::count() )
        {
            $aux_selectModuleLink .= $customPageOptions;
        }

        $limitPreview = (count($arrayOptions) <= 4 ? count($arrayOptions) : 4);
        $limitItems = 11 + AppCustomPage::count();

        $aux_LI_code = "<li id=\"LI_ID\">
                            <p id=\"preview_itemLI_ID\" style=\"display:none;\">
                                <i class=\"drag\"></i>
                                <span id=\"navigation_text_preview_LI_ID\"></span>
                                <input type=\"hidden\" name=\"navigation_text_cancel_LI_ID\" id=\"navigation_text_cancel_LI_ID\" value=\"\">
                                <span class=\"options\">
                                    <span class=\"edit-list\" onclick=\"editMenu(LI_ID, true);\">".system_showText(LANG_LABEL_EDIT)."</span>
                                    <i class=\"iab-delete\" id=\"remove_itemLI_ID\" onclick=\"javascript:removeItem(LI_ID, true)\"></i>
                                </span>
                            </p>

                            <div id=\"edit_itemLI_ID\" class=\"open-edit\">
                                <p class=\"list-label\">
                                    <span>".system_showText(LANG_SITEMGR_BUILDER_CONFIGMENU_LABEL)."</span>
                                    <span>".system_showText(LANG_SITEMGR_LINKSTO)."</span>
                                </p>

                                <p class=\"list-edit\">
                                    <input type=\"text\" name=\"navigation_text_LI_ID\" id=\"navigation_text_LI_ID\" value=\"\" onkeyup=\"updatePreview(this); updateItem(LI_ID, this);\" maxlength=\"20\" />
                                    <i class=\"iab-linkto\"></i>
                                    <select onchange=\"disableDropdown(); checkOption(LI_ID);\" name=\"dropdown_link_to_LI_ID\" id=\"dropdown_link_to_LI_ID\">".$aux_selectModuleLink."
                                    </select>

                                    <a class=\"btn-mini\" onclick=\"javascript:removeItem(LI_ID, true)\">".system_showText(LANG_BUTTON_CANCEL)."</a>
                                    <a class=\"btn-mini btn-success\" onclick=\"NextStep(false, LI_ID);\">".system_showText(LANG_SITEMGR_SAVE)."</a>
                                </p>
                            </div>

                        </li>";

    } else {

        $aux_LI_code = "<li class=\"row\" id=\"LI_ID\">
                            <p>
                                <span class=\"col-sm-1 text-center\"><i class=\"drag\"></i></span>
                                <span class=\"col-sm-4\"><input type=\"text\" class=\"form-control\" name=\"navigation_text_LI_ID\" id=\"navigation_text_LI_ID\" value=\"\" /></span>
                                <span class=\"col-sm-3\">
                                    <span>
                                        <select name=\"dropdown_link_to_LI_ID\" id=\"dropdown_link_to_LI_ID\" onchange=\"enableCustomLink(LI_ID)\">".$aux_selectModuleLink."
                                        </select>
                                    </span>
                                </span>
                                <span class=\"col-sm-3\"><input type=\"text\" class=\"form-control\" name=\"custom_link_LI_ID\" id=\"custom_link_LI_ID\" value=\"\" disabled=\"disabled\" /></span>
                                <span class=\"options\">
                                    <a class=\"sortable-remove\" href=\"javascript:void(0)\" onclick=\"javascript:removeItem(LI_ID)\">
                                        <i class=\"icon-waste2 text-warning\"></i>
                                    </a>
                                </span>
                            </p>
                        </li>";

    }
