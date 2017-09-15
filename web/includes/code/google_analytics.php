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
	# * FILE: /includes/code/google_analytics.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# * DEFINES
	# ----------------------------------------------------------------------------------------------------
	$googleSettingObj = new GoogleSettings();

	if ($google_analytics_page == "front")       $setting_id = $googleSettingObj->analyticsFront;
	elseif ($google_analytics_page == "members") $setting_id = $googleSettingObj->analyticsMembers;
	elseif ($google_analytics_page == "sitemgr") $setting_id = $googleSettingObj->analyticsSiteManager;

	if ( $setting_id == "on" && $googleSettingObj->analyticsAccount ) {
		?>
		<script type="text/javascript">
			var gaJsHost = (("https:" == document.location.protocol) ? "https://ssl." : "http://www.");
			document.write(unescape("%3Cscript src='" + gaJsHost + "google-analytics.com/ga.js' type='text/javascript'%3E%3C/script%3E"));
		</script>
		<script type="text/javascript">
			try {
				var pageTracker = _gat._getTracker("<?= $googleSettingObj->analyticsAccount ?>");
				pageTracker._initData();
				pageTracker._trackPageview();
			} catch(err) {}	
		</script>
		<?
	}

?>
