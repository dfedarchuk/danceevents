<?php
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /includes/forms/form_orderpackage.php
	# ----------------------------------------------------------------------------------------------------
	if (string_strpos($_SERVER["PHP_SELF"], "signup") === false) { ?>

		<script>
			function addPackage() {
			<? if(string_substr($next_page,-1) == "?") { ?>
				window.location = '<?=$next_page?>package_id=<?=$array_package_offers[0]["package_id"]?>';
			<? } else { ?>
				window.location = '<?=$next_page?>&package_id=<?=$array_package_offers[0]["package_id"]?>';
			<? } ?>
			}
		</script>

	<? } ?>

	<h2><?=system_showText(LANG_INCREASE_VISIBILITY)?></h2>

	<?
		if ((is_array($array_package_offers)) and (count($array_package_offers) > 0) and $array_package_offers[0]) {

			$auxitem_name = $array_package_offers[0]["items"][0]["module"];

			switch ($auxitem_name) {
				 case 'listing': $item_name = ucfirst(LANG_LISTING_FEATURE_NAME);
								 $level = new ListingLevel();
								 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
								 if (EDIR_LANGUAGE == "en_us") {
									$msg_packagetr = system_showText(LANG_ADD_A)." ".$item_levelName." ".$item_name." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
								} else {
									$msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
								}
							 	break;

				 case 'banner':  $item_name = ucfirst(LANG_BANNER_FEATURE_NAME);
								 $level = new BannerLevel();
								 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
								 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
								 break;

				 case 'event':   $item_name = ucfirst(LANG_EVENT_FEATURE_NAME);
								 $level = new EventLevel();
								 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
								 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
								 break;

				case 'classified':   $item_name = ucfirst(LANG_CLASSIFIED_FEATURE_NAME);
									 $level = new ClassifiedLevel();
									 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
									 $msg_packagetr = system_showText(LANG_ADD_A)." ".$item_name." ".$item_levelName." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
									 break;

				case 'article':  $item_name = ucfirst(LANG_ARTICLE_FEATURE_NAME);
								 $level = new ArticleLevel();
								 $item_levelName = ucfirst($level->getName($array_package_offers[0]["items"][0]["level"]));
								 $msg_packagetr = system_showText(LANG_ADD_AN)." ".$item_name." ".(count($array_package_offers[0]["items"]) > 1 ? system_showText(LANG_ON_SITES) : system_showText(LANG_ON_SITES_SINGULAR));
								 break;

				case 'custom_package':  $item_name = ucfirst(LANG_GIFT);
										break;

			}

			$auxdomains_names = "";

			if (is_array($array_package_offers)) foreach ($array_package_offers as $package_offer) {
				if (is_array($package_offer['items'])) foreach ($package_offer['items'] as $package_offer_item) {
					if ($package_offer_item['domain_id'] > 0) {
						$aux_domain_obj = new Domain($package_offer_item['domain_id']);
						$auxdomains_names .= $aux_domain_obj->getString('name').", ";
					}
				}
				$auxdomains_names = string_substr($auxdomains_names, 0, -2);
			 }

		}
		?>

	<div class="extendedContent membersExtendedContent">
		<? if ((is_array($array_package_offers)) and (count($array_package_offers) > 0) and $array_package_offers[0]) { ?>
		<section class="block">
			<div class="media">
				<div class="media-left">
					<?
					$packageObj = new Package ($array_package_offers[0]["package_id"]);
					$imageObj = new Image($packageObj->getNumber("image_id"));
					if ($imageObj->imageExists()) {
						echo $imageObj->getTag(true, IMAGE_PACKAGE_FULL_WIDTH, IMAGE_PACKAGE_FULL_WIDTH, $packageObj->getString("title", false));
					}
					?>
				</div>
				<div class="media-body">
					<? if ($packageObj->getString("content", false)) { ?><div class="content-custom"><?=($packageObj->getString("content", false))?></div><? } ?>
				</div>
			</div>
			<br>
        </section>

		<table class="table table-striped table-bordered ">
			<tr>
				<th class="standardSubTitle"><?=$msg_packagetr?></th>
			</tr>

			<!-- package offers -->
			<? if (is_array($array_package_offers)) foreach ($array_package_offers as $package_offer) {
				$aux_package_total = 0;
			?>
					<!-- package items -->
					<? if (is_array($package_offer['items']))  foreach ($package_offer['items'] as $package_offer_item) {
						$aux_valid_item = true;

						if ($package_offer_item['domain_id']>0) {
							$aux_domain_obj = new Domain($package_offer_item['domain_id']);
							$aux_valid_item = ($aux_domain_obj->getString('status') == 'A');

							$package_offer_item['domain'] = $aux_domain_obj->getString('name');
							$package_offer_item['domain_url'] = ((string_strpos($aux_domain_obj->getString('url'), 'http://')===false) ? 'http://' : '' ) . $aux_domain_obj->getString('url').EDIRECTORY_FOLDER;
						}

						if ($aux_valid_item) {
							if ($package_offer_item['module'] == 'custom_package') {
								$aux_package_item_desc = $package_offer_item['content'];
							} else {

								$classLevel = string_ucwords($package_offer_item['module'])."Level";
								$level = new $classLevel();
								$levelName = string_ucwords($level->getName($package_offer_item['level']));

								$aux_package_item_desc =
									'<a href="'.$package_offer_item['domain_url'].'" target="_blank">'.$package_offer_item['domain'].'</a>';
							}

							if ($package_offer_item['price'] == 0) {
								$aux_package_item_price = CURRENCY_SYMBOL." ".system_showText(LANG_FREE);
							} else {
								$aux_package_item_price = CURRENCY_SYMBOL." ".$package_offer_item['price'];
								$aux_package_total += $package_offer_item['price'];
							}

					?>
						<tr>
							<td>
                                <?=$aux_package_item_desc ? $aux_package_item_desc : LANG_CUSTOM_OPTION?>
                                <strong class="pull-right"><?=$aux_package_item_price;?></strong>
                            </td>
						</tr>
					<?
						}
					}
				} ?>

		</table>
		<? } ?>

		<?

		if (string_strpos($_SERVER["PHP_SELF"], "signup") !== false) {
			$className = ucfirst($item_type);
			$itemObj = new $className($item_id);

			$item_name = $itemObj->getString("title");
			$item_friendlyurl = $itemObj->getString("friendly_url");

			?>

			<input type="hidden" name="item_type" value="<?=$item_type?>">
			<input type="hidden" name="item_id" value="<?=$item_id?>">
			<input type="hidden" name="item_name" value="<?=$item_name?>">
			<input type="hidden" name="item_friendlyurl" value="<?=$item_friendlyurl?>">
			<input type="hidden" name="payment_method" value="<?=$payment_method?>">
			<input type="hidden" name="package_id[]" value="<?=$array_package_offers[0]["package_id"]?>">

			<?

			if ($checkout == "true") {
				$action = DEFAULT_URL."/".MEMBERS_ALIAS."/$item_type/$item_type.php?id=$item_id&process=signup";
			} else {
				if ($payment_method == "invoice") {
					$action = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/invoice.php";
				} else {
					$action = DEFAULT_URL."/".MEMBERS_ALIAS."/signup/payment.php?payment_method=".$payment_method;
				}
			}
		}
		?>

		<div class="text-center">

			<? if (string_strpos($_SERVER["PHP_SELF"], "signup") !== false) { ?>
				<a href="<?=$action?>" style="float:left">
					<?=system_showText(LANG_BUTTON_NO_ORDER_WITHOUT)?>
				</a>
				<button class="btn btn-success pull-right" type="submit"><?=system_showText(LANG_BUTTON_YES_CONTINUE)?></button>
			<? } else { ?>
				<a href="<?=$next_page?>" style="float:left" >
					<?=system_showText(LANG_BUTTON_NO_ORDER_WITHOUT)?>
				</a>
				<button class="btn btn-success pull-right" type="button" onclick="addPackage();"><?=system_showText(LANG_BUTTON_YES_CONTINUE)?></button>
			<? } ?>

		</div>
	</div>
