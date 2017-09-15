<?php
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/configuration/email.php
	# ----------------------------------------------------------------------------------------------------

	# ----------------------------------------------------------------------------------------------------
	# LOAD CONFIG
	# ----------------------------------------------------------------------------------------------------
	include("../../../conf/loadconfig.inc.php");

	# ----------------------------------------------------------------------------------------------------
	# SESSION
	# ----------------------------------------------------------------------------------------------------
	sess_validateSMSession();
	permission_hasSMPerm();

	# ----------------------------------------------------------------------------------------------------
	# SUBMIT
	# ----------------------------------------------------------------------------------------------------
	extract($_POST);
	extract($_GET);

	if ($ajaxVerify == 1) {
		$json = new Services_JSON();

		$return_json = array();

        $mail = new PHPMailer(false); // the true param means it will throw exceptions on errors, which we need to catch

        /**
        * Get the correct lang from eDirectory
        */
        unset($aux_language_phpmailer);
        setting_get("sitemgr_language", $sitemgr_language);
        $aux_language_phpmailer = unserialize(PHPMAILER_LANGUAGES);
        if (array_search($sitemgr_language, $aux_language_phpmailer)) {
           $langcode = array_search($sitemgr_language, $aux_language_phpmailer);
        }

        $mail->SetLanguage($langcode);

        $mail->IsSMTP(); // telling the class to use SMTP

        $mail->SMTPDebug  = 0;                          // enables SMTP debug information (for testing)
        $mail->SMTPAuth   = true;                       // enable SMTP authentication
        $mail->SMTPSecure = $emailconf_protocol;        // sets the prefix to the servier
        $mail->Host       = $emailconf_host;            // sets GMAIL as the SMTP server
        $mail->Port       = $emailconf_port;            // set the SMTP port for the GMAIL server
        $mail->Username   = trim($emailconf_username);     // GMAIL username
        $mail->Password   = trim($emailconf_password);  // GMAIL password

        $mail->From    = trim($emailconf_email);
        $mail->Subject = EDIRECTORY_TITLE." - Config SMTP Email";
        $mail->Body    = EDIRECTORY_TITLE." - Config SMTP Email";
        $mail->AddAddress(trim($emailconf_email));
        if($mail->Send()){
            $return_json['status'] = 'success';
        } else {
            $return_json['status'] = 'failed';
            $return_json['msg_error'] = $mail->ErrorInfo;
            if ($mail->getSMTPInstance()->getError()) {
                $return_json['msg_error'] .= ' ('.$mail->getSMTPInstance()->getError().')';
            }
        }

		die($json->encode($return_json));

	}

	// Default CSS class for message
	$message_style = "warning";

	if ($_SERVER['REQUEST_METHOD'] == "POST") {

        if (!$adminemail) {

            $error = false;

            if (!setting_set("phpMailer_error", "")) {
                if (!setting_new("phpMailer_error", "")) {
                    $error = true;
                }
            }

            $emailconf_method = str_replace(" ", "", $emailconf_method);
            if (!setting_set("emailconf_method", $emailconf_method)) {
                if (!setting_new("emailconf_method", $emailconf_method)) {
                    $error = true;
                }
            }

            $emailconf_host = str_replace(" ", "", $emailconf_host);
            if (!setting_set("emailconf_host", $emailconf_host)) {
                if (!setting_new("emailconf_host", $emailconf_host)) {
                    $error = true;
                }
            }

            $emailconf_port = str_replace(" ", "", $emailconf_port);
            if (!setting_set("emailconf_port", $emailconf_port)) {
                if (!setting_new("emailconf_port", $emailconf_port)) {
                    $error = true;
                }
            }

            $emailconf_auth = str_replace(" ", "", $emailconf_auth);
            if (!setting_set("emailconf_auth", $emailconf_auth)) {
                if (!setting_new("emailconf_auth", $emailconf_auth)) {
                    $error = true;
                }
            }

            $emailconf_email = str_replace(" ", "", $emailconf_email);
            if (!setting_set("emailconf_email", $emailconf_email)) {
                if (!setting_new("emailconf_email", $emailconf_email)) {
                    $error = true;
                }
            }

            $emailconf_protocol = str_replace(" ", "", $emailconf_protocol);
            if (!setting_set("emailconf_protocol", $emailconf_protocol)) {
                if (!setting_new("emailconf_protocol", $emailconf_protocol)) {
                    $error = true;
                }
            }

            $emailconf_username = str_replace(" ", "", $emailconf_username);
            if (!setting_set("emailconf_username", $emailconf_username)) {
                if (!setting_new("emailconf_username", $emailconf_username)) {
                    $error = true;
                }
            }

            if (isset($emailconf_password) && trim($emailconf_password) != "") {
                $password = str_replace(" ", "", $emailconf_password);
                $emailconf_password = crypt_encrypt(str_replace(" ", "", $emailconf_password));
                if (!setting_set("emailconf_password", $emailconf_password)) {
                    if (!setting_new("emailconf_password", $emailconf_password)) {
                        $error = true;
                    }
                }
            }

            $transport = $emailconf_method;
            $host = $emailconf_host;

            if (strpos($emailconf_host, 'gmail') !== false) {
                $transport = 'gmail';
                $host = '~';
            }

            // YAML File
            $domain = new Domain(SELECTED_DOMAIN_ID);
            $classSymfonyYml = new Symfony('domains/'.$domain->getString('url').'.configs.yml');
            $yamlFile = array(
                'mailer_transport'  => $transport,
                'mailer_host'       => $host,
                'mailer_user'       => $emailconf_username,
                'mailer_password'   => (isset($password) ? $password : '~'),
                'mailer_port'       => $emailconf_port,
                'mailer_encryption' => (isset($emailconf_protocol) ? $emailconf_protocol : '~')
            );

            // Save YAML File
            $classSymfonyYml->save('Configs', array('parameters' => $yamlFile));

            if (!$error) {
                $actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
                $message_style = "success";
            } else {
                $actions[] = "&#149;&nbsp;".system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
            }

            if ($actions) {
                $message_confemail .= implode("<br />", $actions);
            }
        } else {

            if (validate_form("adminemail", $_POST, $message_adminemail)) {

				$error = false;

				$sitemgr_email = str_replace(" ", "", $sitemgr_email);
				if ($sitemgr_email) {
					if (!setting_set("sitemgr_email", $sitemgr_email)) {
						if (!setting_new("sitemgr_email", $sitemgr_email)) {
							$error = true;
						}
					}
				}

				if (!setting_set("sitemgr_send_email", $send_email)) {
					if (!setting_new("sitemgr_send_email", $send_email)) {
						$error = true;
					}
				}

				$sitemgr_listing_email = str_replace(" ", "", $sitemgr_listing_email);
				if (!setting_set("sitemgr_listing_email", $sitemgr_listing_email)) {
					if (!setting_new("sitemgr_listing_email", $sitemgr_listing_email)) {
						$error = true;
					}
				}

				$sitemgr_event_email = str_replace(" ", "", $sitemgr_event_email);
				if (!setting_set("sitemgr_event_email", $sitemgr_event_email)) {
					if (!setting_new("sitemgr_event_email", $sitemgr_event_email)) {
						$error = true;
					}
				}

				$sitemgr_banner_email = str_replace(" ", "", $sitemgr_banner_email);
				if (!setting_set("sitemgr_banner_email", $sitemgr_banner_email)) {
					if (!setting_new("sitemgr_banner_email", $sitemgr_banner_email)) {
						$error = true;
					}
				}

				$sitemgr_classified_email = str_replace(" ", "", $sitemgr_classified_email);
				if (!setting_set("sitemgr_classified_email", $sitemgr_classified_email)) {
					if (!setting_new("sitemgr_classified_email", $sitemgr_classified_email)) {
						$error = true;
					}
				}

				$sitemgr_article_email = str_replace(" ", "", $sitemgr_article_email);
				if (!setting_set("sitemgr_article_email", $sitemgr_article_email)) {
					if (!setting_new("sitemgr_article_email", $sitemgr_article_email)) {
						$error = true;
					}
				}

				$sitemgr_account_email = str_replace(" ", "", $sitemgr_account_email);
				if (!setting_set("sitemgr_account_email", $sitemgr_account_email)) {
					if (!setting_new("sitemgr_account_email", $sitemgr_account_email)) {
						$error = true;
					}
				}

				$sitemgr_contactus_email = str_replace(" ", "", $sitemgr_contactus_email);
				if (!setting_set("sitemgr_contactus_email", $sitemgr_contactus_email)) {
					if (!setting_new("sitemgr_contactus_email", $sitemgr_contactus_email)) {
						$error = true;
					}
				}

				$sitemgr_support_email = str_replace(" ", "", $sitemgr_support_email);
				if (!setting_set("sitemgr_support_email", $sitemgr_support_email)) {
					if (!setting_new("sitemgr_support_email", $sitemgr_support_email)) {
						$error = true;
					}
				}

				$sitemgr_payment_email = str_replace(" ", "", $sitemgr_payment_email);
				if (!setting_set("sitemgr_payment_email", $sitemgr_payment_email)) {
					if (!setting_new("sitemgr_payment_email", $sitemgr_payment_email)) {
						$error = true;
					}
				}

				$sitemgr_rate_email = str_replace(" ", "", $sitemgr_rate_email);
				if (!setting_set("sitemgr_rate_email", $sitemgr_rate_email)) {
					if (!setting_new("sitemgr_rate_email", $sitemgr_rate_email)) {
						$error = true;
					}
				}

				$sitemgr_claim_email = str_replace(" ", "", $sitemgr_claim_email);
				if (!setting_set("sitemgr_claim_email", $sitemgr_claim_email)) {
					if (!setting_new("sitemgr_claim_email", $sitemgr_claim_email)) {
						$error = true;
					}
				}

				$sitemgr_blog_email = str_replace(" ", "", $sitemgr_blog_email);
				if (!setting_set("sitemgr_blog_email", $sitemgr_blog_email)) {
					if (!setting_new("sitemgr_blog_email", $sitemgr_blog_email)) {
						$error = true;
					}
				}

				$sitemgr_import_email = str_replace(" ", "", $sitemgr_import_email);
				if (!setting_set("sitemgr_import_email", $sitemgr_import_email)) {
					if (!setting_new("sitemgr_import_email", $sitemgr_import_email)) {
						$error = true;
					}
				}

				if (!$error) {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_SETTINGS_YOURSETTINGSWERECHANGED);
					$message_style = "success";
				} else {
					$actions[] = '&#149;&nbsp;'.system_showText(LANG_SITEMGR_MSGERROR_SYSTEMERROR);
				}

				if ($actions) {
					$message_adminemail .= implode("<br />", $actions);
				}

			}

        }

	}

	# ----------------------------------------------------------------------------------------------------
	# FORMS DEFINES
	# ----------------------------------------------------------------------------------------------------
	if (!$emailconf_method) {
        setting_get("emailconf_method", $emailconf_method);
    }
	if (!$emailconf_host) {
        setting_get("emailconf_host", $emailconf_host);
    }
	if (!$emailconf_port) {
        setting_get("emailconf_port", $emailconf_port);
    }
	if (!$emailconf_auth) {
        setting_get("emailconf_auth", $emailconf_auth);
    }
	if (!$emailconf_auth) {
        $emailconf_auth = 'normal';
    }
	if (!$emailconf_email) {
        setting_get("emailconf_email", $emailconf_email);
    }
	if (!$emailconf_protocol) {
        setting_get("emailconf_protocol", $emailconf_protocol);
    }
	if (!$emailconf_username) {
        setting_get("emailconf_username", $emailconf_username);
    }
	if (!$emailconf_password) {
        setting_get("emailconf_password", $emailconf_password);
    }

	$styleButtonChange = "onchange=\"disableButton();\"";

    if (!$sitemgr_email) setting_get("sitemgr_email", $sitemgr_email);
	setting_get("sitemgr_send_email", $send_email); if ($send_email) $send_email_checked = "checked";
	if (!$sitemgr_listing_email) setting_get("sitemgr_listing_email", $sitemgr_listing_email);
	if (!$sitemgr_event_email) setting_get("sitemgr_event_email", $sitemgr_event_email);
	if (!$sitemgr_banner_email) setting_get("sitemgr_banner_email", $sitemgr_banner_email);
	if (!$sitemgr_classified_email) setting_get("sitemgr_classified_email", $sitemgr_classified_email);
	if (!$sitemgr_article_email) setting_get("sitemgr_article_email", $sitemgr_article_email);
	if (!$sitemgr_account_email) setting_get("sitemgr_account_email", $sitemgr_account_email);
	if (!$sitemgr_contactus_email) setting_get("sitemgr_contactus_email", $sitemgr_contactus_email);
	if (!$sitemgr_support_email) setting_get("sitemgr_support_email", $sitemgr_support_email);
	if (!$sitemgr_payment_email) setting_get("sitemgr_payment_email", $sitemgr_payment_email);
	if (!$sitemgr_rate_email) setting_get("sitemgr_rate_email", $sitemgr_rate_email);
	if (!$sitemgr_claim_email) setting_get("sitemgr_claim_email", $sitemgr_claim_email);
	if (!$sitemgr_blog_email) setting_get("sitemgr_blog_email", $sitemgr_blog_email);
	if (!$sitemgr_import_email) setting_get("sitemgr_import_email", $sitemgr_import_email);

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
	include(SM_EDIRECTORY_ROOT."/layout/sidebar-configuration.php");

