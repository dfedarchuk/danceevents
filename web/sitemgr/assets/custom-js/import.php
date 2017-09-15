<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/import.php
	# ----------------------------------------------------------------------------------------------------

    if (string_strpos($_SERVER["PHP_SELF"], "index.php") !== false) { ?>

        <script>

            function JS_openDetail(id) {
                document.getElementById('log_'+id).style.display = '';
                document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/assets/images/structure/img_close.gif" onclick="JS_closeDetail('+id+');" />'
            }

            function JS_closeDetail(id) {
                document.getElementById('log_'+id).style.display = 'none';
                document.getElementById('img_'+id).innerHTML     = '<img style="cursor: pointer; cursor: hand;" src="<?=DEFAULT_URL?>/assets/images/structure/img_open.gif" onclick="JS_openDetail('+id+');" />'
            }

            function updateImport(action, id, type) {
                $('#import-actions').attr('value', action);
                $('#import-id').attr('value', id);
                $('#import-type').attr('value', type);
                var msg = $('#msg-'+action).val();
                if ($('#span_' + action + '_' + id).attr('data-' + action) == 1) { 
                    bootbox.confirm(msg, function(result) {
                        if (result) {
                            document.importactions.submit();
                        }
                    });
                }
            }

            var check_progress_time = 1*1000;
            var last_progress = 0;
            var current_import_id = 0;
            var last_progress_import_id = 0;
            var pending_imports = 0;

            checkRunningProgress();

            function checkRunningProgress() {
                $.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
                    domain_id: <?=SELECTED_DOMAIN_ID?>,
                    type: 'ajax',
                    option: 'verify_import'
                }, function (ret) {
                    var aRet = ret.split("||");
                    if (aRet[0] != 'no pending process' && aRet[0] != 'waiting cron') {
                        current_import_id = aRet[0];
                        last_progress_import_id = aRet[0];
                        last_progress = aRet[1];

                        $("#label_id"+aRet[0]).html("");
                        $("#span_stop_"+current_import_id).removeClass("btn-default");
                        $("#span_stop_"+current_import_id).addClass("btn-info");
                        $("#span_stop_"+current_import_id).attr("data-stop", 1);
                        $("#span_stop_"+current_import_id).css("cursor", "pointer");

                        $("#span_delete_"+current_import_id).addClass("btn-default");
                        $("#span_delete_"+current_import_id).removeClass("btn-warning");
                        $("#span_delete_"+current_import_id).attr("data-delete", 0);
                        $("#span_delete_"+current_import_id).css("cursor", "default");

                        $("#progresslabel_"+aRet[0]).html("<span class=\"status-running\"><?=system_showText(LANG_SITEMGR_IMPORT_RUNNING)?></span> - "+aRet[1]+"%");

                        $("#progress_added_"+aRet[0]).html(aRet[2]);
                        setTimeout("checkRunningProgress()", check_progress_time);

                    } else {

                        if (aRet[0] == "waiting cron") {
                            pending_imports = aRet[1];
                            last_progress_import_id = aRet[2];
                            last_status = aRet[3];
                            action = aRet[4];
                        } else {
                            last_progress_import_id = aRet[1];
                            last_progress = aRet[2];
                            pending_imports = aRet[3];
                            last_status = aRet[4];
                        }

                        if (aRet[0] == 'waiting cron' && pending_imports >= 1) {
                            setTimeout("checkRunningProgress()", check_progress_time);
                            if (document.getElementById("tdprogress_"+last_progress_import_id) && last_status == "F") {

                                errorlines = parseInt(document.getElementById("error_lines_"+last_progress_import_id).innerHTML);
                                totallines = parseInt(document.getElementById("total_lines_"+last_progress_import_id).innerHTML);
                                addedlines = totallines - errorlines;

                                $("#tdprogress_"+last_progress_import_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                $("#progress_added_"+last_progress_import_id).html(addedlines);

                                $("#span_stop_"+last_progress_import_id).addClass("btn-default");
                                $("#span_stop_"+last_progress_import_id).removeClass("btn-info");
                                $("#span_stop_"+last_progress_import_id).attr("data-stop", 0);
                                $("#span_stop_"+last_progress_import_id).css("cursor", "default");

                                $("#span_rollback_"+last_progress_import_id).removeClass("btn-default");
                                $("#span_rollback_"+last_progress_import_id).addClass("btn-primary");
                                $("#span_rollback_"+last_progress_import_id).attr("data-rollback", 1);
                                $("#span_rollback_"+last_progress_import_id).css("cursor", "pointer");
                            }

                        } else {
                            current_import_id = aRet[1];
                            last_progress_import_id = aRet[1];
                            last_progress = aRet[2];

                            if (aRet[0] == 'no pending process' && last_progress != 0 && current_import_id != 0 && aRet[4] == "F" && aRet[5] != "NR") {
                                if (document.getElementById("tdprogress_"+current_import_id)) {

                                    errorlines = parseInt(document.getElementById("error_lines_"+last_progress_import_id).innerHTML);
                                    totallines = parseInt(document.getElementById("total_lines_"+last_progress_import_id).innerHTML);
                                    addedlines = totallines - errorlines;

                                    $("#tdprogress_"+last_progress_import_id).html("<span class=\"status-finished\"><?=system_showText(LANG_SITEMGR_IMPORT_FINISHED)?></span>");
                                    $("#progress_added_"+last_progress_import_id).html(addedlines);

                                    $("#span_stop_"+last_progress_import_id).addClass("btn-default");
                                    $("#span_stop_"+last_progress_import_id).removeClass("btn-info");
                                    $("#span_stop_"+last_progress_import_id).attr("data-stop", 0);
                                    $("#span_stop_"+last_progress_import_id).css("cursor", "default");

                                    $("#span_rollback_"+last_progress_import_id).removeClass("btn-default");
                                    $("#span_rollback_"+last_progress_import_id).addClass("btn-primary");
                                    $("#span_rollback_"+last_progress_import_id).attr("data-rollback", 1);
                                    $("#span_rollback_"+last_progress_import_id).css("cursor", "pointer");

                                    $("#span_delete_"+last_progress_import_id).removeClass("btn-default");
                                    $("#span_delete_"+last_progress_import_id).addClass("btn-warning");
                                    $("#span_delete_"+last_progress_import_id).attr("data-delete", 1);
                                    $("#span_delete_"+last_progress_import_id).css("cursor", "pointer");
                                }
                                if (pending_imports > 1) {
                                    setTimeout("checkRunningProgress()", check_progress_time);
                                }
                            }
                        }
                    }

                });
            }

        </script>

        <?
        if ($log_id) {
            $import_logAux = new ImportLog($log_id);
            $total_lines = $import_logAux->getNumber("totallines");
            $file = $import_logAux->getString("phisicalname");
            $file = str_replace(".csv", "", $file);
            $checkTempTable = false;
            if (string_strpos($import_logAux->getString("history"), "LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE") !== false) {
                $checkTempTable = true;
            }
            if (file_exists(IMPORT_FOLDER."/".$file.".txt") && !$checkTempTable) { ?>

                <script>
                    var check_progress_time = 1*5000;

                    $(document).ready(function () {
                        var file_name = '<?=$file?>';

                        $.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
                            domain_id: <?=SELECTED_DOMAIN_ID;?>,
                            type: "ajax",
                            option: "import_temporary",
                            log_id: <?=$log_id?>,
                            file_name: file_name
                        }, function (res) {
                            if (!res) { //sucess
                                checkProgress();
                            }
                        });
                    })

                    function checkProgress() {
                        $.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
                            domain_id: <?=SELECTED_DOMAIN_ID;?>,
                            type: 'ajax',
                            option: 'verify_temporary',
                            log_id: <?=$log_id?>,
                            total_lines: <?=$total_lines?>
                        }, function (ret) {
                            var aRet = ret.split("||");
                            if (aRet[1] == 0) {
                                if (aRet[0] < 100) {
                                    document.getElementById("message_progress_<?=$log_id?>").innerHTML = "<?=system_showText(LANG_SITEMGR_IMPORT_IMPORTINGDATATOTEMPORARYTABLE)?><br /><img src='<?=DEFAULT_URL?>/assets/images/structure/img_loading.gif' />"+aRet[0]+"%";
                                    setTimeout("checkProgress()", check_progress_time);
                                } else if (aRet[0] >= 100) {
                                    $("#logMessages").append("<p class=\"successMessage\"><?=system_showText(LANG_MSG_IMPORT_CSVIMPORTEDTOTEMPORARYTABLE);?></p>");
                                }
                            } else {
                                $("#logMessages").append("<p class=\"errorMessage\"><?=system_showText(LANG_MSG_IMPORT_ERRORONIMPORTTOTEMPABLE);?></p>");
                            }
                        });
                    }
                </script>
            <? } ?>	
        <? } ?>

    <? } elseif (string_strpos($_SERVER["PHP_SELF"], "import.php") !== false) { ?>

        <script type="text/javascript" src="<?=DEFAULT_URL;?>/scripts/jquery/jquery.csv2table.js"></script>

        <script>

            function JS_ShowHideAccount() {
                if (document.getElementById('import_sameaccount').checked) {
                    document.getElementById('import_account_id').style.display = "";
                } else {
                    document.getElementById('import_account_id').style.display = "none";
                }
            }

            var fileName = '<?=$urlFileName;?>';
            var errorMessage = '<?=$messageErrorUpload;?>';
            var colSeparator = '<?=($csvDelimiter ? $csvDelimiter : ",")?>';
            var fileForm = '<?=$type;?>';
            var ftpType = '<?=$ftp_type == "schedule_cron"? $ftp_type: "";?>';

            function JS_submitPreview () {
                var importType = $("#type").val();
                $("#pageLoad").css("display", "");
                if (importType == "select") {
                    uploadFile("select");
                } else {
                    $("#importInfo").submit();
                }
            }

            function changeFileForm (type, file_name, ftpType) {
                $("#type").attr("value", type);
                if (type == "upload") {
                    $("#tab_select").removeClass("active");
                    $("#tab_upload").addClass("active");
                    $('#uploadFile').show();
                    $('#selectFile').hide();
                    $('#selectFile2').hide();
                } else {
                    $("#tab_upload").removeClass("active");
                    $("#tab_select").addClass("active");
                    $('#uploadFile').hide();
                    $('#selectFile').show();
                    if ((file_name || ftpType) && !$("#btnISubmit").prop("disabled")) {
                        $('#selectFile2').show();
                    }
                }
            }

            function uploadFile (type) {
                $("#cron_message").css("display", "none");
                $("#tableCSV").css("display", "none");
                if (type == "select") {

                    $("#btnPreview").prop("disabled", "disabled");

                    var row_file = $("#rowFile").val();
                    if (row_file != "") {
                        $("#file_name").val(row_file);
                    }
                    var file_name = $("#file_name").val();
                    $.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
                        type: "ajax",
                        option: "verify_lines",
                        domain_id: "<?=SELECTED_DOMAIN_ID;?>",
                        file_name: file_name
                    }, function (res) {
                        /*
                            * 1 - ftp_type = correct;
                            * 2 - ftp_type = schedule_cron;
                            * 3 - ftp_type = file bigger than 100mb;
                            */
                        if (res == 1) {
                            $("#ftp_type").attr("value", "correct");
                        } else if (res == 2) {
                            $("#ftp_type").attr("value", "schedule_cron");
                        } else if (res == 3) {
                            $("#max_mb_message").show("fast");
                            $("#pageLoad").css("display", "none");
                        }
                        if (res < 3) {
                            $("#importInfo").submit();
                        }
                    });
                } else {
                    $("#ftp_type").attr("value", "correct");
                    $("#btnPreview").prop("disabled", "");
                    JS_submitPreview();
                }
            }

            function selectRow(radioId) {
                $("#btnPreview").prop("disabled", "");
                $("#" + radioId).attr("checked", "checked");
                $("#rowFile").val($("#" + radioId).val());
            }

            function changeDisplayForm() {
                $('#importOptions').hide();
                $('#tableDivisor').show();
                $('#wait_loading_file').show();
                $('#toScroll').hide();
            }

            function reloadFileList(autoLoad) {
                if (autoLoad == false) {
                    var loading = "<div class=\"import-loading-box\"><img src=\"<?=DEFAULT_URL;?>/assets/images/structure/img_loading.gif\" alt=\"<?=system_showText(LANG_SITEMGR_WAITLOADING);?>\" title=\"<?=system_showText(LANG_SITEMGR_WAITLOADING);?>\"/>";
                    loading += "<p class=\"import-loading\"><?=system_showText(LANG_SITEMGR_WAITLOADING);?></p></div>";
                    $("#fileList").html(loading);
                }

                $.post(DEFAULT_URL + "/includes/code/<?=$includeFile?>", {
                    type: "ajax",
                    option: "reload_fileList",
                    domain_id: "<?=SELECTED_DOMAIN_ID?>"
                }, function (res) {
                    var arRes = res.split("[||]");
                    if (arRes[1] == "EMPTY") {
                        $("#fileList").html(arRes[0]);
                        setTimeout("reloadFileList(true)", 5000);
                    } else {
                        $("#fileList").html(arRes[0]);
                    }
                });
            }

            function preview () {
                if (colSeparator == "tab" || colSeparator == '\t') {
                    $(function(){
                        $('#csvPreview').csv2table(
                        fileName , {
                            limit: [0, 5],
                            nowloadingMsg: LANG_JS_LOADING,
                            col_sep: '\t',
                            sortable: false,
                            className_table: "table table-bordered"
                        });
                    });
                } else {
                    $(function(){
                        $('#csvPreview').csv2table(
                        fileName , {
                            limit: [0, 10],
                            nowloadingMsg: LANG_JS_LOADING,
                            col_sep: colSeparator,
                            sortable: false,
                            className_table: "table table-bordered"
                        });
                    });
                }
            }

            if (fileForm) {
                changeFileForm(fileForm, fileName, ftpType);
            }

            $(document).ready(function () {
                if (fileName && !errorMessage) {
                    preview();
                }
                var wW = $(window).width();
                if (wW >= 1200) {
                    ControlSidebar();
                }
            })

        </script>

    <? } else { ?>

        <script>
        
            function JS_ShowHideAccount(module) {
                if (document.getElementById('import_sameaccount_'+module).checked) {
                    document.getElementById('import_account_id_'+module).style.display = "";
                } else {
                    document.getElementById('import_account_id_'+module).style.display = "none";
                }
            }
    
        </script>
        
    <? } ?>


