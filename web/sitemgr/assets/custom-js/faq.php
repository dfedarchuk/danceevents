<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/category.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>
        
        var thisId = '';
        
        function hideForm() {
            $('.alert-warning').css('display', 'none');
            $('.alert-success').css('display', 'none');
            $('#FAQ_add').fadeOut(500);
        }
        
        function hideFormFaq(form_id) {
            $('.alert-warning').css('display', 'none');
            $('.alert-success').css('display', 'none');
            $('#'+form_id).fadeOut(500);
        }
        
        function faq_edit(faq_id) {

            thisId = faq_id; 
            $('.alert-warning').css('display', 'none');
            $('.alert-success').css('display', 'none');
            $('.hideForm').css('display', 'none');
            $('#FAQ_edit'+faq_id).css('display', '');

        }
        
        function faq_delete(faq_id) {
            bootbox.confirm('<?=system_showText(LANG_SITEMGR_MSGAREYOUSURE);?>', function(result) {
                if (result) {
                    $("#faq_id").attr('value', faq_id);
                    document.getElementById('FAQ_post').submit();
                }
            });
        }
        
        function faq_add() {
            
            $('.alert-warning').css('display', 'none');
            $('.alert-success').css('display', 'none');
            $('.hideForm').css('display', 'none');
            $('#FAQ_add').css('display', '');
            
        }
        
        $('document').ready(function() {
            
            $('button[name=FAQ_post_submit]').bind('click', function() {
                
                $('#jMessage').css('display', 'none');
                $('#jMessage').empty();

                if ($('#faq_question').val() == '') {
                    $('#jMessage').append('&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_QUESTION)?><br />');
                }
                if ($('#faq_answer').val() == '') {
                    $('#jMessage').append('&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_ANSWER)?>');
                }
                if ($('#jMessage').text() != '') {
                    $('#jMessage').css('display', '');
                    $('button[name=FAQ_post_submit]').button('reset');
                    return false;
                } else {
                    return true;
                }

            });
            
            $('button[name=FAQ_edit_submit]').bind('click', function() {
            
                $('#jMessageEdit'+thisId).css('display', 'none');
                $('#jMessageEdit'+thisId).empty();

                if ($('#faq_question_edit'+thisId).val() == '') {
                    $('#jMessageEdit'+thisId).append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_QUESTION)?><br />");
                }
                if ($('#faq_answer_edit'+thisId).val() == '') {
                    $('#jMessageEdit'+thisId).append("&#149;&nbsp;<?=system_showText(LANG_SITEMGR_SETTINGS_MSGERROR_ANSWER)?>");
                }
                if ($('#jMessageEdit'+thisId).text() != '') {
                    $('#jMessageEdit'+thisId).css('display', '');
                    $('button[name=FAQ_edit_submit]').button('reset');
                    return false;
                } else {
                    return true;
                }

            });

        });
        
    </script>