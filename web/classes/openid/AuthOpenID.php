<?php

class AuthOpenID {

	var $identity;
	var $trust_root;
	var $return_to;
	var $required_fields = array();
	var $optional_fields = array();

	function AuthOpenID($identity, $trust_root = "", $return_to = "", $required_fields = array(), $optional_fields = array()) {
		if (!function_exists('curl_exec')) throw new Exception('Error: Class AuthOpenID requires CURL extension.');
		if ((stripos($identity, 'http://') === false) && (stripos($identity, 'https://') === false)) {
			$identity = 'http://'.$identity;
		}
		$this->identity = $identity;
		$this->trust_root = $trust_root;
		$this->return_to = $return_to;
		$this->required_fields = $required_fields;
		$this->optional_fields = $optional_fields;
	}

	function requestAuth() {
		$server = $this->resolveServer();
		$params = array();
		$params['openid.identity'] = urlencode($this->identity);
		$params['openid.return_to'] = urlencode($this->return_to);
		$params['openid.trust_root'] = urlencode($this->trust_root);
		$params['openid.mode'] = 'checkid_setup';
		if (count($this->required_fields) > 0) $params['openid.sreg.required'] = implode(',',$this->required_fields);
		if (count($this->optional_fields) > 0) $params['openid.sreg.optional'] = implode(',',$this->optional_fields);
		header("Location: " . $server . "?" . $this->array2url($params));
	}

	function validateAuth($pars) {
		$server = $this->resolveServer();
		$params = array('openid.assoc_handle' => urlencode($pars['openid_assoc_handle']),'openid.signed' => urlencode($pars['openid_signed']),'openid.sig' => urlencode($pars['openid_sig']));
		$arr_signed = explode(",",str_replace('sreg.','sreg_',$pars['openid_signed']));
		for ($i=0; $i<count($arr_signed); $i++) {
			$s = str_replace('sreg_','sreg.', $arr_signed[$i]);
			$c = $pars['openid_' . $arr_signed[$i]];
			$params['openid.' . $s] = urlencode($c);
		}
		$params['openid.mode'] = "check_authentication";
		$response = $this->request($server,'POST',$params);
		$data = $this->splitResponse($response);
		if ($data['is_valid'] != "true") return false;
		$u = parse_url(string_strtolower(trim($this->identity)));
		if (!isset($u['path']) || ($u['path'] == '/')) $u['path'] = "";
		if(string_substr($u['path'],-1,1) == '/') $u['path'] = string_substr($u['path'], 0, string_strlen($u['path'])-1);
		if (isset($u['query'])) $identity = $u['host'] . $u['path'] . '?' . $u['query'];
		else $identity = $u['host'] . $u['path'];
		$pars["openid_identity_standardized"] = $identity;
		$pars["openid_identity_hash"] = md5($pars["openid_identity_standardized"]);
		return $pars;
	}

	function resolveServer() {
		$content = $this->request($this->identity);
		preg_match_all('/<link[^>]*rel=[\'"]openid.server[\'"][^>]*href=[\'"]([^\'"]+)[\'"][^>]*\/?>/i', $content, $matches1);
		preg_match_all('/<link[^>]*href=\'"([^\'"]+)[\'"][^>]*rel=[\'"]openid.server[\'"][^>]*\/?>/i', $content, $matches2);
		$servers = array_merge($matches1[1], $matches2[1]);
		preg_match_all('/<link[^>]*rel=[\'"]openid.delegate[\'"][^>]*href=[\'"]([^\'"]+)[\'"][^>]*\/?>/i', $content, $matches1);
		preg_match_all('/<link[^>]*href=[\'"]([^\'"]+)[\'"][^>]*rel=[\'"]openid.delegate[\'"][^>]*\/?>/i', $content, $matches2);
		$delegates = array_merge($matches1[1], $matches2[1]);
		if (count($servers) == 0) { throw new Exception("Couldn't find OpenID server."); }
		if (isset($delegates[0]) && ($delegates[0] != "")) { $this->identity = $delegates[0]; }
		return $servers[0];
	}

	private function request($url, $method="GET", $params = "") {
		if (is_array($params)) $params = $this->array2url($params);
		$curl = curl_init($url . ($method == "GET" && $params != "" ? "?" . $params : ""));
		curl_setopt($curl, CURLOPT_FOLLOWLOCATION, true);
		curl_setopt($curl, CURLOPT_HEADER, false);
		curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);
		curl_setopt($curl, CURLOPT_HTTPGET, ($method == "GET"));
		curl_setopt($curl, CURLOPT_POST, ($method == "POST"));
		if ($method == "POST") curl_setopt($curl, CURLOPT_POSTFIELDS, $params);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$response = curl_exec($curl);
		if (curl_errno($curl) == 0) return $response;
		throw new Exception("Couldn't find OpenID Server.");
	}

	private function array2url($arr) {
		if (!is_array($arr)) return false;
		$query = "";
		foreach($arr as $key => $value) {
			$query .= $key . "=" . $value . "&";
		}
		$query = string_substr($query,0,string_strlen($query)-1);
		return $query;
	}

	private function splitResponse($response) {
		$r = array();
		$response = explode("\n", $response);
		foreach($response as $line) {
			$line = trim($line);
			if ($line != "") {
				list($key, $value) = explode(":", $line, 2);
				$r[trim($key)] = trim($value);
			}
		}
		return $r;
	}

}
