<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/support/domain.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# THIS PAGE IS ONLY USED BY THE SUPPORT
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();

	if (!sess_getSMIdFromSession()){
		header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
        exit;
	} else {
		$dbMain = db_getDBObject(DEFAULT_DB, true);
		$sql = "SELECT username FROM SMAccount WHERE id = ".sess_getSMIdFromSession();
		$row = mysql_fetch_assoc($dbMain->query($sql));
		if ($row["username"] != ARCALOGIN_USERNAME){
			header("Location: ".DEFAULT_URL."/".SITEMGR_ALIAS."/");
            exit;
		} 
	}
    
    # ----------------------------------------------------------------------------------------------------
	# CODE
	# ----------------------------------------------------------------------------------------------------
    $dbMain = db_getDBObject(DEFAULT_DB, true);
    $sql = "SELECT * FROM Domain";
    $result = $dbMain->query($sql);
    
	# ----------------------------------------------------------------------------------------------------
	# HEADER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/header.php");

	# ----------------------------------------------------------------------------------------------------
	# NAVBAR
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/navbar.php");


    # ----------------------------------------------------------------------------------------------------
    # SIDEBAR
    # ----------------------------------------------------------------------------------------------------
    include(SM_EDIRECTORY_ROOT."/layout/sidebar-support.php");

?>
   
    <main class="wrapper-dashboard togglesidebar container-fluid">          

        <?
        require(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

        <section class="heading">
            <h1>Domains</h1>
        </section>

        <section class="row section-form">
            <div class="col-sm-8 col-sm-offset-2">
                <? while ($row = mysql_fetch_assoc($result)) { ?>
                <table class="table table-bordered">
                    <tr>
                        <th colspan="2"><?=$row["name"]?></th>
                    </tr>
                    <tr>
                        <th>ID</th>
                        <td><?=$row["id"]?></td>
                    </tr>
                    <tr>
                        <th>Database Host</th>
                        <td><?=$row["database_host"]?></td>
                    </tr>
                    <tr>
                        <th>Database Port</th>
                        <td><?=$row["database_port"]?></td>
                    </tr>
                    <tr>
                        <th>Database Username</th>
                        <td><?=$row["database_username"]?></td>
                    </tr>
                    <tr>
                        <th>Database Password</th>
                        <td><?=$row["database_password"]?></td>
                    </tr>
                    <tr>
                        <th>Database Name</th>
                        <td><?=$row["database_name"]?></td>
                    </tr>
                    <tr>
                        <th>URL</th>
                        <td><?=$row["url"]?></td>
                    </tr>
                    <tr>
                        <th>Status</th>
                        <td><?=$row["status"]?></td>
                    </tr>
                    <tr>
                        <th>Activation Status</th>
                        <td><?=$row["activation_status"]?></td>
                    </tr>
                    <tr>
                        <th>Created</th>
                        <td><?=$row["created"]?></td>
                    </tr>
                    <tr>
                        <th>Deleted Date</th>
                        <td><?=$row["deleted_date"]?></td>
                    </tr>
                    <tr>
                        <th>Article</th>
                        <td><?=$row["article_feature"]?></td>
                    </tr>
                    <tr>
                        <th>Banner</th>
                        <td><?=$row["banner_feature"]?></td>
                    </tr>
                    <tr>
                        <th>Classified</th>
                        <td><?=$row["classified_feature"]?></td>
                    </tr>
                    <tr>
                        <th>Event</th>
                        <td><?=$row["event_feature"]?></td>
                    </tr>
                </table>
                <? } ?>                
            </div>
        </section>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>