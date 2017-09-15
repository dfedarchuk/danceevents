<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/forms/form-navigation.php
	# ----------------------------------------------------------------------------------------------------
//$arrayOptions = $wysiwygService->getNavigation();

?>

    <input type="hidden" id="divId" value=""/>

    <div class="row">
        <div class="col-md-1 text-right">
            <a class="sortable-add createItem" data-modalaux="header" href="javascript:void(0)">
                <i class="fa fa-plus-circle" aria-hidden="true"></i>
            </a>
        </div>
        <div class="col-md-11">
            <ul id="sortableNav" class="list-sortable list-lg">
                <?= $navbar ?>
            </ul>
        </div>
    </div>
