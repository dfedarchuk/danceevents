<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/forgot.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# AUX
	# ----------------------------------------------------------------------------------------------------
	$section = "sitemgr";
	include(INCLUDES_DIR."/code/forgot_password.php");

	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# Navbar
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");

?>

	<div class="container">
		<div class="container-fluid row">
			<div class="col-md-4 col-md-offset-4 col-sm-6 col-sm-offset-3">
				<br><br>
				<div class="panel panel-default">
					<div class="panel-heading"><?=LANG_SITEMGR_FORGOOTTEN_PASS_1;?></div>
					<div class="panel-body">
						<form name="forgotpassword" role="form" action="<?=system_getFormAction($_SERVER["PHP_SELF"])?>" method="post">
				            <? include(INCLUDES_DIR."/forms/form_forgot_password.php"); ?>
				        </form>
			        </div>
		        </div>
			</div>
		</div>
	</div>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
