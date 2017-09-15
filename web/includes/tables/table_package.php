<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/tables/table_package.php
	# ----------------------------------------------------------------------------------------------------

	$itemCount = count($packages);

?>

	<table class="table table-bordered">
		<thead>
			<tr>
				<th><?=system_showText(LANG_SITEMGR_PACKAGE_TITLE);?></th>
				<th><?=system_showText(LANG_SITEMGR_PACKAGE_LEVEL_TYPE);?></th>
				<th><?=system_showText(LANG_LABEL_STATUS);?></th>
				<th><?=system_showText(LANG_SITEMGR_PACKAGE_DATE_CREATED);?></th>
				<th class="text-center"><?=system_showText(LANG_LABEL_OPTIONS)?></th>
			</tr>
		</thead>

		<?
		if ($packages) {
			foreach ($packages as $package) {
				$id = $package->getNumber("id");
				?>
				<tr>
					<td>
						<a href="<?=$url_base?>/promote/promotions/package.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=$package->getString("title")?>
						</a>
					</td>
					<td>
						<?

						/*
						 * Get level title
						 */
						if($package->getString("module") == "listing"){
							$auxLevelObj = "ListingLevel";
						}elseif($package->getString("module") == "article"){
							$auxLevelObj = "ArticleLevel";
						}elseif($package->getString("module") == "classified"){
							$auxLevelObj = "ClassifiedLevel";
						}elseif($package->getString("module") == "event"){
							$auxLevelObj = "EventLevel";
						}elseif($package->getString("module") == "banner"){
							$auxLevelObj = "BannerLevel";
						}
						unset($levelObj);
						$levelObj = new $auxLevelObj();
						echo string_ucwords($package->getString("module")).($auxLevelObj == "ArticleLevel" ? "" : " ".string_ucwords($levelObj->getName($package->level)));
						?>
					</td>
					<td>
						<?
						unset($statusObj);
						$statusObj= new ItemStatus();
						?>
						<?=$statusObj->getStatusWithStyle($package->getString("status"));?>
					</td>
					<td>
						<?=format_date($package->getString("entered"), DEFAULT_DATE_FORMAT, "datetime")." - ".format_getTimeString($package->getNumber("entered"));?>
					</td>
					<td nowrap class="main-options text-center">
						<a  class="btn btn-primary btn-xs" href="<?=$url_base?>/promote/promotions/package.php?id=<?=$id?>&screen=<?=$screen?>&letter=<?=$letter?><?=(($url_search_params) ? "&$url_search_params" : "")?>">
							<?=system_showText(LANG_LABEL_EDIT);?>
						</a>
						<a class="btn btn-warning btn-xs" href="#" data-toggle="modal" data-target="#modal-delete" onclick="$('#delete-id').val(<?=$id?>); $('#item-type').val('package');">
							<?=system_showText(LANG_LABEL_DELETE);?>
						</a>
					</td>
				</tr>
				<?
			}
		}
		?>
	</table>