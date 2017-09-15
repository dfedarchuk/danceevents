<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/slider.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>

        function deleteSlider(id, area) {
            bootbox.confirm("<?=LANG_SITEMGR_SLIDER_CONFIRM_DELETE?>", function(result) {
                if (result) {
                    $('#delete_slider_id'+area).attr('value', $('#' + id + area + '_id').val());
                    $('#delete_slider'+area).submit();
                }
            });

        }

        function selectSlide(id, area) {
            $('#last_slide_changed'+area).attr('value', id);
        }

        $(document).ready(function() {
            $('.row[role=tablist]').sortable({
                cancel: '.col-md-2 > .add-new',
                update: function (event, ui) {
                    var array_slider = [];
                    var area_slider = '';
                    $('.row[role=tablist] > div.col-md-2').each(function(index, elem) {
                        if ($(elem).data('id')) {
                            array_slider.push($(elem).data('id'));
                            area_slider = $(elem).data('area');
                        }
                    })

                    $.post('/<?=SITEMGR_ALIAS?>/mobile/slider/index.php', { 'order': '1', 'array_slider[]': array_slider })
                        .done(function(data) {
                            if ('success' == data.status) {
                                $('.heading .' + area_slider +' .alert.alert-success').hide();
                                $('.heading .' + area_slider +'').append(
                                    $('<p class="alert alert-success"><?=LANG_SITEMGR_SLIDER_MESSAGE_SAVED?></p>').hide().fadeIn()
                                );
                            }
                        });
                }
            });

            $('.ui-autocomplete-input').change(function(){
                if (!$(this).val()) {
                    $(".action-save").addClass("disabled");
                    $(".action-save").prop("disabled", true);
                }
            });

        });

        <? if (is_array($slideAreas)) foreach ($slideAreas as $slideArea) { ?>

        <? for ($slider_number = 1; $slider_number <= TOTAL_SLIDER_ITEMS; $slider_number++) { ?>

        $("#<?=$slider_number?><?=$slideArea?>_link").autocomplete(
            {
                source: function (request, response)
                {
                    $.ajax(
                        {
                            url: '<?=DEFAULT_URL."/".$_SERVER["PHP_SELF"];?>?autocomplete=true&slideArea=<?=$slideArea?>&domain_id=<?=SELECTED_DOMAIN_ID?>',
                            dataType: 'json',
                            data:
                            {
                                term: request.term
                            },
                            success: function (data)
                            {
                                response(data);
                            }
                        });
                },
                delay: 1000,
                minLength: 3,
                select: function (event, ui)
                {
                    $("#<?=$slider_number?><?=$slideArea?>_autocomplete_id").prop("value", ui.item.id);
                    $("#<?=$slider_number?><?=$slideArea?>_autocomplete_module").prop("value", ui.item.module);
                    $(".action-save").removeClass("disabled");
                    $(".action-save").prop("disabled", false);
                }
            });

        <? } ?>

        <? } ?>

    </script>
