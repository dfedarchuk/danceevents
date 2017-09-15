<?php

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
	# * FILE: /includes/tables/table_billing_first_step.php
	# ----------------------------------------------------------------------------------------------------

	if ((!$bill_info["listings"]) && (!$bill_info["events"]) && (!$bill_info["banners"]) && (!$bill_info["classifieds"]) && (!$bill_info["articles"]) && (!$bill_info["custominvoices"])) {
		echo "<p class=\"informationMessage\">".system_showText(LANG_MSG_NO_ITEMS_REQUIRING_PAYMENT)."</p>";
	} else {

?>

		<script>

			function updateRenewalOption(module, id, option) {
				$.post('<?=DEFAULT_URL."/".MEMBERS_ALIAS."/billing/index.php"?>', {
					module: module,
					id: id,
					option: option,
					action: 'update_renewal'
				});
			}

			function toggleLinebyChkBox(obj){
				if (obj.checked == true){
					for(x=0; x < obj.parentNode.parentNode.childNodes.length; x++){
						if(obj.parentNode.parentNode.childNodes[x].firstChild){
							if ((obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]")) {
								obj.parentNode.parentNode.childNodes[x].firstChild.disabled= false;
							}
						}
					}
				} else {
					for(x=0; x < obj.parentNode.parentNode.childNodes.length; x++){
						if(obj.parentNode.parentNode.childNodes[x].firstChild){
							if ((obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountlisting_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountevent_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountbanner_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountclassified_id[]") || (obj.parentNode.parentNode.childNodes[x].firstChild.name == "discountarticle_id[]")) {
								obj.parentNode.parentNode.childNodes[x].firstChild.disabled= true;
							}
						}
					}
				}
			}

		</script>

		<?

		if ($bill_info["listings"]) {
			$pricingLevelObj = new ListingLevel();
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_LISTING_NAME);?></th>
					<th width="110"><?=system_showText(LANG_LABEL_EXTRA_CATEGORY);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["listings"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #e67e22" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					$pricingInfo = payment_getPricing("listing", $pricingLevelObj, $info["level_number"]);
					?>
					<tr>
						<td><input type="checkbox" id="listing_id[]" name="listing_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; <?=$renewal_date_style?>" >
							<?=system_showTruncatedText($info["title"], 25);?><?=($info["listingtemplate"]?"<span class=\"itemNote\"> (".$info["listingtemplate"].")</span>":"");?>
							<?php if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0) {
								$_SESSION["order_renewal_period_listing_$id"] = "monthly";
								?>

								<div class="renewal_options">

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_listing_<?=$id?>" onclick="updateRenewalOption('listing', <?=$id?>, 'monthly');" value="monthly"
												   checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
										</label>
									</div>

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_listing_<?=$id?>" onclick="updateRenewalOption('listing', <?=$id?>, 'yearly');"
												   value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
										</label>
									</div>

									<hr>

								</div>

							<?php } else {
								$_SESSION["order_renewal_period_listing_$id"] = $pricingInfo["renewal_period"];
							} ?>
						</td>
						<td style="<?=$renewal_date_style?>" ><?=$info["extra_category_amount"]?></td>
						<td style="<?=$renewal_date_style?>" ><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="<?=$renewal_date_style?>"><input type="text" name="discountlisting_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="<?=$renewal_date_style?>" ><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overlisting_msg) {
				echo "<p class=\"informationMessage\">".$overlisting_msg."</p>";
			}
		}

		if ($bill_info["events"]) {
			$pricingLevelObj = new EventLevel();
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_EVENT_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["events"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #e67e22" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					$pricingInfo = payment_getPricing("event", $pricingLevelObj, $info["level_number"]);
					?>
					<tr>
						<td><input type="checkbox" id="event_id[]" name="event_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left;<?=$renewal_date_style?>" >
							<?=system_showTruncatedText($info["title"], 40);?>
							<?php if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0) {
								$_SESSION["order_renewal_period_event_$id"] = "monthly";
								?>

								<div class="renewal_options">

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_event_<?=$id?>" value="monthly" onclick="updateRenewalOption('event', <?=$id?>, 'monthly');"
												   checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
										</label>
									</div>

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_event_<?=$id?>" onclick="updateRenewalOption('event', <?=$id?>, 'yearly');"
												   value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
										</label>
									</div>

									<hr>

								</div>

							<?php } else {
								$_SESSION["order_renewal_period_event_$id"] = $pricingInfo["renewal_period"];
							} ?>
						</td>
						<td style="<?=$renewal_date_style?>" ><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="<?=$renewal_date_style?>"><input type="text" name="discountevent_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="<?=$renewal_date_style?>" ><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overevent_msg) {
				echo "<p class=\"informationMessage\">".$overevent_msg."</p>";
			}
		}

		if ($bill_info["banners"]) {
			$pricingLevelObj = new BannerLevel();
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_BANNER_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_IMPRESSIONS)?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["banners"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #e67e22" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					$pricingInfo = payment_getPricing("banner", $pricingLevelObj, $info["level_number"]);
					?>
					<tr>
						<td><input type="checkbox" id="banner_id[]" name="banner_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; <?=$renewal_date_style?>" >
							<?=system_showTruncatedText($info["caption"], 30);?>
							<?php if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0 && !$info["unpaid_impressions"]) {
								$_SESSION["order_renewal_period_banner_$id"] = "monthly";
								?>

								<div class="renewal_options">

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_banner_<?=$id?>" value="monthly" onclick="updateRenewalOption('banner', <?=$id?>, 'monthly');"
												   checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
										</label>
									</div>

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_banner_<?=$id?>" onclick="updateRenewalOption('banner', <?=$id?>, 'yearly');"
												   value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
										</label>
									</div>

									<hr>

								</div>

							<?php } else {
								$_SESSION["order_renewal_period_banner_$id"] = $pricingInfo["renewal_period"];
							} ?>
						</td>
						<td style="<?=$renewal_date_style?>" ><?=(($info["expiration_setting"] != BANNER_EXPIRATION_IMPRESSION) ? system_showText(LANG_LABEL_UNLIMITED) : $info["unpaid_impressions"])?></td>
						<td style="<?=$renewal_date_style?>" ><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="<?=$renewal_date_style?>"><input type="text" name="discountbanner_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="<?=$renewal_date_style?>" ><?=(($info["expiration_setting"] != BANNER_EXPIRATION_RENEWAL_DATE) ? system_showText(LANG_LABEL_UNLIMITED) : (($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"])))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overbanner_msg) {
				echo "<p class=\"informationMessage\">".$overbanner_msg."</p>";
			}
		}

		if ($bill_info["classifieds"]) {
			$pricingLevelObj = new ClassifiedLevel();
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_CLASSIFIED_NAME);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_LEVEL);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["classifieds"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #e67e22" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					$pricingInfo = payment_getPricing("classified", $pricingLevelObj, $info["level_number"]);
					?>
					<tr>
						<td><input type="checkbox" id="classified_id[]" name="classified_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left;<?=$renewal_date_style?>" >
							<?=system_showTruncatedText($info["title"], 40);?>
							<?php if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0) {
								$_SESSION["order_renewal_period_classified_$id"] = "monthly";
								?>

								<div class="renewal_options">

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_classified_<?=$id?>" value="monthly" onclick="updateRenewalOption('classified', <?=$id?>, 'monthly');"
												   checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
										</label>
									</div>

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_classified_<?=$id?>" onclick="updateRenewalOption('classified', <?=$id?>, 'yearly');"
												   value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
										</label>
									</div>

									<hr>

								</div>

							<?php } else {
								$_SESSION["order_renewal_period_classified_$id"] = $pricingInfo["renewal_period"];
							} ?>
						</td>
						<td style="<?=$renewal_date_style?>" ><?=string_ucwords($info["level"])?></td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="<?=$renewal_date_style?>"><input type="text" name="discountclassified_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="<?=$renewal_date_style?>" ><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overclassified_msg) {
				echo "<p class=\"informationMessage\">".$overclassified_msg."</p>";
			}
		}

		if ($bill_info["articles"]) {
			$pricingLevelObj = new ArticleLevel();
			?>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_ARTICLE_NAME);?></th>
					<? if (PAYMENT_FEATURE == "on") { ?>
						<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
							<th width="140"><?=system_showText(LANG_LABEL_DISCOUNT_CODE)?></th>
						<? } ?>
					<? } ?>
					<th width="70"><?=system_showText(LANG_LABEL_RENEWAL);?></th>
				</tr>
				<?
				foreach($bill_info["articles"] as $id => $info){
					$renewal_date_style = ($info["needtocheckout"] == "y") ? "color: #e67e22" : "";
					$checked = ($info["needtocheckout"] == "y") ? "checked" : "";
					$pricingInfo = payment_getPricing("article", $pricingLevelObj, $info["level_number"]);
					?>
					<tr>
						<td><input type="checkbox" id="article_id[]" name="article_id[]" value="<?=$id?>" <?=$checked?> onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left; <?=$renewal_date_style?>" >
							<?=system_showTruncatedText($info["title"], 50);?>
							<?php if ($pricingInfo["monthly"] > 0 && $pricingInfo["yearly"] > 0) {
								$_SESSION["order_renewal_period_article_$id"] = "monthly";
								?>

								<div class="renewal_options">

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_article_<?=$id?>" value="monthly" onclick="updateRenewalOption('article', <?=$id?>, 'monthly');"
												   checked><?= CURRENCY_SYMBOL . $pricingInfo["monthly"] . " / " . system_showText(LANG_MONTH) ?>
										</label>
									</div>

									<div class="radio">
										<label>
											<input type="radio" class="renewal_radio" name="renewal_period_article_<?=$id?>" onclick="updateRenewalOption('article', <?=$id?>, 'yearly');"
												   value="yearly"><?= CURRENCY_SYMBOL . $pricingInfo["yearly"] . " / " . system_showText(LANG_YEAR) ?>
										</label>
									</div>

									<hr>

								</div>

							<?php } else {
								$_SESSION["order_renewal_period_article_$id"] = $pricingInfo["renewal_period"];
							} ?>
						</td>
						<? if (PAYMENT_FEATURE == "on") { ?>
							<? if ((CREDITCARDPAYMENT_FEATURE == "on") || (INVOICEPAYMENT_FEATURE == "on")) { ?>
								<td style="<?=$renewal_date_style?>"><input type="text" name="discountarticle_id[]" value="<?=$info["discount_id"]?>" <? if(!$checked) echo "disabled";?> style="width:60px;font-size:10px" />
							<? } ?>
						<? } ?>
						<td style="<?=$renewal_date_style?>" ><?=(($info["renewal_date"] == "0000-00-00") ? system_showText(LANG_LABEL_NEW) : format_date($info["renewal_date"]))?></td>
					</tr>
					<?
				}
				?>
			</table>

			<?
		} else {
			if ($overarticle_msg) {
				echo "<p class=\"informationMessage\">".$overarticle_msg."</p>";
			}
		}

		if ($bill_info["custominvoices"]) {
			?>
			<table border="0" cellpadding="2" cellspacing="2" class="standard-table">
				<tr>
					<th class="standard-tabletitle"><?=system_showText(LANG_MSG_PAY_OUTSTANDING_INVOICES);?></th>
				</tr>
			</table>

			<table class="table table-bordered table-striped">
				<tr>
					<th width="30"><?=system_showText(LANG_LABEL_PAY);?></th>
					<th><?=system_showText(LANG_LABEL_TITLE);?></th>
					<th width="100"><?=system_showText(LANG_LABEL_ITEMS);?></th>
					<th width="140"><?=system_showText(LANG_LABEL_AMOUNT);?></th>
					<th width="70"><?=system_showText(LANG_LABEL_DATE);?></th>
				</tr>
				<?

				/* all checked by default */
				$checked = true;

				foreach($bill_info["custominvoices"] as $id => $info) {
				?>
					<tr>
						<td><input type="checkbox" id="custom_invoice_id[]" name="custom_invoice_id[]" value="<?=$id?>" checked="checked" onclick="toggleLinebyChkBox(this)" class="inputCheck" /></td>
						<td style="text-align: left;" ><?=$info["title"]?></td>
						<td><a data-toggle="modal" data-target="#modal-custominvoice-<?=$info["id"]?>" class="link-table"><?=ucfirst(system_showText(LANG_VIEWITEMS))?></a></td>
						<td><?=$info["subtotal"]?></td>
						<td><?=format_date($info["date"])?></td>
					</tr>
					<?
				}
				?>
			</table>
        <? } ?>

		<div class="row payment-options">
            <div class="col-sm-12">
                <? include(INCLUDES_DIR."/forms/form_paymentmethod.php");?>
            </div>
		</div>

		<br />

        <div class="row text-center">
			<input type="hidden" name="second_step" id="second_step" value="1" style="display: none" />
			<button class="btn btn-success" type="submit"><?=system_showText(LANG_BUTTON_NEXT)?></button>
        </div>

		<?
		if ($bill_info["custominvoices"]) {
			foreach($bill_info["custominvoices"] as $id => $info) {
				include(INCLUDES_DIR."/modals/modal-custominvoice.php");
			}
		}

	}
