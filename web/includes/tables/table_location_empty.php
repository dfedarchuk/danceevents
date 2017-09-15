<?

	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2014 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /includes/tables/table_location_empty.php
	# ----------------------------------------------------------------------------------------------------
?>

    <div class="panel panel-default">
        <div class="table-responsive">
<?php
        if ($_location_father_level !== false)
        {
            if ( isset(${"location_".$_location_father_level}) && ${"location_".$_location_father_level} != "" )
            { ?>
            <div class="text-center">
                <br>
                <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")."_NORECORD")))?><br><br>

                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/geography/locations/location_<?=$_location_level?>/location_<?=$_location_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>operation=add" class="btn btn-primary btn-xs">
                    <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_level."_SYSTEM"))))?>
                </a>
                <br><br>
            </div>
<?          }
            else
            { ?>
                <p class="alert alert-warning">
                    <?=system_showText(string_ucwords(LANG_SITEMGR_LOCATION_NORECORD))?>
                </p>
        <?	}

        }
        else
        { ?>
            <p class="alert alert-warning">
                <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")."_NORECORD")))?>
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/geography/locations/location_<?=$_location_level?>/location_<?=$_location_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>operation=add">
                    <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_level."_SYSTEM"))))?>
                </a>
            </p>
<?      } ?>
        </div>
    </div>