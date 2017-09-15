<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/lists/list-listingtypes.php
	# ----------------------------------------------------------------------------------------------------

    foreach ($listingtemplates as $listingtemplate) {
        $id = $listingtemplate->getNumber("id"); ?>

	<div class="col-md-2 col-xs-6">

		<div class="thumbnail">

			<div class="caption">
				<h5 class="overflow"><?=$listingtemplate->getString("title")?></h5>
				<a class="btn btn-primary btn-xs" href="<?=$url_redirect?>/type.php?id=<?=$listingtemplate->getNumber("id");?>"><?=(system_showText(LANG_SITEMGR_EDIT))?></a>
				<? if ($listingtemplate->getString("editable") == "y") { ?>
                	<button type="button" class="btn btn-warning btn-xs" data-toggle="modal" data-target="#modal-delete" onclick="$('#delete-id').val(<?=$id?>);"><?=system_showText(LANG_SITEMGR_REMOVE);?></button>
				<? } ?>
            </div>

		</div>

	</div>

    <? } ?>