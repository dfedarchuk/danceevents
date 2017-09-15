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
	# * FILE: /includes/tables/table_locationContry.php
	# ----------------------------------------------------------------------------------------------------


    if ($operation) {
        if ($operation == "insert") { ?>
            <div id="warning" class="alert alert-success"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSADDED);?></div>
            <?
        } else
        if ($operation == "update") { ?>
            <div id="warning" class="alert alert-success"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSUPDATED);?></div>
            <?
        } else
        if ($operation == "delete") { ?>
            <div id="warning" class="alert alert-success"><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))." ".$_GET["loc_name"]." ".system_showText(LANG_SITEMGR_LOCATION_WASSUCCESSDELETED);?></div>
            <?
        }
    }
        
    $db = db_getDBObject( DEFAULT_DB, true );

    $locations_info = db_getFromDB( "settinglocation", "id", $_location_level, 1, "", "array", SELECTED_DOMAIN_ID );
?>

    <div class="panel panel-default">
        <div class="panel-heading">
            &nbsp;
            <div class="pull-right">
                <a href="<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/configuration/geography/locations/location_<?=$_location_level?>/location_<?=$_location_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>operation=add" class="btn btn-primary btn-xs">
                    <i class="icon-cross8"></i>
                    <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_level."_SYSTEM"))))?>
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th><?=string_ucwords(constant("LANG_SITEMGR_LOCATION_".constant("LOCATION".$_location_level."_SYSTEM")))?></th>
                        <?
                        foreach ($_locations as $i_child_level) {
                            system_retrieveLocationRelationship ($_locations, $i_child_level, $i_location_father_level, $i_location_child_level);
                            if (($i_location_child_level!==false) and ($_location_level < $i_location_child_level)) {
                        ?>
                            <th><?=string_ucwords(constant("LANG_SITEMGR_NAVBAR_".constant("LOCATION".($i_location_child_level)."_SYSTEM_PLURAL")))?></th>
                        <?
                            }
                        }
                        ?>
                        <th><?=system_showText(LANG_LABEL_OPTIONS)?></th>
                    </tr>
                </thead>

                <tbody>

                    <?
                    $cont = 0;
                    foreach ($locations as $location) {
                        $cont++;
                        $id = $location->getNumber("id");

                        $aux_node_params = array();
                        foreach ($_locations as $i_level) {
                            if ($location->getNumber('location_'.$i_level))
                                $aux_node_params['location_'.$i_level] = $location->getNumber('location_'.$i_level);
                        }
                        $aux_node_params = array_merge($aux_node_params, $_GET);
                        $_location_node_params = system_buildLocationNodeParams($aux_node_params);
                        $msgModalDelete = system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_DELETE".constant("LOCATION".$_location_level."_SYSTEM"))));
                        ?>

                        <tr>
                            <td>
                                <fieldset title="<?=$location->getString("name");?>">
                                    <? if (($_location_father_level!==false) and ($location->getNumber('id') > 0)) { ?>
                                    <input id="location_id<?=$cont?>" type="checkbox" value="<?=$id?>" name="item_check[]" onclick="javascript:setLocationSelect();" style="display: none" />
                                    <? } ?>

                                    <? if (($_location_child_level!==false) and ($location->getNumber('id') > 0)) { ?>
                                    <a href="<?=$url_base?>/locations/location_<?=($_location_child_level)?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>" class="link-table">
                                        <?=$location->getString("name");?>
                                    </a>
                                    <? } else { ?>
                                        <?=$location->getString("name");?>
                                    <? } ?>

                                </fieldset>
                            </td>
                            
                            <?
                            
                            foreach ($_locations as $i_child_level) {
                                system_retrieveLocationRelationship ($_locations, $i_child_level, $i_location_father_level, $i_location_child_level);
                                if (($i_location_child_level!==false) and ($_location_level < $i_location_child_level)) {
                                    $sql = "SELECT count(id) AS total FROM Location_".($i_location_child_level)." WHERE location_".$_location_level." = ".$id;
                                    $row = mysql_fetch_assoc($db->query($sql));
                            ?>
                                <td>
                                    <? if ($row["total"] > 0) { ?>
                                    <a href="<?=$url_base?>/locations/location_<?=($i_location_child_level)?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>" class="link-table">
                                    <? } ?>
                                    <?=$row["total"];?>
                                    <? if ($row["total"] > 0) { ?>
                                    </a>
                                    <? } ?>
                                </td>
                            <?
                                }
                            }
                            ?>

                            <td>
                                <div class="row">

                                <? if ($location->getNumber('id') > 0) { ?>
                                    <? if ($_location_child_level!==false) { ?>
                                    <div class="col-sm-3">
                                        <a class="btn btn-sm btn-primary btn-block" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_VIEW".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>" href="<?=$url_base?>/locations/location_<?=$_location_child_level?>/index.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>">
                                            <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_VIEW".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>
                                        </a>
                                    </div>
                                    <? } ?>
                                <? } ?>

                                <? if ($location->getNumber('id') > 0) { ?>                      

                                    <? if ($_location_child_level!==false) { ?>  
                                    <div class="col-sm-3">                    
                                        <a class="btn btn-sm btn-info btn-block" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>" href="<?=$url_base?>/locations/location_<?=$_location_child_level?>/location_<?=$_location_child_level?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>location_<?=$_location_level?>=<?=$id?>&operation=add">
                                            <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_ADD".constant("LOCATION".$_location_child_level."_SYSTEM"))))?>
                                        </a>
                                   </div>
                                    <? } ?> 
                                    
                                    <div class="col-sm-3">
                                        <a class="btn btn-sm btn-info btn-block" title="<?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_EDIT".constant("LOCATION".$_location_level."_SYSTEM"))))?>" href="<?=$url_redirect?>/location_<?=($_location_level)?>.php?<?=($_location_node_params?$_location_node_params."&":"")?>id=<?=$id?>&operation=edit">
                                            <?=system_showText(string_ucwords(constant("LANG_SITEMGR_LOCATION_EDIT".constant("LOCATION".$_location_level."_SYSTEM"))))?>
                                        </a>
                                    </div>
                                    
                                    <div class="col-sm-3">                       
                                        <a class="btn btn-sm btn-warning btn-block" title="<?=$msgModalDelete?>" data-toggle="modal" data-target="#modal-delete" href="#" onclick="$('#delete-id').val(<?=$id?>)">
                                            <?=$msgModalDelete?>
                                        </a> 
                                    </div>

                                <? } ?>

                                </div>

                            </td>
                        </tr>

                    <?
                    }
                    unset ($cont);
                ?>

                </tbody>
            </table>
        </div>
    </div>