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
	# * FILE: /includes/forms/form_billing_worldpay.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# INCLUDE
	# ----------------------------------------------------------------------------------------------------
	include(EDIRECTORY_ROOT."/conf/payment_worldpay.inc.php");

	setting_get("payment_tax_status", $payment_tax_status);
    setting_get("payment_tax_value", $payment_tax_value);

	if (WORLDPAYPAYMENT_FEATURE == "on") {

		if (!WORLDPAY_INSTID) {
			echo "<p class=\"errorMessage\">".system_showText(LANG_GATEWAY_NO_AVAILABLE)." <a href=\"".DEFAULT_URL."/".MEMBERS_ALIAS."/help.php\" class=\"billing-contact\">".system_showText(LANG_LABEL_ADMINISTRATOR)."</a>.</p>";
		} else {

			if ($bill_info["listings"]) foreach ($bill_info["listings"] as $id => $info) {
				$listing_ids[] = $id;
				$listing_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_listing_{$id}"] ? $_SESSION["order_renewal_period_listing_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$listing_renewals[] = $renewal_cycle;
			}

			if ($bill_info["events"]) foreach ($bill_info["events"] as $id => $info) {
				$event_ids[] = $id;
				$event_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_event_{$id}"] ? $_SESSION["order_renewal_period_event_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$event_renewals[] = $renewal_cycle;
			}

			if ($bill_info["banners"]) foreach ($bill_info["banners"] as $id => $info) {
				$banner_ids[] = $id;
				$banner_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_banner_{$id}"] ? $_SESSION["order_renewal_period_banner_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$banner_renewals[] = $renewal_cycle;
			}

			if ($bill_info["classifieds"]) foreach ($bill_info["classifieds"] as $id => $info) {
				$classified_ids[] = $id;
				$classified_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_classified_{$id}"] ? $_SESSION["order_renewal_period_classified_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$classified_renewals[] = $renewal_cycle;
			}

			if ($bill_info["articles"]) foreach ($bill_info["articles"] as $id => $info) {
				$article_ids[] = $id;
				$article_amounts[] = $info["total_fee"];

				$renewal_cycle = ($_SESSION["order_renewal_period_article_{$id}"] ? $_SESSION["order_renewal_period_article_{$id}"] : $_SESSION["order_renewal_period"]);
				$renewal_cycle = strtoupper(substr($renewal_cycle, 0, 1));

				$article_renewals[] = $renewal_cycle;
			}

			if ($bill_info["custominvoices"]) foreach($bill_info["custominvoices"] as $id => $info) {
				$custominvoice_ids[] = $id;
				$custominvoice_amounts[] = $info["subtotal"];
			}

			$contactObj = new Contact(sess_getAccountIdFromSession());
			$amount = str_replace(",", ".", $bill_info["total_bill"]);
			if ($listing_ids){
				$listing_ids = implode("::",$listing_ids);
			}
			if ($listing_amounts){
				$listing_amounts = implode("::",$listing_amounts);
			}
			if ($listing_renewals){
				$listing_renewals = implode("::",$listing_renewals);
			}
			if ($event_ids){
				$event_ids = implode("::",$event_ids);
			}
			if ($event_amounts){
				$event_amounts = implode("::",$event_amounts);
			}
			if ($event_renewals){
				$event_renewals = implode("::",$event_renewals);
			}
			if ($banner_ids){
				$banner_ids = implode("::",$banner_ids);
			}
			if ($banner_amounts){
				$banner_amounts = implode("::",$banner_amounts);
			}
			if ($banner_renewals){
				$banner_renewals = implode("::",$banner_renewals);
			}
			if ($classified_ids){
				$classified_ids = implode("::",$classified_ids);
			}
			if ($classified_amounts){
				$classified_amounts = implode("::",$classified_amounts);
			}
			if ($classified_renewals){
				$classified_renewals = implode("::",$classified_renewals);
			}
			if ($article_ids){
				$article_ids = implode("::",$article_ids);
			}
			if ($article_amounts){
				$article_amounts = implode("::",$article_amounts);
			}
			if ($article_renewals){
				$article_renewals = implode("::",$article_renewals);
			}
			if ($custominvoice_ids){
				$custominvoice_ids = implode("::",$custominvoice_ids);
			}
			if ($custominvoice_amounts){
				$custominvoice_amounts = implode("::",$custominvoice_amounts);
			}
			$worldpay_callback = str_replace("http://", "", str_replace("https://", "", DEFAULT_URL))."/".MEMBERS_ALIAS."/billing/callback.php";
			$worldpay_account_id = sess_getAccountIdFromSession();
			$worldpay_name = $contactObj->getString("first_name")." ".$contactObj->getString("last_name");
			$worldpay_address = $contactObj->getString("address");
			$worldpay_postcode = $contactObj->getString("zip");
			$worldpay_tel = $contactObj->getString("phone");
			$worldpay_fax = $contactObj->getString("fax");
			$worldpay_email = $contactObj->getString("email");

			?>

			<script type="text/javascript">
				<!--
				function submitOrder() {
					document.getElementById("worldpaybutton").disabled = true;
					document.worldpayform.submit();
				}
				//-->
			</script>

			<form name="worldpayform" target="_self" action="<?=WORLDPAY_HOST?>" method="post">

				<div style="display: none;">

					<?
						$subtotal = $amount;
						if ($payment_tax_status == "on") {
							$worldpay_tax = $payment_tax_value;
							$amount = payment_calculateTax($subtotal, $payment_tax_value);
							$taxAmount = payment_calculateTax($subtotal, $payment_tax_value, true, false);
						} else {
							$worldpay_tax = 0;
						}
					?>

					<input type="hidden" name="pay"           value="1" />
					<input type="hidden" name="instId"        value="<?=WORLDPAY_INSTID?>" />
					<input type="hidden" name="testMode"      value="<?=WORLDPAY_TESTMODE?>" />
					<input type="hidden" name="desc"          value="edirectory renewal" />
					<input type="hidden" name="cartId"        value="<?=uniqid(0);?>" />
					<input type="hidden" name="currency"      value="<?=WORLDPAY_CURRENCY?>" />
					<input type="hidden" name="amount"        value="<?=$amount?>" />
					<input type="hidden" name="MC_tax"        value="<?=$worldpay_tax?>" />
					<input type="hidden" name="MC_subtotal"   value="<?=$subtotal?>" />
					<input type="hidden" name="MC_domain_id"  value="<?=SELECTED_DOMAIN_ID?>" />
					<input type="hidden" name="MC_package_id" value="<?=$package_id?>" />
					<input type="hidden" name="MC_package_renewal" value="<?=$_SESSION["order_renewal_period"]?>" />
					<input type="hidden" name="lang"          value="<?=WORLDPAY_LANG?>" />
					<input type="hidden" name="subst"         value="yes" />
					<input type="hidden" name="MC_ip"         value="<?=$_SERVER["REMOTE_ADDR"]?>" />
					<input type="hidden" name="MC_account_id" value="<?=$worldpay_account_id?>" />
					<input type="hidden" name="MC_callback"   value="<?=$worldpay_callback?>" />

					<input type="hidden" name="MC_edirname" value="<?=EDIRECTORY_TITLE?>" />
					<input type="hidden" name="MC_edirurl"  value="<?=str_replace("http://", "", str_replace("https://", "", DEFAULT_URL))."/".MEMBERS_ALIAS."/".$payment_process."/processpayment.php?payment_method=".$payment_method?>" />

					<input type="hidden" name="MC_listing_ids"           value="<?=$listing_ids?>" />
					<input type="hidden" name="MC_listing_amounts"       value="<?=$listing_amounts?>" />
					<input type="hidden" name="MC_listing_renewals"       value="<?=$listing_renewals?>" />
					<input type="hidden" name="MC_event_ids"             value="<?=$event_ids?>" />
					<input type="hidden" name="MC_event_amounts"         value="<?=$event_amounts?>" />
					<input type="hidden" name="MC_event_renewals"       value="<?=$event_renewals?>" />
					<input type="hidden" name="MC_banner_ids"            value="<?=$banner_ids?>" />
					<input type="hidden" name="MC_banner_amounts"        value="<?=$banner_amounts?>" />
					<input type="hidden" name="MC_banner_renewals"       value="<?=$banner_renewals?>" />
					<input type="hidden" name="MC_classified_ids"        value="<?=$classified_ids?>" />
					<input type="hidden" name="MC_classified_amounts"    value="<?=$classified_amounts?>" />
					<input type="hidden" name="MC_classified_renewals"       value="<?=$classified_renewals?>" />
					<input type="hidden" name="MC_article_ids"           value="<?=$article_ids?>" />
					<input type="hidden" name="MC_article_amounts"       value="<?=$article_amounts?>" />
					<input type="hidden" name="MC_article_renewals"       value="<?=$article_renewals?>" />
					<input type="hidden" name="MC_custominvoice_ids"     value="<?=$custominvoice_ids?>" />
					<input type="hidden" name="MC_custominvoice_amounts" value="<?=$custominvoice_amounts?>" />

				</div>

				<div class="row">
				<div class="col-sm-8 col-sm-offset-2 well">
					<h3>
						<?=system_showText(LANG_LABEL_CUSTOMER_INFO)?>
					</h3>
					<div class="row">
						<div class="form-group col-sm-12">
							<label><?=system_showText(LANG_LABEL_NAME)?>:</label>
							<input class="form-control" type="text" name="name" value="<?=$worldpay_name?>" maxlength="100" />
						</div>

						<div class="form-group col-sm-6">
							<label><?=system_showText(LANG_LABEL_TEL)?>:</label>
							<input class="form-control" type="text" name="tel" value="<?=$worldpay_tel?>" />
						</div>
						<div class="form-group col-sm-6">
							<label><?=system_showText(LANG_LABEL_FAX)?>:</label>
							<input class="form-control" type="text" name="fax" value="<?=$worldpay_fax?>" />
						</div>

						<div class="form-group col-sm-12">
							<label><?=system_showText(LANG_LABEL_EMAIL)?>:</label>
							<input class="form-control" type="text" name="email" value="<?=$worldpay_email?>" />
						</div>
						<div class="form-group col-sm-12">
							<label><?=system_showText(LANG_LABEL_ADDRESS)?>:</label>
							<input class="form-control" type="text" name="address" value="<?=$worldpay_address?>" maxlength="255" />
						</div>
						<div class="form-group col-sm-6">
							<label><?=system_showText(LANG_LABEL_POST_CODE)?>:</label>
							<input class="form-control"  type="text" name="postcode" value="<?=$worldpay_postcode?>" maxlength="15" />
						</div>
						<div class="form-group col-sm-6">
							<label><?=system_showText(LANG_LABEL_COUNTRY)?>:</label>
								<select class="form-control" name="country">
									<option value="00"></option>
									<option value="AF">Afghanistan</option>
									<option value="AL">Albania</option>
									<option value="DZ">Algeria</option>
									<option value="AS">American Samoa</option>
									<option value="AD">Andorra</option>
									<option value="AO">Angola</option>
									<option value="AI">Anguilla</option>
									<option value="AQ">Antarctica</option>
									<option value="AG">Antigua and Barbuda</option>
									<option value="AR">Argentina</option>
									<option value="AM">Armenia</option>
									<option value="AW">Aruba</option>
									<option value="AU">Australia</option>
									<option value="AT">Austria</option>
									<option value="AZ">Azerbaijan</option>
									<option value="BS">Bahamas</option>
									<option value="BH">Bahrain</option>
									<option value="BD">Bangladesh</option>
									<option value="BB">Barbados</option>
									<option value="BY">Belarus</option>
									<option value="BE">Belgium</option>
									<option value="BZ">Belize</option>
									<option value="BJ">Benin</option>
									<option value="BM">Bermuda</option>
									<option value="BT">Bhutan</option>
									<option value="BO">Bolivia</option>
									<option value="BA">Bosnia and Herzegovina</option>
									<option value="BW">Botswana</option>
									<option value="BV">Bouvet Island</option>
									<option value="BR">Brazil</option>
									<option value="IO">British Indian Ocean Territory</option>
									<option value="BN">Brunei Darussalam</option>
									<option value="BG">Bulgaria</option>
									<option value="BF">Burkina Faso</option>
									<option value="BI">Burundi</option>
									<option value="KH">Cambodia</option>
									<option value="CM">Cameroon</option>
									<option value="CA">Canada</option>
									<option value="CV">Cape Verde</option>
									<option value="KY">Cayman Islands</option>
									<option value="CF">Central African Republi</option>c
									<option value="TD">Chad</option>
									<option value="CL">Chile</option>
									<option value="CN">China</option>
									<option value="CX">Christmas Island</option>
									<option value="CC">Cocos (Keeling) Islands</option>
									<option value="CO">Colombia</option>
									<option value="KM">Comoros</option>
									<option value="CG">Congo</option>
									<option value="CK">Cook Islands</option>
									<option value="CR">Costa Rica</option>
									<option value="HR">Croatia</option>
									<option value="CU">Cuba</option>
									<option value="CY">Cyprus</option>
									<option value="CZ">Czech Republic</option>
									<option value="CI">CÃÂ´te d'Ivoire</option>
									<option value="DK">Denmark</option>
									<option value="DJ">Djibouti</option>
									<option value="DM">Dominica</option>
									<option value="DO">Dominican Republic</option>
									<option value="TP">East Timor</option>
									<option value="EC">Ecuador</option>
									<option value="EG">Egypt</option>
									<option value="SV">El salvador</option>
									<option value="GQ">Equatorial Guinea</option>
									<option value="ER">Eritrea</option>
									<option value="EE">Estonia</option>
									<option value="ET">Ethiopia</option>
									<option value="FK">Falkland Islands</option>
									<option value="FO">Faroe Islands</option>
									<option value="FJ">Fiji</option>
									<option value="FI">Finland</option>
									<option value="FR">France</option>
									<option value="GF">French Guiana</option>
									<option value="PF">French Polynesia</option>
									<option value="TF">French Southern Territories</option>
									<option value="GA">Gabon</option>
									<option value="GM">Gambia</option>
									<option value="GE">Georgia</option>
									<option value="DE">Germany</option>
									<option value="GH">Ghana</option>
									<option value="GI">Gibraltar</option>
									<option value="GR">Greece</option>
									<option value="GL">Greenland</option>
									<option value="GD">Grenada</option>
									<option value="GP">Guadeloupe</option>
									<option value="GU">Guam</option>
									<option value="GT">Guatemala</option>
									<option value="GN">Guinea</option>
									<option value="GW">Guinea-Bissau</option>
									<option value="GY">Guyana</option>
									<option value="HT">Haiti</option>
									<option value="HM">Heard Island and McDonald Islands</option>
									<option value="VA">Holy See (Vatican City State)</option>
									<option value="HN">Honduras</option>
									<option value="HK">Hong Kong</option>
									<option value="HU">Hungary</option>
									<option value="IS">Iceland</option>
									<option value="IN">India</option>
									<option value="ID">Indonesia</option>
									<option value="IR">Iran</option>
									<option value="IQ">Iraq</option>
									<option value="IE">Ireland</option>
									<option value="IL">Israel</option>
									<option value="IT">Italy</option>
									<option value="JM">Jamaica</option>
									<option value="JP">Japan</option>
									<option value="JO">Jordan</option>
									<option value="KZ">Kazakstan</option>
									<option value="KE">Kenya</option>
									<option value="KI">Kiribati</option>
									<option value="KW">Kuwait</option>
									<option value="KG">Kyrgystan</option>
									<option value="LA">Lao</option>
									<option value="LV">Latvia</option>
									<option value="LB">Lebanon</option>
									<option value="LS">Lesotho</option>
									<option value="LR">Liberia</option>
									<option value="LY">Libyan Arab Jamahiriya</option>
									<option value="LI">Liechtenstein</option>
									<option value="LT">Lithuania</option>
									<option value="LU">Luxembourg</option>
									<option value="MO">Macau</option>
									<option value="MK">Macedonia (FYR)</option>
									<option value="MG">Madagascar</option>
									<option value="MW">Malawi</option>
									<option value="MY">Malaysia</option>
									<option value="MV">Maldives</option>
									<option value="ML">Mali</option>
									<option value="MT">Malta</option>
									<option value="MH">Marshall Islands</option>
									<option value="MQ">Martinique</option>
									<option value="MR">Mauritania</option>
									<option value="MU">Mauritius</option>
									<option value="YT">Mayotte</option>
									<option value="MX">Mexico</option>
									<option value="FM">Micronesia</option>
									<option value="MD">Moldova</option>
									<option value="MC">Monaco</option>
									<option value="MN">Mongolia</option>
									<option value="MS">Montserrat</option>
									<option value="MA">Morocco</option>
									<option value="MZ">Mozambique</option>
									<option value="MM">Myanmar</option>
									<option value="NA">Namibia</option>
									<option value="NR">Nauru</option>
									<option value="NP">Nepal</option>
									<option value="NL">Netherlands</option>
									<option value="AN">Netherlands Antilles</option>
									<option value="NC">New Caledonia</option>
									<option value="NZ">New Zealand</option>
									<option value="NI">Nicaragua</option>
									<option value="NE">Niger</option>
									<option value="NG">Nigeria</option>
									<option value="NU">Niue</option>
									<option value="NF">Norfolk Island</option>
									<option value="KP">North Korea</option>
									<option value="MP">Northern Mariana Islands</option>
									<option value="NO">Norway</option>
									<option value="OM">Oman</option>
									<option value="PK">Pakistan</option>
									<option value="PW">Palau</option>
									<option value="PS">Palestinian Territory Occupied</option>
									<option value="PA">Panama</option>
									<option value="PG">Papua New Guinea</option>
									<option value="PY">Paraguay</option>
									<option value="PE">Peru</option>
									<option value="PH">Philippines</option>
									<option value="PN">Pitcairn</option>
									<option value="PL">Poland</option>
									<option value="PT">Portugal</option>
									<option value="PR">Puerto Rico</option>
									<option value="QA">Qatar</option>
									<option value="RE">Reunion</option>
									<option value="RO">Romania</option>
									<option value="RU">Russian Federation</option>
									<option value="RW">Rwanda</option>
									<option value="SH">Saint Helena</option>
									<option value="KN">Saint Kitts and Nevis</option>
									<option value="LC">Saint Lucia</option>
									<option value="PM">Saint Pierre and Miquelon</option>
									<option value="VC">Saint Vincent and the Grenadines</option>
									<option value="WS">Samoa</option>
									<option value="SM">San Marino</option>
									<option value="ST">Sao Tome and Principe</option>
									<option value="SA">Saudi Arabia</option>
									<option value="SN">Senegal</option>
									<option value="SC">Seychelles</option>
									<option value="SL">Sierra Leone</option>
									<option value="SG">Singapore</option>
									<option value="SK">Slovakia</option>
									<option value="SI">Slovenia</option>
									<option value="SB">Solomon Islands</option>
									<option value="SO">Somalia</option>
									<option value="ZA">South Africa</option>
									<option value="GS">South Georgia</option>
									<option value="KR">South Korea</option>
									<option value="ES">Spain</option>
									<option value="LK">Sri Lanka</option>
									<option value="SD">Sudan</option>
									<option value="SR">Suriname</option>
									<option value="SJ">Svalbard and Jan Mayen Islands</option>
									<option value="SZ">Swaziland</option>
									<option value="SE">Sweden</option>
									<option value="CH">Switzerland</option>
									<option value="SY">Syria</option>
									<option value="TW">Taiwan</option>
									<option value="TJ">Tajikistan</option>
									<option value="TZ">Tanzania</option>
									<option value="TH">Thailand</option>
									<option value="TG">Togo</option>
									<option value="TK">Tokelau</option>
									<option value="TO">Tonga</option>
									<option value="TT">Trinidad and Tobago</option>
									<option value="TN">Tunisia</option>
									<option value="TR">Turkey</option>
									<option value="TM">Turkmenistan</option>
									<option value="TC">Turks and Caicos Islands</option>
									<option value="TV">Tuvalu</option>
									<option value="UG">Uganda</option>
									<option value="UA">Ukraine</option>
									<option value="AE">United Arab Emirates</option>
									<option value="GB" selected="selected">United Kingdom</option>
									<option value="US">United States</option>
									<option value="UM">United States Minor Outlying Islands</option>
									<option value="UY">Uruguay</option>
									<option value="UZ">Uzbekistan</option>
									<option value="VU">Vanuatu</option>
									<option value="VE">Venezuela</option>
									<option value="VN">Viet Nam</option>
									<option value="VG">Virgin Islands (British)</option>
									<option value="VI">Virgin Islands (U.S.)</option>
									<option value="WF">Wallis and Futuna Islands</option>
									<option value="EH">Western Sahara</option>
									<option value="YE">Yemen</option>
									<option value="YU">Yugoslavia</option>
									<option value="ZR">Zaire</option>
									<option value="ZM">Zambia</option>
									<option value="ZW">Zimbabwe</option>
								</select>

						</div>
					</div>
				</div>

				</div>

				<? if ($payment_process == "signup") {

                    $buttonGateway = "<button class=\"btn btn-success btn-lg\" type=\"button\" id=\"worldpaybutton\" onclick=\"submitOrder();\">".system_highlightWords(system_showText(LANG_LABEL_PLACE_ORDER_CONTINUE))."</button>";

                } else { ?>
					<p class="row text-center">
						<button class="btn btn-success" type="button" id="worldpaybutton" onclick="submitOrder();"><?=system_showText(LANG_BUTTON_PAY_BY_CREDIT_CARD)?></button>
					</p>
				<? } ?>

			</form>

			<?

		}

	}

?>
