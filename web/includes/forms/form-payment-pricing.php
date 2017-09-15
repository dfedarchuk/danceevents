<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    $levelObj = null;

    /* This switch will define specific data of each module, such as
     * Input fields, Options, Levels and Name, and also the specific
     * data of these.
     *
     * $moduleName   : guess!
     * $levelObj     : Contains information about the module's levels
     * $levelFields  : Which fields should be printed to edit this module's information
     * $levelOptions : Which options each of the levels have? (i.e detail, email)
     *      - name : The option's POST name (i.e. detail)
     *      - type : The input type (i.e. checkbox)
     *      - title : The option's friendly name (i.e Detail Page )
     *      - tip : The option's friendly explanation (i.e. Enable detail page for items? )
     *
     */
    switch ( $type )
    {
        case "listing":
            $moduleName = system_showText( LANG_SITEMGR_LISTING );
            $levelObj   = new ListingLevel( true );
            $levelAObj  = new ListingLevel();

            $levelFields = array(
                "order",
                "name",
                "active",
                "popular",
                "featured",
                "pricing",
                "pricing_yearly",
                "free_category",
                "category_price",
            );

            if (STRIPEPAYMENT_FEATURE == "on" && RECURRING_FEATURE == "on") {
                $levelFields[] = "trial";
            }

            $levelOrders = array(
                10 => LANG_SITEMGR_FIRST,
                30 => LANG_SITEMGR_SECOND,
                50 => LANG_SITEMGR_THIRD,
                70 => LANG_SITEMGR_FOURTH,
            );

            $levelOptions = array(
                array(
                    "name"  =>"detail",
                    "type"  => "checkbox",
                    "title" => LANG_LABEL_DETAIL_PAGE,
                    "tip"   => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_DETAIL,
                    "class" => "detailCheck",
                ),
				array(
                    "name" =>"deals",
                    "type" => "numeric",
                    "title"=> LANG_SITEMGR_PROMOTION_PLURAL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_DEAL,
                    "min" => 0,
                    "max" => 999,
                ),
				array(
                    "name" =>"has_review",
                    "type" => "checkbox",
                    "title"=> LANG_SITEMGR_REVIEWS,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_REVIEW,
                ),
				array(
                    "name" =>"has_call",
                    "type" => "checkbox",
                    "title"=> LANG_SITEMGR_CLICK_CALL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_LISTINGTIP_CLICKCALL,
                ),
				array(
                    "name" =>"email",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_EMAIL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_EMAIL,
                ),
				array(
                    "name" =>"url",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_URL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_URL,
                ),
				array(
                    "name" =>"phone",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_PHONE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_PHONE,
                ),
				array(
                    "name" =>"fax",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_FAX,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FAX,
                ),
				array(
                    "name" =>"images",
                    "type" => "numeric",
                    "title"=> LANG_LABEL_IMAGERY,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_IMAGERY,
                    "min" => 0,
                    "max" => 20,
                ),
				array(
                    "name" =>"video",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_VIDEOS,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_VIDEO,
                ),
				array(
                    "name" =>"attachment_file",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_ATTACH,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_ATTACH,
                ),
				array(
                    "name" =>"summary_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_SUMMARY_DESCRIPTION . " (". LANG_MSG_MAX_250_CHARS . ")",
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_SUMMARYDESC,
                ),
				array(
                    "name" =>"long_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_LONG_DESCRIPTION,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LONGDESC,
                ),
				array(
                    "name" =>"hours_of_work",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_HOURS_OF_WORK,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_HOURS,
                ),
				array(
                    "name" =>"locations",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_LOCATIONS,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LOCATIONS,
                ),
				array(
                    "name" =>"badges",
                    "type" => "checkbox",
                    "title"=> LANG_LISTING_DESIGNATION_PLURAL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_BADGES,
                ),
            );

            $levelOptions[] = array(
                "name" =>"social_network",
                "type" => "checkbox",
                "title"=> LANG_LABEL_FOREIGN_ACCOUNTS,
                "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_SOCIAL_NETWORK,
            );

            /* Classified Association */
            $levelOptions[] = [
                "name" =>"classified_quantity_association",
                "type" => "numeric",
                "title" => LANG_LABEL_CLASSIFIED_ASSOCIATION,
                "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CLASSIFIED_ASSOCIATION,
                "min" => 0,
                "max" => 20,
            ];

            $levelOptions[] = array(
                "name" =>"features",
                "type" => "checkbox",
                "title"=> LANG_LABEL_FEATURES,
                "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FEATURES,
            );
            break;
        case "event":
            $moduleName = system_showText( LANG_SITEMGR_EVENT );
            $levelObj   = new EventLevel( true );
            $levelAObj  = new EventLevel();

            $levelFields = array(
                "order",
                "name",
                "active",
                "popular",
                "featured",
                "pricing",
                "pricing_yearly"
            );

            if (STRIPEPAYMENT_FEATURE == "on" && RECURRING_FEATURE == "on") {
                $levelFields[] = "trial";
            }

            $levelOrders = array(
                10 => LANG_SITEMGR_FIRST,
                30 => LANG_SITEMGR_SECOND,
                50 => LANG_SITEMGR_THIRD,
            );

            $levelOptions = array(
                array(
                    "name" =>"detail",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_DETAIL_PAGE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_DETAIL,
                    "class" => "detailCheck",
                ),
				array(
                    "name" =>"email",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_EMAIL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_EMAIL,
                ),
				array(
                    "name" =>"url",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_URL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_URL,
                ),
				array(
                    "name" =>"phone",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_PHONE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_PHONE,
                ),
				array(
                    "name" =>"images",
                    "type" => "numeric",
                    "title"=> LANG_LABEL_IMAGERY,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_IMAGERY,
                    "min" => 0,
                    "max" => 999,
                ),
				array(
                    "name" =>"video",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_VIDEOS,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_VIDEO,
                ),
				array(
                    "name" =>"summary_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_SUMMARY_DESCRIPTION . " (". LANG_MSG_MAX_250_CHARS . ")",
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_SUMMARYDESC,
                ),
				array(
                    "name" =>"long_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_LONG_DESCRIPTION,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LONGDESC,
                ),
				array(
                    "name" =>"contact_name",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_CONTACTNAME,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTNAME,
                ),
				array(
                    "name" =>"start_time",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_EVENTTIME,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_EVENTTIME,
                ),
            );

            $levelOptions[] = array(
                "name" =>"fbpage",
                "type" => "checkbox",
                "title"=> LANG_LABEL_FBPAGE,
                "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FBPAGE,
            );

            break;
        case "banner":
            $moduleName = system_showText( LANG_SITEMGR_BANNER );
            $levelObj   = new BannerLevel( true );
            $levelAObj  = new BannerLevel();

            $levelFields = array(
                "name",
                "active",
                "popular",
                "pricing",
                "pricing_yearly",
                "blockImpressions",
                "blockPrice",
            );

            if (STRIPEPAYMENT_FEATURE == "on" && RECURRING_FEATURE == "on") {
                $levelFields[] = "trial";
            }

            $levelOptions = array();
            break;
        case "classified":
            $moduleName = system_showText( LANG_SITEMGR_CLASSIFIED );
//            $moduleMessage = $message_classifiedlevelnames;
            $levelObj   = new ClassifiedLevel( true );
            $levelAObj  = new ClassifiedLevel();

            $levelFields = array(
                "order",
                "name",
                "active",
                "popular",
                "featured",
                "pricing",
                "pricing_yearly"
            );

            if (STRIPEPAYMENT_FEATURE == "on" && RECURRING_FEATURE == "on") {
                $levelFields[] = "trial";
            }

            $levelOrders = array(
                10 => LANG_SITEMGR_FIRST,
                30 => LANG_SITEMGR_SECOND,
                50 => LANG_SITEMGR_THIRD,
            );

            $levelOptions = array(
                array(
                    "name" =>"detail",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_DETAIL_PAGE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_DETAIL,
                    "class" => "detailCheck",
                ),
				array(
                    "name" =>"url",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_URL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_URL,
                ),
				array(
                    "name" =>"fax",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_FAX,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_FAX,
                ),
				array(
                    "name" =>"images",
                    "type" => "numeric",
                    "title"=> LANG_LABEL_IMAGERY,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_IMAGERY,
                    "min" => 0,
                    "max" => 999,
                ),
                array(
                    "name" =>"video",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_VIDEOS,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_VIDEO,
                ),
                array(
                    "name" =>"additional_files",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_ATTACH,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_ATTACH,
                ),
				array(
                    "name" =>"summary_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_SUMMARY_DESCRIPTION . " (". LANG_MSG_MAX_250_CHARS . ")",
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_SUMMARYDESC,
                ),
				array(
                    "name" =>"long_description",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_LONG_DESCRIPTION,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_LONGDESC,
                ),
				array(
                    "name" =>"contact_name",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_CONTACTNAME,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTNAME,
                ),
				array(
                    "name" =>"contact_phone",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_CONTACT_PHONE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTPHONE,
                ),
				array(
                    "name" =>"contact_email",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_CONTACT_EMAIL,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_CONTACTEMAIL,
                ),
				array(
                    "name" =>"price",
                    "type" => "checkbox",
                    "title"=> LANG_LABEL_CLASSIFIED_PRICE,
                    "tip" => LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP_PRICE,
                ),
            );
            break;
        case "article":
            $moduleName = system_showText( LANG_SITEMGR_ARTICLE );
//            $moduleMessage = $message_articlelevelnames;
            $levelObj   = new ArticleLevel( true );
            $levelAObj  = new ArticleLevel();

            $levelFields = array(
                "name",
                "active",
                "pricing",
                "pricing_yearly"
            );

            if (STRIPEPAYMENT_FEATURE == "on" && RECURRING_FEATURE == "on") {
                $levelFields[] = "trial";
            }

            $levelOptions = array();
            break;
    }

    /* Fetches information about all levels */
    $levelvalues = $levelObj->getLevelValues();

    /* This variable is an indexed array in order to prevent multiple similar entries on JSHandler */
    $onReadyJS['featured'] = '

            '/* This event guarantees the detail feature is activated when the user picks a level as featured */.'
            $(".featuredCheck").change( function() {
                var level  = $(this).data("level");
                var module = $(this).data("module");

                if( $(this).is(":checked") )
                {
                    var detailBox   = $("input[name=\'levelOption["+module+"][detail]["+level+"]\']");
                    var featuredBox = $(this);

                    if( !detailBox.is(":checked") )
                    {
                        bootbox.confirm("'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_FEATURED_WARNING).'", function(result) {
                            if (result) {
                                detailBox.prop("checked", true);
                            }
                            else{
                                featuredBox.prop("checked", false);
                            }
                        });
                    }
                }
            });
            
            $(".input-pricing").change( function () {
                $("#save-pricing").attr("value", "yes");
            });

            '/* This event guarantees the featured options is deactivated when the user disables detail for a level */.'
            $(".detailCheck").change( function() {
                var level  = $(this).data("level");
                var module = $(this).data("module");

                if( !$(this).is(":checked") )
                {
                    var featuredBox = $("input[name=\'level["+module+"][featured]["+level+"]\']");
                    var detailBox   = $(this);

                    if( featuredBox.is(":checked") )
                    {
                        bootbox.confirm("'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_DETAIL_WARNING).'", function(result) {
                            if (result) {
                                featuredBox.prop("checked", false);
                            }
                            else{
                                detailBox.prop("checked", true);
                            }
                        });
                    }
                }
            });

            '/* This event ensures at least one level will be "active"
             * Will also prevent level deactivation if it is popular or featured
             */.'
            $(".activeCheck").change( function() {
                var level  = $(this).data("level");
                var module = $(this).data("module");

                var valid = false;

                $(".activeCheck:visible").each( function() {
                    if( $(this).is(":checked") ){
                        valid = true;
                        return false;
                    }
                });

                if( !valid ){
                    var element = $(this);

                    element.prop( "checked", true );
                    element.popover({
                        title : "'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE_WARNING_HEADER).'",
                        content : "'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE_WARNING1).'",
                    });

                    setTimeout( function(){ element.popover("hide"); element.popover("destroy"); } , 5000);
                } else {
                    var popular  = $("input[name=\'level["+module+"][popular]\'][value=\'"+level+"\']");
                    var featured = $("input[name=\'level["+module+"][featured]["+level+"]\']");
                    var element = $(this);

                    if( popular.prop("checked") || featured.prop("checked") ){

                        element.prop( "checked", true );
                        element.popover({
                            title : "'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE_WARNING_HEADER).'",
                            content :"'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE_WARNING2).'",
                        });

                        setTimeout( function(){ element.popover("hide"); element.popover("destroy"); } , 5000);
                    } else {
                        if( element.prop( "checked" ) )
                        {
                            popular.fadeIn();
                            featured.fadeIn();
                        } else {
                            popular.fadeOut();
                            featured.fadeOut();
                        }
                    }
                }
            });

            hideInactiveOptions();
