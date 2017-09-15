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
	# * FILE: /classes/class_eDirMailer.php
	# ----------------------------------------------------------------------------------------------------

	class EDirMailer {

		var $to;
		var $subject;
		var $message;
		var $from;
		var $reply;
		var $cc;
		var $bcc;
		var $attachPath;
		var $attachName;
		var $content_type;
		var $charset;
		var $extra_headers;
		var $msgerror;
		var $_phpmailer;
		var $SMTPKeepAlive;

		var $emailconf_method;
		var $emailconf_host;
		var $emailconf_port;
		var $emailconf_auth;
		var $emailconf_email;
		var $emailconf_username;
		var $emailconf_password;
        var $emailconf_protocol;

		function EDirMailer($to="", $subject="", $message="", $from="", $reply="") {
			$this->to      = $to;
			$this->subject = $subject;
			$this->message = $message;
			$this->from    = $from;
			$this->reply   = $reply;
			$this->charset = "utf-8";
			$this->loadEmailConfig();
		}

		function loadEmailConfig() {
			setting_get('emailconf_method', $this->emailconf_method);
			setting_get('emailconf_host', $this->emailconf_host);
			setting_get('emailconf_port', $this->emailconf_port);
			setting_get('emailconf_auth', $this->emailconf_auth);
			setting_get('emailconf_email', $this->emailconf_email);
			setting_get('emailconf_username', $this->emailconf_username);
			setting_get('emailconf_password', $this->emailconf_password);
			setting_get('emailconf_protocol', $this->emailconf_protocol);
		}

		function setCC($cc="") {
			$this->cc = $cc;
		}

		function setBCC($bcc="") {
			$this->bcc = $bcc;
		}
        
        function setAttachment($attachPath="", $attachName="") {
			$this->attachPath = $attachPath;
			$this->attachName = $attachName;
		}

		function setContentType($content_type="") {
			$this->content_type = $content_type;
		}

		function setCharset($charset="") {
			$this->charset = $charset;
		}

		function setExtraHeaders($extra_headers="") {
			$this->extra_headers = $extra_headers;
		}

		function send() {

			if (!$this->to || !$this->subject || !$this->message) {
				return false;
			}

			if (!$this->content_type) {
				$this->content_type = "text/plain";
			}

			$message = str_replace("\r\n", "\n", $message);
			$message = str_replace("\r", "\n", $message);
			if ($this->content_type == "text/plain") {
				$message = str_replace("<br />", "\n", $message);
				$message = str_replace("<br>", "\n", $message);
				$message = strip_tags($message);
			}

			if (!$this->_phpmailer) {
				$this->_phpmailer = new PHPMailer();
			}

			$this->_phpmailer->Subject = $this->subject;

			$this->_phpmailer->SetLanguage($this->getLang(), $this->getLangPath());

			$this->_phpmailer->From = $this->from;

			$this->_phpmailer->Sender = $this->emailconf_email;

			if (!$this->emailconf_email && $this->emailconf_method == 'mail') {
				setting_get('sitemgr_email', $this->_phpmailer->Sender);
			}

			$this->_phpmailer->AddAddress($this->to);

			if ($this->cc) {
				$this->_phpmailer->AddCC($this->cc);
			}

			if ($this->bcc) {
				$this->_phpmailer->AddBCC($this->bcc);
			}
            
            if ($this->reply){
				$this->_phpmailer->AddReplyTo($this->reply);
			}
            
            if ($this->attachPath && $this->attachName) {
				$this->_phpmailer->AddAttachment($this->attachPath, $this->attachName);
			}

			$this->_phpmailer->ContentType = $this->content_type;

			if ((!$this->charset) && ($this->content_type == "text/html")) {
				$this->_phpmailer->CharSet = $this->charset;
			}

			$this->_phpmailer->Body = $this->message;

			$this->_phpmailer->Mailer = $this->emailconf_method;

			if ($this->emailconf_method == 'smtp') {
				$this->_phpmailer->Host = $this->emailconf_host;
				$this->_phpmailer->SMTPKeepAlive = $this->SMTPKeepAlive;
				if ($this->emailconf_auth != 'noauth') {
					$this->_phpmailer->SMTPAuth = true;
					$this->_phpmailer->Port     = $this->emailconf_port;
					$this->_phpmailer->Username = $this->emailconf_username;
					$this->_phpmailer->Password = "";
					if ($this->emailconf_password) {
						$this->_phpmailer->Password = crypt_decrypt($this->emailconf_password);
					}
					$this->_phpmailer->SMTPSecure = false;
					if ($this->emailconf_auth == 'secure') {
                        $this->_phpmailer->SMTPSecure = ($this->emailconf_protocol ? $this->emailconf_protocol : "ssl"); 
					}
				}
			}

			$return_flag = $this->_phpmailer->Send();

			$this->clearAll();

			$this->msgerror = $this->_phpmailer->ErrorInfo;

			if ($this->msgerror) {
                if (!setting_set("phpMailer_error", "1")) {
                   setting_new("phpMailer_error", "1");
                }
            }

			return $return_flag;

		}

		function clearAll() {
			if (isset($this->_phpmailer)) {
				$this->_phpmailer->ClearAddresses();
				$this->_phpmailer->ClearBCCs();
				$this->_phpmailer->ClearCCs();
				$this->_phpmailer->ClearCustomHeaders();
				$this->_phpmailer->ClearReplyTos();
			}
			$this->cc  = "";
			$this->bcc = "";
		}

		function getLang() {
			$phpmailer_langfile = 'phpmailer.lang-';
			$phpmailer_lang     = '';
			if (trim(EDIR_LANGUAGE) != "") {
				$_lang = explode('_', EDIR_LANGUAGE);
				for ($i = (count($_lang)-1); $i >= 0; $i--) {
					if (file_exists($this->getLangPath().$phpmailer_langfile. $_lang[$i].'.php')) {
						$phpmailer_lang = $_lang[$i];
					}
				}
			}
			return $phpmailer_lang;
		}

		function getLangPath() {
			return CLASSES_DIR.'/phpmailer/language/';
		}

	}

?>
