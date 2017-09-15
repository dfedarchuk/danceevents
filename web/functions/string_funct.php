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
	# * FILE: /functions/string_functions.php
	# ----------------------------------------------------------------------------------------------------
	
	/**
	 * Returns the numeric position of the first occurrence of needle in the haystack string.
	 * Unlike the strrpos() before PHP 5, this function can take a full string as the needle parameter and the entire string will be used.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_strpos
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-strpos.php">mb_strpos</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.strpos.php">strpos</a><br />
	 * @param string $haystack
	 * @param mixed $needle
	 * @param integer $offset 0
	 * @param string $charset EDIR_CHARSET
	 * @return integer $position
	 */
	function string_strpos($haystack, $needle, $offset = 0, $charset = EDIR_CHARSET) {
		if (isset($haystack) && isset($needle) || (is_numeric($haystack) && is_numeric($needle))) {
			if (is_array($haystack)) $haystack = implode(",", $haystack);
			if (function_exists('mb_strpos')) {
				$position = mb_strpos($haystack, $needle, $offset, $charset);
			} else {
				$position = strpos($haystack, $needle, $offset);
			}
		} else {
			$position = false;
		}
		return $position;
	}

	/**
	 * Returns string with all alphabetic characters converted to lowercase.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_strtolower
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-strtolower.php">mb_strtolower</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.strtolower.php">strtolower</a><br />
	 * @param string $str
	 * @param string $charset EDIR_CHARSET
	 * @return string $strLower
	 */
	function string_strtolower($str, $charset = EDIR_CHARSET) {
		if (isset($str) || is_numeric($str)) {
			if (function_exists('mb_strtolower')) {
				$strLower = mb_strtolower($str, $charset);
			} else {
				$strLower = strtolower($str);
			}
		} else {
			$strLower = false;
		}
		return $strLower;
	}

	/**
	 * Returns string with all alphabetic characters converted to uppercase.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_strtoupper
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-strtoupper.php">mb_strtoupper</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.strtoupper.php">strtoupper</a><br />
	 * @param string $str
	 * @param string $charset EDIR_CHARSET
	 * @return string $strUpper
	 */
	function string_strtoupper($str, $charset = EDIR_CHARSET) {
		if (isset($str) || !is_numeric($str)) {
			if (function_exists('mb_strtoupper')) {
				$strUpper = mb_strtoupper($str, $charset);
			} else {
				$strUpper = strtoupper($str);
			}
		} else {
			$strUpper = false;
		}
		return $strUpper;
	}

	/**
	 * Returns a string with the first character of each word in str capitalized, if that character is alphabetic.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_ucwords
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-convert-case.php">mb_convert_case</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.ucwords.php">ucwords</a><br />
	 * @param string $str
	 * @param string $charset EDIR_CHARSET
	 * @return strin $strUCWords
	 */
	function string_ucwords($str, $charset = EDIR_CHARSET) {
		if (isset($str) || is_numeric($str)) {
			if (function_exists('mb_convert_case')) {
				$strUCWords = mb_convert_case($str, MB_CASE_TITLE, $charset);
			} else {
				$strUCWords = ucwords($str);
			}
		} else {
			$strUCWords = false;
		}
		return $strUCWords;
	}

	/**
	 * Returns the portion of string specified by the start and length parameters.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_substr
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-substr.php">mb_substr</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.substr.php">substr</a><br />
	 * @param string $string
	 * @param integer $start
	 * @param integer $length false
	 * @param string $charset EDIR_CHARSET
	 * @return string $subStr
	 */
	function string_substr($string, $start, $length = false, $charset = EDIR_CHARSET) {
		if ((isset($string) || is_numeric($string)) && is_numeric($start)) {
			if (function_exists('mb_substr')) {
				if (!$length) $length = string_strlen($string);
				$subStr = mb_substr($string, $start, $length, $charset);
			} else {
				if ($length) $subStr = substr($string, $start, $length);
				else $subStr = substr($string, $start);
			}
		} else {
			$subStr = false;
		}
		return $subStr;
	}

	/**
	 * Returns the length of the given string.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_strlen
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-strlen.php">mb_strlen</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.strlen.php">strlen</a><br />
	 * @param string $string
	 * @param string $charset EDIR_CHARSET
	 * @return string $strLen
	 */
	function string_strlen($str, $charset = EDIR_CHARSET) {
		if (isset($str) || is_numeric($str)) {
			if (function_exists('mb_strlen') && !is_array($str)) {
				$strLen = mb_strlen($str, $charset);
			} else {
				$strLen = strlen($str);
			}
		} else {
			$strLen = false;
		}
		return $strLen;
	}

	/**
	 * This function is identical to htmlspecialchars() in all ways, except
	 * with htmlentities(), all characters which have HTML character entity equivalents are translated into these entities.<br />
	 * Pay attencion in $flags parameter:<br />
	 * [ENT_COMPAT]: Will convert double-quotes and leave single-quotes alone.<br />
	 * [ENT_QUOTES]: Will convert both double and single quotes.<br />
	 * [ENT_NOQUOTES]: Will leave both double and single quotes unconverted.<br />
	 * [ENT_IGNORE]: Silently discard invalid code unit sequences instead of returning an empty string.
	 * Added in PHP 5.3.0. This is provided for backwards compatibility; avoid using it as it may have security implications.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_htmlentities
	 * @example See the link <a href="http://www.php.net/manual/en/function.htmlentities.php">htmlentities</a><br />
	 * @param string $string
	 * @param string $flags ENT_COMPAT
	 * @param string $charset EDIR_CHARSET
	 * @return string $htmlEntities
	 */
	function string_htmlentities($string, $flags = ENT_COMPAT, $charset = EDIR_CHARSET, $double_encode = true) {
		if (isset($string) || is_numeric($string)) {
			$htmlEntities = htmlentities($string, $flags, $charset);
		} else {
			$htmlEntities = false;
		}
		return $htmlEntities;
	}

	/**
	 * Returns the numeric position of the last occurrence of needle in the haystack string.
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_strrpos
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-strrpos.php">mb_strrpos</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.strrpos.php">strrpos</a><br />
	 * @param string $haystack
	 * @param string $needle
	 * @param integer $offset 0
	 * @param string $charset EDIR_CHARSET
	 * @return integer $position
	 */
	function string_strrpos($haystack, $needle, $offset = 0, $charset = EDIR_CHARSET) {
		if ((isset($haystack) && isset($needle)) || (is_numeric($haystack) && is_numeric($needle))) {
			if (function_exists('mb_strrpos')) {
				$position = mb_strrpos($haystack, $needle, $charset);
			} else {
				$position = strrpos($haystack, $needle, $offset);
			}
		} else {
			$position = false;
		}
		return $position;
	}

	/**
	 * Returns the number of times the needle substring occurs in the haystack string. Please note that needle is case sensitive.<br />
	 * Note: This function doesn't count overlapped substrings. See the example below!
	 * @copyright Copyright 2005 Arca Solutions, Inc.
	 * @author Arca Solutions, Inc.
	 * @name string_substr_count
	 * @example With 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.mb-substr-count.php">mb_substr_count</a><br />
	 *			Without 'mb_string' activated see the link <a href="http://www.php.net/manual/en/function.substr-count.php">substr_count</a><br />
	 * @param string $haystack
	 * @param string $needle
	 * @param integer $offset 0
	 * @param integer $length false
	 * @param string $charset EDIR_CHARSET
	 * @return integer $count
	 */
	function string_substr_count($haystack, $needle, $offset = 0, $length = false, $charset = EDIR_CHARSET) {
		if ((isset($haystack) && isset($needle)) || (is_numeric($haystack) && is_numeric($needle))) {
			if (function_exists('mb_substr_count')) {
				$count = mb_substr_count($haystack, $needle, $charset);
			} else {
				if ($length) $count = substr_count($haystack, $needle, $offset, $length);
				else $count = substr_count($haystack, $needle, $offset);
			}
		} else {
			$count = false;
		}
		return $count;
	}

	function string_replace_once($str_pattern, $str_replacement, $string){

        if (strpos($string, $str_pattern) !== false){
            $occurrence = strpos($string, $str_pattern);
            return substr_replace($string, $str_replacement, strpos($string, $str_pattern), strlen($str_pattern));
        }

        return $string;
    }
    
    /**
    * Converts elements divided by newline characters to list items
    * @param String $text
    */
    function string_nl2li($text) {
        $openingLi = '<li>';

        $parsedText = '';

        $token = strtok($text, "\n");
        while($token !== false) {
            $parsedText .= $openingLi.$token.'</li>'.PHP_EOL;

            $token = strtok("\n");
        }

        return $parsedText;
    }