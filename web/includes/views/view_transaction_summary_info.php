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
	# * FILE: /includes/views/view_transaction_summary_info.php
	# ----------------------------------------------------------------------------------------------------

	$id = $transaction["id"];
	$_GET['id'] = $id;
	include(INCLUDES_DIR."/code/transaction.php");

?>

<? if ($transaction_listing_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="3"><p><?=system_showText(LANG_LISTING_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_listing_log as $each_listing) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_listing["listing_title"]?>">
						<?
						$transactionListingObj = new Listing($each_listing["listing_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

						if ($transactionListingObj->getNumber("id") > 0 && $validMember) {
							?><a href="<?=$url_base?>/<?=LISTING_FEATURE_FOLDER;?>/view.php?id=<?=$each_listing["listing_id"]?>">
								<?=system_showTruncatedText($each_listing["listing_title"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_listing["listing_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_listing["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_listing["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>
<? if ($transaction_event_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="3"><p><?=system_showText(LANG_EVENT_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_event_log as $each_event) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_event["event_title"]?>">
						<?
						$transactionEventObj = new Event($each_event["event_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

						if ($transactionEventObj->getNumber("id") > 0 && $validMember) {
							?><a href="<?=$url_base?>/<?=EVENT_FEATURE_FOLDER;?>/view.php?id=<?=$each_event["event_id"]?>">
								<?=system_showTruncatedText($each_event["event_title"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_event["event_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_event["level_label"]);?></td>
				<td class="infoAmount">
				<?=$each_event["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_banner_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="3"><p><?=system_showText(LANG_BANNER_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_banner_log as $each_banner) {?>
			<tr>
				<th>
					<fieldset title="<?=$each_banner["banner_caption"]?>">
						<?
						$transactionBannerObj = new Banner($each_banner["banner_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

						if ($transactionBannerObj->getNumber("id") > 0 && $validMember) {
							?><a href="<?=$url_base?>/<?=BANNER_FEATURE_FOLDER;?>/view.php?id=<?=$each_banner["banner_id"]?>">
								<?=system_showTruncatedText($each_banner["banner_caption"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_banner["banner_caption"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_banner["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_banner["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_classified_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="3"><p><?=system_showText(LANG_CLASSIFIED_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_classified_log as $each_classified) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_classified["classified_title"]?>">
						<?
						$transactionClassifiedObj = new Classified($each_classified["classified_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

						if ($transactionClassifiedObj->getNumber("id") > 0 && $validMember) {
							?><a href="<?=$url_base?>/<?=CLASSIFIED_FEATURE_FOLDER;?>/view.php?id=<?=$each_classified["classified_id"]?>">
								<?=system_showTruncatedText($each_classified["classified_title"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_classified["classified_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoLevel"><?=string_ucwords($each_classified["level_label"]);?></td>
				<td class="infoAmount">
					<?=$each_classified["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_article_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="2"><p><?=system_showText(LANG_ARTICLE_FEATURE_NAME_PLURAL);?></p></th>
		</tr>
		<? foreach ($transaction_article_log as $each_article) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_article["article_title"]?>">
						<?
						$transactionArticleObj = new Article($each_article["article_id"]);

                        if (string_strpos($url_base, "/".MEMBERS_ALIAS."") !== false) {
                            $validMember = false;
                        } else {
                            $validMember = true;
                        }

						if ($transactionArticleObj->getNumber("id") > 0 && $validMember) {
							?><a href="<?=$url_base?>/<?=ARTICLE_FEATURE_FOLDER;?>/view.php?id=<?=$each_article["article_id"]?>">
								<?=system_showTruncatedText($each_article["article_title"], 60);?>
							</a><?
						} else {
							?><?=system_showTruncatedText($each_article["article_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoAmount">
					<?=$each_article["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_custominvoice_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="2"><p><?=system_showText(LANG_CUSTOM_INVOICES);?></p></th>
		</tr>
		<? foreach ($transaction_custominvoice_log as $each_custominvoice) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_custominvoice["title"]?>">
						<?
						$transactionCustomInvoiceObj = new CustomInvoice($each_custominvoice["custom_invoice_id"]);
						if ($transactionCustomInvoiceObj->getNumber("id") > 0) {
							if (string_strpos($url_base, "/".SITEMGR_ALIAS."") !== false) {
								?><a href="<?=$url_base?>/custominvoices/view.php?id=<?=$each_custominvoice["custom_invoice_id"]?>">
									<?=system_showTruncatedText($each_custominvoice["title"], 60);?>
								</a><?
							} else {
								?><?=system_showTruncatedText($each_custominvoice["title"], 60);?><?
							}
						} else {
							?><?=system_showTruncatedText($each_custominvoice["title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoAmount">
					<?=$each_custominvoice["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>

<? if ($transaction_package_log) { ?>

	<table class="table table-bordered table-striped">
		<tr>
			<th colspan="2"><p><?=system_showText(LANG_PACKAGE_SING);?></p></th>
		</tr>
		<? foreach ($transaction_package_log as $each_package) { ?>
			<tr>
				<th>
					<fieldset title="<?=$each_package["title"]?>">
						<?
						$transactionPackageObj = new Package($each_package["package_id"]);
						if ($transactionPackageObj->getNumber("id") > 0) {
							if (string_strpos($url_base, "/".SITEMGR_ALIAS."") !== false) {
								?><a href="<?=$url_base?>/package/view.php?id=<?=$each_package["package_id"]?>">
									<?=system_showTruncatedText($each_package["package_title"], 60);?>
								</a><?
							} else {
								?><?=system_showTruncatedText($each_package["package_title"], 60);?><?
							}
						} else {
							?><?=system_showTruncatedText($each_package["package_title"], 60);?><?
						}
						?>
					</fieldset>
				</th>
				<td class="infoAmount">
					<?=$each_package["amount"]." (".$transaction["transaction_currency"].")";?>
				</td>
			</tr>
		<? } ?>
	</table>
	<br />
<? } ?>


