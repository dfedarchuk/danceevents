<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /ed-admin/assets/custom-js/export.php
	# ----------------------------------------------------------------------------------------------------

?>
	<script>

        <? if ($message_export_payment) { ?>
            $('#modal-payment').modal('show');
        <? } ?>

        <? if ($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>
            setTimeout("checkExportProgressListing()", 500);
        <? } ?>

        <? if ($aux_export_runningEvent["finished"] == "N" && EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>
            setTimeout("checkExportProgressEvent()", 500);
        <? } ?>

        var check_progress_time = 5*1000;
        var lastprogress = 0;

        function showForm(module) {
            $(".exporting").addClass("hidden");
            $("#exporting-form-" + module).removeClass("hidden");
        }

        function showEmailOptions () {
            $("#exportlisting").hide();
            if ($("#emailDataFields").css("display") == "none") {
                $("#emailDataFields").show();
            } else {
                $("#emailDataFields").hide();
            }
        }

        function showListingOptions () {
            $("#emailDataFields").hide();
            if ($("#exportlisting").css("display") == "none") {
                $("#exportlisting").show();
            } else {
                $("#exportlisting").hide();
            }
        }

        function showLoading () {
            showMessages('clear');
            if ($("#export_loading").hasClass("hidden")) {
                $("#export_loading").removeClass("hidden");
            } else {
                $("#export_loading").addClass("hidden");
            }
        }

        function showMessages (type, message) {
            if (type == 'success') {
                $('#exportMessage').addClass('alert-success');
            } else if (type == 'error') {
                $('#exportMessage').addClass('alert-warning');
                if (!message) message = "<?=LANG_SITEMGR_EXPORT_ERROR;?>";
            }

            if (type != 'clear') {
                $('#exportMessage').text(message);
                $('#exportMessage').show();
            } else {
                $('#exportMessage').text('');
                $('#exportMessage').hide();
                if ($('#exportMessage').hasClass('alert-success')) {
                    $('#exportMessage').removeClass('alert-success');
                } else if ($('#exportMessage').hasClass('alert-warning')) {
                    $('#exportMessage').removeClass('alert-warning');
                }
            }
        }

        function changeEmailOption (option) {
            if (option == "category") {
                $("#categoryDropDown").show();
                $("#locationDropDown").hide();
            } else if (option == "location") {

                if ($("#location").length) {
                    $("#categoryDropDown").hide();
                    $("#locationDropDown").show();
                } else {
                    $.post('<?=system_getFormAction($_SERVER["PHP_SELF"]);?>', {
                        loadlocations: 1
                    }, function (res) {
                        $("#locationDropDown").append(res);
                        $("#categoryDropDown").hide();
                        $("#locationDropDown").show();
                    });
                }

            } else {
                $("#categoryDropDown").hide();
                $("#locationDropDown").hide();
            }
        }

        function exportFile (type) {
            showLoading();

            var ajaxURL = '<?=system_getFormAction($_SERVER["PHP_SELF"]);?>';

            var data = {
                ajax_action: 'generate_data',
                domain_id: '<?=SELECTED_DOMAIN_ID;?>',
                file_extension: 'csv',
                filter_categoryId: $("#category_id").val() || 0,
                item_filter: $('input[name="item_filter"]:checked').val(),
                item_type: type
            };

            var location = $("#location").val();

            if(location) {
                var parts = location.split(':');
                data.filter_locationId = parts[1];
                data.filter_locationLevel = parts[0];
            }

            if (type != "Email") $("#emailDataFields").hide();
            if (type != "Listing") $("#exportlisting").hide();

            $.post(ajaxURL, data, function (res) {
                /**
                * options[0] = message type (Success / Error)
                * options[1] = message (Status message from process)
                * options[2] = zip filename ([TYPE].zip)
                */
                var options = res.split(' - ');
                showLoading();

                if (options[0] == 'success' && options[2] != '') {
                    showMessages(options[0], options[1]);
                    window.location = ajaxURL + '?download=' + options[2];
                } else {
                    if (options[2] == '') showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_NO_DATAFOUND);?>");
                    else showMessages('error');
                }
            });
        }

        function scheduleExport () {
            showMessages('clear');
            var ajaxURL = '<?=$_SERVER["PHP_SELF"];?>';
            var filename = $('#nextFileName').val();
            var domain = '<?=SELECTED_DOMAIN_ID;?>';

            $("#export_cron_loading").show();
            $("#export_progress").show();
            $("#export_link_start").hide();
            $("#file_link").hide();
            $("#export_progress").html('<span>0%</span>');

            $.post(ajaxURL, {
                ajax_action: 'schedule_export',
                file_name: filename,
                domain_id: domain
            }, function (res) {
                if (res != 0 && res == 1) {
                    showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ALREADY_SCHEDULED);?>");
                    $("#export_progress").html('');
                } else if (res != 0) {
                    showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ERROR_SCHEDULE);?>");
                    $("#export_progress").html('');
                }

                if (res != 0) {
                    $("#export_link_start").show();
                    $("#export_cron_loading").hide();
                } else {
                    setTimeout("checkExportProgress()", check_progress_time);
                }
            });
        }

        function checkExportProgress () {
            var ajaxURL = '<?=$_SERVER["PHP_SELF"];?>';
            var domain = '<?=SELECTED_DOMAIN_ID;?>';
            var filename = $('#nextFileName').val();
            var nextFileName = '<?=md5(uniqid(rand(), true)).".zip";?>';

            $.post(ajaxURL, {
                ajax_action: 'check_progress',
                file_name: filename,
                domain_id: domain
            }, function (res) {
                var options = res.split(" - ");
                if (options[0] == "waiting") {
                    $("#export_cron_loading").show();
                    $("#export_progress").show();
                    $("#export_link_start").hide();
                    $("#export_progress").html('<span>0%</span>');
                    setTimeout("checkExportProgress()", check_progress_time);
                } else if (options[0] == "progress") {
                    if (options[1] >= 0 && options[1] < 100) {
                        $("#export_progress").html('<span>' + options[1] + '%</span>');
                        setTimeout("checkExportProgress()", check_progress_time);
                    } else if (options[1] == 100) {
                        showMessages('success', "<?=system_showText(LANG_SITEMGR_EXPORT_SUCCESSFULLY);?>");
                        $("#export_progress").html('');
                        $("#export_link_start").show();
                        $("#export_cron_loading").hide();
                        $('#nextFileName').val(nextFileName);
                        $('#showFileName').text(nextFileName);
                        $("#file_link").html('<a href="' + ajaxURL + '?action=cron&download=' + filename + '"><?=system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)?></a>');
                        $("#file_link").show();
                    }
                } else if (options[0] == "error") {
                    showMessages('error', "<?=system_showText(LANG_SITEMGR_EXPORT_ERROR_SCHEDULE);?>");
                    $("#export_progress").html('');
                    $("#export_link_start").show();
                    $("#export_cron_loading").hide();
                }
            });
        }

        function startExportProcess() {
			try {
				xmlhttp_startexportprocess = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_startexportprocess = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_startexportprocess = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_startexportprocess = false;
					}
				}
			}
			if (xmlhttp_startexportprocess) {
				xmlhttp_startexportprocess.open("GET", "./itemexportfile.php?export_type=listing&file=<?=$exportFileListing?>&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_startexportprocess.send(null);
			}
		}
		function removeExportControl() {
			try {
				xmlhttp_removeexportcontrol = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_removeexportcontrol = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_removeexportcontrol = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_removeexportcontrol = false;
					}
				}
			}
			if (xmlhttp_removeexportcontrol) {
				xmlhttp_removeexportcontrol.open("GET", "./itemexportfile.php?export_type=listing&file=<?=$exportFileListing?>&removecontrol=true&domain_id=<?=SELECTED_DOMAIN_ID;?>", true);
				xmlhttp_removeexportcontrol.send(null);
			}
		}
		function checkExportProgressListing() {

			try {
				xmlhttp_checkexportprogress = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_checkexportprogress = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_checkexportprogress = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_checkexportprogress = false;
					}
				}
			}
			if (xmlhttp_checkexportprogress) {
				xmlhttp_checkexportprogress.onreadystatechange = function() {
					if (xmlhttp_checkexportprogress.readyState == 4) {
						if (xmlhttp_checkexportprogress.status == 200) {
							string_status = xmlhttp_checkexportprogress.responseText;
							current_progress = parseInt(string_status);

							<? if (LISTING_SCALABILITY_OPTIMIZATION != "on") { ?>
							lastprogress = current_progress;
							<? } ?>

							if (isNaN(current_progress)) {
								<? if (LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>
                                    aux_status = string_status.split("||");
                                    if (aux_status[1] == "error") {
                                        document.getElementById("export_message").style.color = "#FF0000";
                                        document.getElementById("export_message").innerHTML = aux_status[0];
                                        document.getElementById("export_progress").innerHTML = "&nbsp;";
                                        document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
                                        removeExportControl();
                                    } else {
                                        document.getElementById("export_message").innerHTML = string_status+"<br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
                                        document.getElementById("export_progress").innerHTML = "0";
                                        document.getElementById("export_progress_percentage").innerHTML = "%";
                                        setTimeout("checkExportProgressListing()", check_progress_time);
                                    }
                                <? } else { ?>
                                    document.getElementById("export_message").style.color = "#FF0000";
                                    document.getElementById("export_message").innerHTML = string_status;
                                    document.getElementById("export_progress").innerHTML = "&nbsp;";
                                    document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
                                    removeExportControl();
                                <? } ?>
							} else {
								<? if ($aux_export_running["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>
									document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON)?><br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
									document.getElementById("export_progress").innerHTML = current_progress;
									document.getElementById("export_progress_percentage").innerHTML = "%";
                                <? } else { ?>
									document.getElementById("export_progress").innerHTML = current_progress;
                                <? } ?>

								if (parseInt(document.getElementById("export_progress").innerHTML) >= 100) {
									document.getElementById("export_message").style.fontSize = "15px";
									document.getElementById("export_message").style.color = "#466E1E";
									document.getElementById("export_message").style.fontWeight = "bold";
									document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTDONE).(LISTING_SCALABILITY_OPTIMIZATION == "on" ? " <br /><a href=".DEFAULT_URL."/".SITEMGR_ALIAS."/content/datacenter/exportfile.php?export_type=listing&filename=".$exportFileListing."&type=csv>".system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)."</a>" : "");?>";
									document.getElementById("export_progress").innerHTML = "&nbsp;";
									document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
									removeExportControl();
								} else {
									setTimeout("checkExportProgressListing()", check_progress_time);
								}
							}
						} else {
							document.getElementById("export_message").style.color = "#FF0000";
							document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
							document.getElementById("export_progress").innerHTML = "&nbsp;";
							document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
							removeExportControl();
						}
					}
				}
				xmlhttp_checkexportprogress.open("GET", "./itemexportcheck.php?export_type=listing&file=<?=$exportFileListing?>&lastprogress="+lastprogress+"&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_checkexportprogress.send(null);
			} else {
				document.getElementById("export_message").style.color = "#FF0000";
				document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
				document.getElementById("export_progress").innerHTML = "&nbsp;";
				document.getElementById("export_progress_percentage").innerHTML = "&nbsp;";
				removeExportControl();
			}
		}
		function startExport() {
			document.getElementById("export_message").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT)?><br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
			document.getElementById("export_progress").innerHTML = "0";
			document.getElementById("export_progress_percentage").innerHTML = "%";
			startExportProcess();
			setTimeout("checkExportProgressListing()", check_progress_time);
		}

        function startExportProcessEvent() {
			try {
				xmlhttp_startexportprocess = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_startexportprocess = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_startexportprocess = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_startexportprocess = false;
					}
				}
			}
			if (xmlhttp_startexportprocess) {
				xmlhttp_startexportprocess.open("GET", "./itemexportfile.php?export_type=event&file=<?=$exportFileEvent?>&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_startexportprocess.send(null);
			}
		}
		function removeExportControlEvent() {
			try {
				xmlhttp_removeexportcontrol = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_removeexportcontrol = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_removeexportcontrol = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_removeexportcontrol = false;
					}
				}
			}
			if (xmlhttp_removeexportcontrol) {
				xmlhttp_removeexportcontrol.open("GET", "./itemexportfile.php?export_type=event&file=<?=$exportFileEvent?>&removecontrol=true&domain_id=<?=SELECTED_DOMAIN_ID;?>", true);
				xmlhttp_removeexportcontrol.send(null);
			}
		}
		function checkExportProgressEvent() {

			try {
				xmlhttp_checkexportprogress = new XMLHttpRequest();
			} catch (e) {
				try {
					xmlhttp_checkexportprogress = new ActiveXObject("Msxml2.XMLHTTP");
				} catch (e) {
					try {
						xmlhttp_checkexportprogress = new ActiveXObject("Microsoft.XMLHTTP");
					} catch (e) {
						xmlhttp_checkexportprogress = false;
					}
				}
			}
			if (xmlhttp_checkexportprogress) {
				xmlhttp_checkexportprogress.onreadystatechange = function() {
					if (xmlhttp_checkexportprogress.readyState == 4) {
						if (xmlhttp_checkexportprogress.status == 200) {
							string_status = xmlhttp_checkexportprogress.responseText;
							current_progress = parseInt(string_status);
							<? if (EVENT_SCALABILITY_OPTIMIZATION != "on") { ?>
							lastprogress = current_progress;
							<? } ?>
							if (isNaN(current_progress)) {
								<? if (EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>
                                    aux_status = string_status.split("||");
                                    if (aux_status[1] == "error") {
                                        document.getElementById("export_messageEvent").style.color = "#FF0000";
                                        document.getElementById("export_messageEvent").innerHTML = aux_status[0];
                                        document.getElementById("export_progressEvent").innerHTML = "&nbsp;";
                                        document.getElementById("export_progress_percentageEvent").innerHTML = "&nbsp;";
                                        removeExportControlEvent();
                                    } else {
                                        document.getElementById("export_messageEvent").innerHTML = string_status+"<br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
                                        document.getElementById("export_progressEvent").innerHTML = "0";
                                        document.getElementById("export_progress_percentageEvent").innerHTML = "%";
                                        setTimeout("checkExportProgressEvent()", check_progress_time);
                                    }
                                <? } else { ?>
                                    document.getElementById("export_messageEvent").style.color = "#FF0000";
                                    document.getElementById("export_messageEvent").innerHTML = string_status;
                                    document.getElementById("export_progressEvent").innerHTML = "&nbsp;";
                                    document.getElementById("export_progress_percentageEvent").innerHTML = "&nbsp;";
                                    removeExportControlEvent();
                                <? } ?>
							} else {
								<? if ($aux_export_runningEvent["finished"] == "N" && EVENT_SCALABILITY_OPTIMIZATION == "on") { ?>
									document.getElementById("export_messageEvent").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_WAITING_CRON)?><br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
									document.getElementById("export_progressEvent").innerHTML = current_progress;
									document.getElementById("export_progress_percentageEvent").innerHTML = "%";
                                <? } else { ?>
									document.getElementById("export_progressEvent").innerHTML = current_progress;
                                <? } ?>

								if (parseInt(document.getElementById("export_progressEvent").innerHTML) >= 100) {
									document.getElementById("export_messageEvent").style.fontSize = "15px";
									document.getElementById("export_messageEvent").style.color = "#466E1E";
									document.getElementById("export_messageEvent").style.fontWeight = "bold";
									document.getElementById("export_messageEvent").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTDONE).(EVENT_SCALABILITY_OPTIMIZATION == "on" ? " <br /><a href=".DEFAULT_URL."/".SITEMGR_ALIAS."/export/exportfile.php?export_type=event&filename=".$exportFile."&type=csv>".system_showText(LANG_SITEMGR_EXPORT_LASTFILE_MESSAGE)."</a>" : "");?>";
									document.getElementById("export_progressEvent").innerHTML = "&nbsp;";
									document.getElementById("export_progress_percentageEvent").innerHTML = "&nbsp;";
									removeExportControlEvent();
								} else {
									setTimeout("checkExportProgressEvent()", check_progress_time);
								}
							}
						} else {
							document.getElementById("export_messageEvent").style.color = "#FF0000";
							document.getElementById("export_messageEvent").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
							document.getElementById("export_progressEvent").innerHTML = "&nbsp;";
							document.getElementById("export_progress_percentageEvent").innerHTML = "&nbsp;";
							removeExportControlEvent();
						}
					}
				}
				xmlhttp_checkexportprogress.open("GET", "./itemexportcheck.php?export_type=event&file=<?=$exportFileEvent?>&lastprogress="+lastprogress+"&domain_id=<?=SELECTED_DOMAIN_ID?>", true);
				xmlhttp_checkexportprogress.send(null);
			} else {
				document.getElementById("export_messageEvent").style.color = "#FF0000";
				document.getElementById("export_messageEvent").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTERROR)?><br /><?=system_showText(LANG_SITEMGR_EXPORT_PLEASETRYAGAIN)?>";
				document.getElementById("export_progressEvent").innerHTML = "&nbsp;";
				document.getElementById("export_progress_percentageEvent").innerHTML = "&nbsp;";
				removeExportControlEvent();
			}
		}
		function startExportEvent() {
			document.getElementById("export_messageEvent").innerHTML = "<?=system_showText(LANG_SITEMGR_EXPORT_EXPORTINGPLEASEWAIT)?><br /><img src='<?=DEFAULT_URL?>/<?=SITEMGR_ALIAS?>/assets/img/preloader-32.gif' />";
			document.getElementById("export_progressEvent").innerHTML = "0";
			document.getElementById("export_progress_percentageEvent").innerHTML = "%";
			startExportProcessEvent();
			setTimeout("checkExportProgressEvent()", check_progress_time);
		}

        function deleteFile(file) {
            document.getElementById("deleteFile").value = file;
            bootbox.confirm('<?=system_showText(LANG_SITEMGR_EXPORT_DELETEQUESTION);?>', function(result) {
                if (result) {
                    $('#export_delete').submit();
                }
            });
        }

        <? if ($export["finished"] == "N" && LISTING_SCALABILITY_OPTIMIZATION == "on") { ?>
            $(document).ready(function () {
                checkExportProgress();
            });
        <? } ?>

        <? if ($message) { ?>
            scrollPage('#msgDelete');
        <? } elseif ($message_export_payment) { ?>
            scrollPage('#warning');
        <? } ?>

    </script>