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
	# * FILE: /includes/forms/form-support-alias.php
	# ----------------------------------------------------------------------------------------------------

?>



	<h3>URL Divisors</h3>
    <? foreach ($aliasDivisors as $divisor) { ?>
	<div class="form-group">
		<label class="control-label col-sm-2">* <?=$divisor["label"]?>:</label>
		<div class="input-group col-sm-6">
			<input class="form-control" type="text" name="<?=strtolower($divisor["name"])?>" value="<?=$divisor["value"]?>" maxlength="100" />
			<span class="input-group-addon"><?=$divisor["tip"]?></span>
		</div>
	</div>
    <? } ?>