';

    JavaScriptHandler::registerOnReady($onReadyJS);

    /* This variable is an indexed array in order to prevent multiple similar entries on JSHandler */
    $onLooseJS['featured'] = '
        '/* This function hides away all popular and featured inputs from disabled levels */.'
        function hideInactiveOptions(){
            $(".activeCheck").each( function() {
                var element = $(this);
                var level   = element.data("level");
                var module  = element.data("module");

                var popular  = $("input[name=\'level["+module+"][popular]\'][value=\'"+level+"\']");
                var featured = $("input[name=\'level["+module+"][featured]["+level+"]\']");

                if( !$(this).is(":checked") ){
                    popular.hide();
                    featured.hide();
                }
            });
        }
    ';

    JavaScriptHandler::registerLoose( $onLooseJS );

    /* This will print the error and success message box only
     * if what was proccessed by POST was  related to this section */
    if( checkActiveTab( "levels" ) )
    {
        unset( $_SESSION['PaymentOptions'] );
        MessageHandler::render();
    }
?>
        <div class="panel panel-default">

            <div class="panel-heading"><?= system_showText(LANG_SITEMGR_OPTIONS); ?></div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <?php
                                /* This prints the table headers for each of the level's fields */
                                foreach ($levelFields as $field)
                                {
                                    switch( $field )
                                    {
                                        case 'order':
                                            echo '<th>'.system_showText( LANG_SITEMGR_LABEL_ORDER ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ORDER_TIP).'"></i></th>';
                                            break;
                                        case 'name' :
                                            echo '<th style="width: 12%">'.system_showText( LANG_SITEMGR_SETTINGS_LEVELS_LEVELNAMES ).'</th>';
                                            break;
                                        case 'active' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_LEVELS_ACTIVE ).'</th>';
                                            break;
                                        case 'popular' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_LEVELS_POPULAR ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_POPULAR_TIP).'"></i></th>';
                                            break;
                                        case 'featured' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_LEVELS_FEATURED ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_LEVELS_FEATURED_TIP).'"></i></th>';
                                            break;
                                        case 'pricing' :
                                            echo '<th class="text-center" style="width: 12%">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_PRICEPER ).' '.system_showText( LANG_MONTH ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_TIP).'"></i></th>';
                                            break;
                                        case 'pricing_yearly' :
                                            echo '<th class="text-center" style="width: 12%">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_PRICEPER ).' '.system_showText( LANG_YEAR ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_TIP).'"></i></th>';
                                            break;
                                        case 'trial' :
                                            echo '<th class="text-center" style="width: 7%">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_TRIAL ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_TRIAL_TIP).'"></i></th>';
                                            break;
                                        case 'free_category' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_CATEGORIESINCLUDED ).' <i class="form-tip icon-help10" data-toggle="tooltip" data-html="true" data-original-title="'.system_showText(LANG_SITEMGR_SETTINGS_PRICING_CATEGORIESTIP).'"></i></th>';
                                            break;
                                        case 'category_price' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_EXTRACATEGORYPRICE ).'</th>';
                                            break;
                                        case 'blockImpressions' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_IMPRESSIONSPERBLOCK ).'</th>';
                                            break;
                                        case 'blockPrice' :
                                            echo '<th class="text-center">'.system_showText( LANG_SITEMGR_SETTINGS_PRICING_PRICEPERBLOCK ).'</th>';
                                            break;
                                    }
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                            /* this serves to order the levels in order to force "diamond" or its equivalent to come up first */
                            asort( $levelvalues );

                            /* This prints the input rows for each of the level's fields */
                            foreach ( $levelvalues as $key => $levelvalue )
                            {
                                echo '<tr>';
                                foreach ( $levelFields as $field )
                                {
                                    switch ( $field )
                                    {
                                        case 'order':
                                            echo "<td>".$levelOrders[$levelvalue]."</td>";
                                            break;
                                        case 'name' :
                                            $default = ucfirst( ( $type == "banner") ? $levelObj->getDisplayName($levelvalue) : $levelObj->showLevel($levelvalue) );
                                            echo "<td><input type=\"text\" name=\"level[$type][name][$levelvalue]\" class=\"form-control input-pricing\" value=\"$default\" required='required'></td>";
                                            break;
                                        case 'active' :
                                            $checked = $levelObj->active[$key] == 'y' ? 'checked="checked"' : "";
                                            echo "<td class=\"checkbox-table\"><input type=\"checkbox\" class=\"activeCheck\" data-module=\"{$type}\" data-level=\"$levelvalue\" name=\"level[$type][active][$levelvalue]\" $checked></td>";
                                            break;
                                        case 'popular' :
                                            $checked = $levelObj->popular[$key] == 'y' ? 'checked="checked"' : "";
                                            echo "<td class=\"checkbox-table\"><input type=\"radio\" name=\"level[$type][popular]\" value=\"$levelvalue\" $checked></td>";
                                            break;
                                        case 'featured' :
                                                $checked = $levelObj->featured[$key] == 'y' ? 'checked="checked"' : "";
                                            echo "<td class=\"checkbox-table\"><input type=\"checkbox\" class=\"featuredCheck\" data-module=\"{$type}\" data-level=\"$levelvalue\" name=\"level[$type][featured][$levelvalue]\" $checked></td>";
                                            break;
                                        case 'pricing' :
                                            if ($type == "banner") {
                                                $default = $levelObj->getPrice($levelvalue, BANNER_EXPIRATION_RENEWAL_DATE);
                                            } else {
                                                $default = $levelObj->getPrice($levelvalue);
                                            }
                                            echo "<td><input type=\"text\" name=\"level[$type][price][$levelvalue]\" class=\"form-control input-pricing\" value=\"$default\" maxlength=\"8\"></td>";
                                            break;
                                        case 'pricing_yearly' :
                                            if ($type == "banner") {
                                                $default = $levelObj->getPrice($levelvalue, BANNER_EXPIRATION_RENEWAL_DATE, 'yearly');
                                            } else {
                                                $default = $levelObj->getPrice($levelvalue, 'yearly');
                                            }
                                            echo "<td><input type=\"text\" name=\"level[$type][price_yearly][$levelvalue]\" class=\"form-control input-pricing\" value=\"$default\" maxlength=\"8\"></td>";
                                            break;
                                        case 'trial' :
                                            $default = $levelObj->getTrial($levelvalue);
                                            echo "<td><input type=\"number\" min=\"0\" name=\"level[$type][trial][$levelvalue]\" class=\"form-control input-pricing\" value=\"$default\" maxlength=\"3\"></td>";
                                            break;
                                        case 'free_category' :
                                            $default = $levelObj->getFreeCategory($levelvalue);
                                            echo "<td><input type=\"number\" name=\"level[$type][free_category][$levelvalue]\" min=\"0\" max=\"".LISTING_MAX_CATEGORY_ALLOWED."\" class=\"form-control\" value=\"$default\"></td>";
                                            break;
                                        case 'category_price' :
                                            $default = $levelObj->getCategoryPrice($levelvalue);
                                            echo "<td><input type=\"text\" name=\"level[$type][category_price][$levelvalue]\" class=\"form-control\" value=\"$default\"></td>";
                                            break;
                                        case 'blockImpressions' :
                                            $default = $levelObj->getImpressionBlock($levelvalue);
                                            echo "<td><input type=\"text\" name=\"level[$type][block_impressions][$levelvalue]\" class=\"form-control\" value=\"$default\"></td>";
                                            break;
                                        case 'blockPrice' :
                                            $default = $levelObj->getImpressionPrice($levelvalue);
                                            echo "<td><input type=\"text\" name=\"level[$type][block_price][$levelvalue]\" class=\"form-control\" value=\"$default\" maxlength=\"8\"></td>";
                                            break;
                                    }
                                }
                                echo '</tr>';
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" type="submit" name="action" value="levels"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>
        </div>

	<?// Manage Levels
        if( !empty( $levelOptions ) )
        {
            /* This fetches information about the level's options.
             *
             * This is necessary since not all information were added to the class properties
             * In other words, this array contain level information from the database which is nor present
             * in the class properties
             *
             * unsetting it first is necessary because this same include is used for all modules, and
             * it would contain garbage left from the previous includes */
            unset($array_fields);
            foreach ( $levelvalues as $levelvalue )
            {
                $array_fields[$levelvalue] = system_getFormFields( ucfirst( $type ), $levelvalue );
            }
        ?>
        <div class="panel panel-default">
            <div class="panel-heading"><?=system_showText(LANG_SITEMGR_SETTINGS_PAYMENTS_LEVELS_OPTIONS_HEADER)?></div>
            <div class="table-responsive">
                <table class="table table-hover">
                    <thead>
                        <tr>
                            <th class="col-sm-7"><?=$moduleName?> <small class="text-muted"><?=system_showText(LANG_SITEMGR_SETTINGS_LEVELS_ITEMTIP);?></small></th>
                            <?php
                                /* This prints the table headers for each of the level's options */
                                foreach ($levelvalues as $levelvalue)
                                {
                                    echo "<th class=\"text-center\">".$levelObj->showLevel($levelvalue)."</th>";
                                }
                            ?>
                        </tr>
                    </thead>
                    <tbody>

                        <?php
                            /* This prints the input rows for each of the level's fields */
                            foreach ($levelOptions as $option)
                            {
                                echo "<tr>";

                                $levelOptionClass = ( isset( $option['class'] ) ? $option['class'] : "" );

                                switch( $option['type'] )
                                {
                                    case "checkbox" : createCheckboxField( $option['name'], $option['title'], $option['tip'], $levelvalues, $levelObj, $array_fields, $type, $levelOptionClass ); break;
                                    case "numeric"  : createNumericField( $option['name'], $option['title'], $option['tip'], $option['max'], $option['min'], $levelvalues, $levelObj, $array_fields, $type); break;
                                }

                                echo"</tr>";
                            }
                        ?>
                    </tbody>
                </table>
            </div>
            <div class="panel-footer">
                <button class="btn btn-primary action-save" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" type="submit" name="action" value="levels"><?=system_showText(LANG_SITEMGR_SAVE_CHANGES);?></button>
            </div>

        </div>
    <?php
        }
