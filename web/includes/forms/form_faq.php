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
	# * FILE: /includes/form/form_faq.php
	# ----------------------------------------------------------------------------------------------------

	?>
<script type="text/javascript">
	function showAnswer(answer) {
		$(document).ready(function() {
			if ($('#'+answer).css('display') == 'none') {
				$('#'+answer).slideDown(400);
			} else {
				$('#'+answer).slideUp(400);
			}
		});
	}
</script>

<div class="well well-sm">
	<form name="faq" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="get" class="form-horizontal">
		<div class="row">
			<label for="search" class="col-sm-4 control-label label-lg"><?=system_showText(LANG_FAQ_HELP);?></label>
			<div class="col-sm-5">
				<input type="search" class="form-control" id="search" placeholder="<?=system_showText(LANG_FAQ_TIP);?>">
			</div>
			<div class="col-sm-3">
				<button type="submit" class="btn btn-success btn-block btn-lg"><?=system_showText(LANG_BUTTON_SEARCH);?></button>
			</div>
		</div>
	</form>
</div>

<div class="content-faq">

	<div class="faq-search flex-box-group">

		<?

		include(INCLUDES_DIR."/tables/table_paging.php");

		if ($faqs) {
			$i = 0;
			echo "<dl class=\"dl-questions\">";
			foreach ($faqs as $faq) {
				echo "<dt>".$faq["question"]."</dt>";
				echo "<dd id=\"answer".$i."\">".trim(str_replace('"','',$faq["answer"]))."</dd>";
				$i++;
			}
			echo "</dl>";
		} else {
			echo "<div class=\"alert alert-warning\">".system_showText(LANG_MSG_NO_RESULTS_FOUND)."</div>";
		}
		?>

	</div>

	<?
	$bottomPagination = true;
	include(INCLUDES_DIR."/tables/table_paging.php");
