<?php

class Handle {

    function Handle() {}

    function getString($field, $special_chars=true, $length = 0, $extraChar = "...", $ent_quotes = true) {
        $value = $this->$field;
        if (!is_string($value)) return $value;
        $value = ($length > 0) ? system_showTruncatedText($value, $length, $extraChar, true) : $value;
        $value = ($special_chars) ? ($ent_quotes ? htmlspecialchars($value, ENT_NOQUOTES) : htmlspecialchars($value)) : $value ;
        return $value;
    }

    function getNumber($field, $special_chars=false) {
        $value = $this->$field;
        if (!is_string($value)) return $value;
        $value = ($special_chars) ? htmlspecialchars($value) : $value ;
        return $value;
    }

    function getDate($field) {
        $aux = explode("-", $this->$field);
        if (count($aux) == 3) {
            if (DEFAULT_DATE_FORMAT == "m/d/Y") {
                return $aux[1]."/".$aux[2]."/".$aux[0];
            } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
                return $aux[2]."/".$aux[1]."/".$aux[0];
            }
        } else {
            return "00/00/0000";
        }
    }

    function getBoolean($field) {
        if ($this->$field) return true;
        else return false;
    }

    function setString($field, $string) {
        $this->$field = $string;
    }

    function setNumber($field, $number) {
        if (is_numeric($number)) $this->$field = $number;
        else $this->$field = 0;
    }

    function setBoolean($field, $bool) {
        if ($bool) $this->$field = 1;
        else $this->$field = 0;
    }

    function setDate($field, $date) {

        if (string_strpos($date, "/")) {

            $aux = explode("/", $date);

            if (count($aux) == 3) {

                if (DEFAULT_DATE_FORMAT == "m/d/Y") {
                    $month = $aux[0];
                    $day = $aux[1];
                    $year = $aux[2];
                } elseif (DEFAULT_DATE_FORMAT == "d/m/Y") {
                    $month = $aux[1];
                    $day = $aux[0];
                    $year = $aux[2];
                }

                if (checkdate((int)$month, (int)$day, (int)$year)) {
                    $this->$field = $year."-".$month."-".$day;
                } else {
                    $this->$field = "0000-00-00";
                }

            } else {
                $this->$field = "0000-00-00";
            }

        } else if (string_strpos($date, "-")) {

            $aux = explode("-", $date);

            if (count($aux) == 3) {

                if (checkdate((int)$aux[1], (int)$aux[2], (int)$aux[0])) {
                    $this->$field = $date;
                } else {
                    $this->$field = "0000-00-00";
                }

            } else {
                $this->$field = "0000-00-00";
            }

        } else {
            $this->$field = "0000-00-00";
        }

    }

    function prepareToSave() {

        ## backslashes manage and other stuff manage
        $vars = get_object_vars($this);

        // regular expression to match date
        $regexp_date = "/^([0-9]{1,2})\/([0-9]{1,2})\/([0-9]{4})$/";

        for ($i=0; $i<count($vars); $i++) {
            $key = each($vars);
            if ($key['value'] == "NULL") {
                $this->setString($key['key'], "{$key["value"]}");
            } elseif (is_numeric($key["value"])) {
                $this->setNumber($key["key"], $key["value"]);
            } elseif (is_string($key['value'])) {
                if (preg_match($regexp_date, $key["value"])) {
                    $this->setDate($key["key"], $key["value"]);
                    $this->setString($key["key"], "'".$this->$key["key"]."'");
                } else {
                    //CR 50319
//						if ($this->string_needs_addslashes($key["value"]) || !get_magic_quotes_gpc()){
//							$key["value"] = addslashes($key["value"]);
//						}
                    if ((string_strpos($key["value"],"\'") !== false) || (string_strpos($key["value"],"\\") !== false) || (string_strpos($key["value"],"\\\"") !== false) || !get_magic_quotes_gpc()){

                        $key["value"] = stripslashes($key["value"]);
                    }
                    $key["value"]  = addslashes($key["value"]);
                    $this->setString($key["key"], "'".$key["value"]."'");
                }
            }  else {
                $this->setString($key["key"], "'".$key["value"]."'");
            }
        }

    }

    function prepareToUse() {
        $vars = get_object_vars($this);
        for ($i=0; $i < count($vars); $i++) {
            $key = each($vars);
            if ($key["value"] == "''" || $key["value"] === "NULL") $this->setString($key["key"], "");
            else if (!is_numeric($key["value"])) $this->setString($key["key"], string_substr($key["value"], 1, string_strlen($key["value"])-2));
            $this->setString($key["key"], stripslashes($this->getString($key["key"], false)));
        }
    }

    function string_needs_addslashes($str) {
        if (($qp = string_strpos($str,"'")) !== false || ($qp = string_strpos($str,"\"")) !== false) {
            if ($str[$qp-1] != "\\") return true;
            else return $this->string_needs_addslashes(string_substr($str,$qp+1,string_strlen($str)));
        }
        return false;
    }

    function extract() {

        // regular expression to match date
        $regexp_date = "/^([0-9]{4})-([0-9]{1,2})-([0-9]{1,2})$/";

        // regular expression to match decimal.
        $regexp_decimal = "/^([0-9]{1,}).([0-9]{2,2})$/";

        // getting the variables for this class
        $vars = get_object_vars($this);

        for ($i=0; $i < count($vars); $i++) {

            $key = each($vars);

            global $$key["key"];

            if (count($key["value"]) > 1) {
                $value = $key["value"];
            } else if ($key["value"] && preg_match($regexp_date, $key["value"])){
                $value = $this->getDate("{$key["key"]}");
                if ($value == "00/00/0000") unset($value);
            } elseif ($key["value"] && preg_match($regexp_decimal, $key["value"])) {
                $value = $key["value"];
            } else {
                $value = $key["value"] == 'NULL' ? null : $key['value'];
            }

            $$key["key"] = (isset($value) && (!is_array($value)) && !is_object($value)) ? htmlspecialchars($value) : $value;

        }

    }

    /**
     * @copyright Copyright 2005 Arca Solutions, Inc.
     * @author Arca Solutions, Inc.
     * @name getFriendlyURL
     * @access Public
     * @param boolean $mobile
     */
    function getFriendlyURL($mobile = false, $module_url = false, $field = "friendly_url", $show_html = "on") {

        return ($module_url ? $module_url."/" : "").$this->$field.".html";

    }
}
