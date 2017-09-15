<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/emailconfig.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        
        //top variables
        html_testconn = "<a href=\"javascript:void(0)\" onclick=\"doVerifyConnect()\" class=\"btn btn-info\"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_CLICKHERETOTEST)?></a> <p class=\"help-block\">(<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_PLEASEDOTHISBEFORESAVE)?>)</p>";
        html_animloading = "<img src=\"<?=DEFAULT_URL.'/'.SITEMGR_ALIAS.'/assets/img/preloader-32.gif'?>\" border=\"0\" align=\"absmiddle\" />";
        radiovalues = {'normal' : 1, 'secure' : 2, 'noauth' : 3};

        $("#bt_submit").click( function () {
            var btn = $(this);
            btn.button('loading');
        });


        function initForm() {
            $('#protocol').prop('disabled', 'disabled');
            switchAuth('<?=$emailconf_auth?>');
            $('#response').html(html_testconn);
        }

        $("document").ready(initForm);

        function changeMethod() {
            if ($('#method').attr('value') == 'smtp') {
                $('#form-smtp').css('display', 'block');
                $("#bt_submit").prop('disabled', 'disabled');
                $("#bt_submit").attr('class', 'btn btn-default action-save');
            } else {
                $('#form-smtp').css('display', 'none');
                $("#bt_submit").prop('disabled', '');
                $("#bt_submit").attr('class', 'btn btn-primary action-save');
            }
        }
        function switchAuth(auth) {

            array_default_ports = new Array('25', '465', '587'); /* normal, secure (ssl/tls) */
            $("#auth"+radiovalues[auth]).attr('checked', true);
            if (auth == 'normal' || auth == 'secure') {
                if (auth == "secure") {
                    $('#protocol').prop('disabled', '');
                } else {
                    $('#protocol').prop('disabled', 'disabled');
                }
                $('#username').prop('disabled', '');
                $('#password').prop('disabled', '');
                $('#username').attr('className', '');
                $('#password').attr('className', '');
            } else {
                $('#protocol').prop('disabled', 'disabled');
                $('#username').prop('disabled', 'disabled');
                $('#password').prop('disabled', 'disabled');
                $('#username').attr('className', 'inputReadOnly');
                $('#password').attr('className', 'inputReadOnly');
            }
            if (auth == 'secure') {

                /*
                 * Choosing the correct port
                 */
                switchPorts($('#protocol').val());

            } else {
                $('#port').attr('value', array_default_ports[0]);
            }
        }

        function switchPorts (OptionPort) {
            if (OptionPort == "ssl") {
                $("#port").attr("value", "465");
            } else {
                $("#port").attr("value", "587");
            }
        }

        function isValidEmail (email_str) {
            var emailPattern = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,4}$/;
            return emailPattern.test(email_str);
        }

        function emailChange(email) {
            bufferHtml = "";
            if (email != "") {
                if (isValidEmail(email)) {
                    bufferHtml = "<i class=\"icon icon-ion-ios7-checkmark-outline\"></i>";
                } else {
                    bufferHtml = "<i class=\"icon icon-ion-ios7-checkmark-outline\"></i>";
                }
            }
            $('#email_group').addClass('input-group');
            $('#email_status').addClass('input-group-addon').html(bufferHtml);
        }
        function emailBlur(form) {
            if (isValidEmail($('#email').attr('value')) && $('#username').attr('value') == "") {
                if (!$('#username').prop('disabled')) $('#username').attr('value', $('#email').attr('value'));
            }
            emailChange($('#email').attr('value'));
        }
        function validateForm() {
            if ($("#emailconf_method").attr("value") == 'smtp') {
                if ($.trim($("#host").attr("value")) == "") {
                    alert("<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_SERVERFIELD)?>");
                    $("#host").focus();
                    return false;
                }
                if ($.trim($("#port").attr("value")) == "") {
                    alert("<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_PORTFIELD)?>");
                    $("#port").focus();
                    return false;
                }
                if ($.trim($("#email").attr("value")) == "") {
                    alert("<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_EMAILFIELD)?>");
                    $("#email").focus();
                    return false;
                }
                if (!$('#auth3').attr("checked")) {
                    if ($.trim($("#username").attr("value")) == "") {
                        alert("<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_USERNAMEFIELD)?>");
                        $("#username").focus();
                        return false;
                    }
                    if ($.trim($("#password").attr("value")) == "") {
                        alert("<?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_PASSWORDFIELD)?>");
                        $("#password").focus();
                        return false;
                    }
                }
            }
            return true;
        }
        function doVerifyConnect() {
            if (!validateForm()) return false;
            $("#divSubmit").css('display', 'none');
            $("#response").css('display', 'block');
            $("#response").html(html_animloading);
            $.getJSON('<?=DEFAULT_URL."/".SITEMGR_ALIAS."/configuration/email/index.php"?>', $('#adminemail').serialize(), doVerifyConnect_onload);
        }
        function doVerifyConnect_onload(data, textStatus) {
            $("#response").css('display', 'none');
            if (textStatus == 'success') {
                if (data.status == 'success') {
                    $("#response").html('<p class="alert alert-success"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_CONNECTEDSUCCESS)?></p>');
                    $("#divSubmit").css('display', 'block');
                    $("#bt_submit").prop('disabled', '');
                    $("#bt_submit").attr('class', 'btn btn-primary action-save');
                } else {
                    $("#response").html('<p class="alert alert-warning"><?=system_showText(LANG_SITEMGR_SETTINGS_EMAILCONF_MSGERROR_ERRORWHILETESTCONNECTION)?><br />'+data.msg_error+'</p>');$("#divSubmit").css('display', 'none');
                    $("#bt_submit").prop('disabled', 'disabled');
                    $("#bt_submit").attr('class', 'btn btn-default action-save');
                }
            }
            $("#response").fadeIn('slow', function() {
                window.setTimeout(function() {
                    $("#response").fadeOut('slow', function() { 
                        $('#response').html(html_testconn); 
                        $('#response').fadeIn('normal'); 
                    } );
                }, 5500)
             });
        }
        function submitForm() {
            $("#ajaxVerify").attr('value', 0);
            if (!validateForm()) return false;
            return true;
        }

        function disableButton(){
            $("#bt_submit").prop('disabled', 'disabled');
            $("#bt_submit").attr('class', 'btn btn-default action-save');
        }

    </script>