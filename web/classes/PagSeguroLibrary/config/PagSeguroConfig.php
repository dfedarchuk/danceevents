<?php if (!defined('ALLOW_PAGSEGURO_CONFIG')) { die('No direct script access allowed'); }
/*
************************************************************************
PagSeguro Config File
************************************************************************
*/

$PagSeguroConfig = array();

$PagSeguroConfig['environment'] = Array();
$PagSeguroConfig['environment']['environment'] = "production";

$PagSeguroConfig['credentials'] = Array();
$PagSeguroConfig['credentials']['email'] = PAGSEGURO_EMAIL;
$PagSeguroConfig['credentials']['token'] = PAGSEGURO_TOKEN;

$PagSeguroConfig['application'] = Array();
$PagSeguroConfig['application']['charset'] = EDIR_CHARSET; // UTF-8, ISO-8859-1

$PagSeguroConfig['log'] = Array();
$PagSeguroConfig['log']['active'] = FALSE;
$PagSeguroConfig['log']['fileLocation'] = EDIRECTORY_ROOT."/custom/domain_".SELECTED_DOMAIN_ID."/logpagseguro.txt";

?>