?>

    <main class="wrapper togglesidebar container-fluid">

        <?php
        require(SM_EDIRECTORY_ROOT."/registration.php");
        require(EDIRECTORY_ROOT."/includes/code/checkregistration.php");
        require(EDIRECTORY_ROOT."/frontend/checkregbin.php");
        ?>

<!--        <div class="row">
            <div class="progress">
              <div class="progress-bar" data-placement="bottom" data-toggle="tooltip" data-original-title="5% Complete" role="progressbar" aria-valuenow="5" aria-valuemin="0" aria-valuemax="100" style="width: 5%;">
                <span class="sr-only">5% Complete</span>
              </div>
            </div>
        </div>-->

        <section class="heading">
            <h1><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?></h1>
            <p><?=system_showText(LANG_SITEMGR_SETTINGS_TIP_2);?></p>
        </section>

        <div class="row tab-options">

            <ul class="nav nav-tabs" role="tablist">
                <li class="<?=($message_confemail || !$_POST ? "active" : "")?>"><a href="#config" role="tab" data-toggle="tab"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_EMAILSENDINGCONFIGURATION);?></a></li>
                <li class="<?=($message_adminemail ? "active" : "")?>"><a href="#admin" role="tab" data-toggle="tab"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAIL_ADMINISTRATOREMAIL)?></a></li>
            </ul>

            <div class="row tab-content">
                <section id="config" class="tab-pane <?=($message_confemail || !$_POST ? "active" : "")?>">
                    <? include(INCLUDES_DIR."/forms/form-emailconfiguration.php"); ?>
                </section>

                <section id="admin" class="tab-pane <?=($message_adminemail ? "active" : "")?>">
                    <? include(INCLUDES_DIR."/forms/form-adminemail.php"); ?>
                </section>
            </div>
        </div>

    </main>

<?
	# ----------------------------------------------------------------------------------------------------
	# FOOTER
	# ----------------------------------------------------------------------------------------------------
	$customJS = SM_EDIRECTORY_ROOT."/assets/custom-js/emailconfig.php";
    include(SM_EDIRECTORY_ROOT."/layout/footer.php");
?>
