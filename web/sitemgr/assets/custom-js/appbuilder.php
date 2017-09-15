<?php
    /*
     * # Admin Panel for eDirectory
     * @copyright Copyright 2014 Arca Solutions, Inc.
     * @author Basecode - Arca Solutions, Inc.
     */

    # ----------------------------------------------------------------------------------------------------
    # * FILE: /ed-admin/assets/custom-js/appbuilder.php
    # ----------------------------------------------------------------------------------------------------

    /**
     * Generates JS to move forward in appbuilder
     * @param type $stepNumber
     * @param type $nextPage
     */
    function submitJS( $stepNumber, $nextPage )
    {
        if (DEMO_LIVE_MODE)
        {
            $code = "window.location.href = '{$nextPage}';";
        }
        else
        {
            $code = "if(next){ $('#next').attr('value', 'yes'); }
                    document.step{$stepNumber}.submit();";
        }
        
        echo "  function JS_submit(next){
                    {$code}
                }";
    }

    /**
     * Creates a file send Javascript function for the page
     * @param type $stepNumber
     * @param type $uploadPage
     * @param type $successFunction
     */
    function sendFileJS( $stepNumber, $uploadPage, $successFunction )
    {

        if (!DEMO_LIVE_MODE)
        {
            $code = "$('#step{$stepNumber}').vPB({
                    url: '{$uploadPage}',
                    beforeSubmit: function(){
                        $('#loading_image').removeClass('hidden');
                    },
                    success: function(response){
                        {$successFunction}
                    }
                }).submit();";
        }
        else
        {
            $code = "livemodeMessage(true, false);";
        }

        echo "  function sendFile() {
                    {$code}
                }";
    }

    $file = basename($_SERVER["PHP_SELF"], ".php");

    if (strpos($_SERVER["PHP_SELF"], "about") !== false) {
        $file = "about";
    } elseif (strpos($_SERVER["PHP_SELF"], "menu") !== false) {
        $file = "menu";
    } elseif (strpos($_SERVER["PHP_SELF"], "custompages") !== false) {
        $file = "custompages";
    }

?>

<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/navigation.js"></script>

<script type="text/javascript" src="<?= DEFAULT_URL ?>/scripts/jquery/auto_upload/js/file_uploads.js"></script>

<?php
   switch ( $file )
    {
        /* ================== step1.php - ICON ==================  */
        case "index":
            echo "<script>";
            submitJS( '1', DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/appbuilder/step2.php" );

            $uploadPage = DEFAULT_URL . "/includes/code/image_autoupload.php?filename=appbuilder_icon&domain_id=" . SELECTED_DOMAIN_ID;
            $successFunction = "
                strReturn = response.split('||');

                if (strReturn[0] == 'ok' || strReturn[0] == 'ok_alert') {
                    $('#returnMessage').hide();
                    $('#preview-icon').hide().fadeIn('slow').html(strReturn[1]);
                    if (strReturn[0] == 'ok_alert') {
                        $('#alert_img').show();
                    } else {
                        $('#alert_img').hide();
                    }
                } else {
                    $('#returnMessage').removeClass('successMessage');
                    $('#returnMessage').removeClass('errorMessage');
                    $('#returnMessage').addClass('errorMessage');
                    $('#returnMessage').html(strReturn[1]);
                    $('#returnMessage').show();
                    $('#errorMessage').hide();
                    $('#successMessage').hide();
                }
                $('#loading_image').addClass('hidden');";

            sendFileJS('1', $uploadPage, $successFunction);

            echo "</script>";
            break;

        /* ================== step2.php - LOADING IMAGE ==================  */
        case "step2":
            echo "<script>";
            submitJS( '2', DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/appbuilder/step3.php" );

            $uploadPage = DEFAULT_URL . "/includes/code/image_autoupload.php?filename=appbuilder_splash&fullpath=1&domain_id=" . SELECTED_DOMAIN_ID;
            $successFunction = "
                strReturn = response.split('||');
                $('#splash_image').hide().fadeOut('slow');

                if (strReturn[0] == 'ok' || strReturn[0] == 'ok_alert') {
                    $('#returnMessage').hide();
                    $('#preview-image').css('background-image', 'url(' + strReturn[1] + ')');
                    if (strReturn[0] == 'ok_alert') {
                        $('#alert_img').show();
                    } else {
                        $('#alert_img').hide();
                    }
                } else {
                    $('#returnMessage').removeClass('successMessage');
                    $('#returnMessage').removeClass('errorMessage');
                    $('#returnMessage').addClass('errorMessage');
                    $('#returnMessage').html(strReturn[1]);
                    $('#returnMessage').show();
                    $('#errorMessage').hide();
                    $('#successMessage').hide();
                }
                $('#loading_image').addClass('hidden');";

            sendFileJS('2', $uploadPage, $successFunction);

            echo "</script>";
            break;

        /* ================== step3.php - COLORS ==================  */
        case "step3":
            echo "<script>";
            submitJS( '3', DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/about/" );
            echo "</script>";
            break;

        /* ================== ABOUT ==================  */
        case "about":
            ?>
            <script>
                function updateAbout() {
                    $(".customtext").html(nl2br($("#textarea").val()));
                    $(".customtext").removeClass("wireframe");
                }

            <?php
            submitJS( '4', DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/custompages/" );

            $uploadPage = DEFAULT_URL . "/includes/code/image_autoupload.php?filename=appbuilder_logo&domain_id=" . SELECTED_DOMAIN_ID;
            $successFunction = "
                strReturn = response.split('||');

                if (strReturn[0] == 'ok' || strReturn[0] == 'ok_alert') {
                    $('#returnMessage').hide();
                    $('.prev-logo').hide().fadeIn('slow').html(strReturn[1]);
                    if (strReturn[0] == 'ok_alert') {
                        $('#alert_img').show();
                    } else {
                        $('#alert_img').hide();
                    }
                } else {
                    $('#returnMessage').removeClass('successMessage');
                    $('#returnMessage').removeClass('errorMessage');
                    $('#returnMessage').addClass('errorMessage');
                    $('#returnMessage').html(strReturn[1]);
                    $('#returnMessage').show();
                    $('#errorMessage').hide();
                    $('#successMessage').hide();
                    scrollPage('#returnMessage');
                }
                $('#loading_image').addClass('hidden');";

            sendFileJS('4', $uploadPage, $successFunction);
            echo "</script>";
            break;

        /* ================== CUSTOM PAGES ==================  */
        case "custompages":
            ?>
            <script type="text/javascript" src="<?= DEFAULT_URL ?>/<?= SITEMGR_ALIAS ?>/assets/js/sir-trevor/underscore-min.js"></script>
            <script type="text/javascript" src="<?= DEFAULT_URL ?>/<?= SITEMGR_ALIAS ?>/assets/js/sir-trevor/eventable.js"></script>
            <script type="text/javascript" src="<?= DEFAULT_URL ?>/<?= SITEMGR_ALIAS ?>/assets/js/sir-trevor/sir-trevor.js"></script>
            <script type="text/javascript" src="<?= DEFAULT_URL ?>/<?= SITEMGR_ALIAS ?>/assets/js/jquery-opencarousel/jquery.openCarousel.js"></script>
            <script type="text/javascript" src="<?= $sirTrevorLanguageURL ?>"></script>

            <script>
                
                <?/*
                 * Checks if the user has changed *anything* in the current custom page 
                 * @returns boolean True if there were any changes, false otherwise
                 */?>
                function isContentModified()
                {
                    SirTrevor.onBeforeSubmit();

                    if ( window.oldSTJSON != JSON.stringify(window.editor.dataStore.data) || 
                         window.oldIcon   != $("#icon").val() ||
                         window.oldTitle  != $("#title").val() ){

                        return true;
                    }
                    else{
                        return false;
                    }

                }

                <?/*
                 * Resets the form to its default values.
                 */?>
                function createNewPage()
                {
                    $('.custom-page-name').fadeOut( "fast", function(){
                        $(this).html( "<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_NAME);?>" ).fadeIn("fast");
                    });

                    $(".cpage-content").fadeOut( "fast", function(){
                        $(".cpdeletebutton").hide();
                        $(".cpaddtomenubutton").show();
                        $(".cpaddtomenubutton").removeClass("btn-default");
                        $(".cpaddtomenubutton").addClass("btn-primary");
                        
                        $(".cpsavebutton").html( "<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_ADD);?>" );

                        $("#title").val( "" );
                        $("#pageiconimage").html( "<?="<i class='icon-light33'></i>"?>" );
                        $("#icon").val( "ic_Design_Paper" );
                        $("#json").val( "" );
                        $("#pageid").val( "0" );

                        window.editor.destroy();
                        window.editor = new SirTrevor.Editor({
                            el: $('.js-st-instance'),
                            blockTypes: ["Image", "Heading", "Text", "Video", "List", "Quote"]
                        });

                        window.oldSTJSON = JSON.stringify( window.editor.dataStore.data );
                        window.oldTitle  = $("#title").val();
                        window.oldIcon   = $("#icon").val();

                        $(this).fadeIn();
                    });

                }

                <?/*
                 * Gets all form info and relays it to the server.
                 */?>
                function savePage()
                {
                    if( window.saveFlag ) {
                        return;
                    }
                    else {
                        window.saveFlag = true;
                    }
                    
                    SirTrevor.onBeforeSubmit();

                    if ( editor.errors.length ){
                        $('#messagebox').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?=system_showText( LANG_SITEMGR_CUSTOMPAGES_ADD_FAILURE_SIRTREVOR_ERRORS )?></div>');
                        window.saveFlag = false;
                    }
                    else
                    {
                        <?php
                            /* If DEMO MODE is on, we don't allow the user to effectivelly change things
                             * Instead, we display a message letting he know it will work when live */
                            if ( DEMO_LIVE_MODE )
                            {
                                ?> livemodeMessage(true, false); <?php
                            }
                            else
                            {
                                ?>
                                var formData = {
                                    id     : $("#pageid").val(),
                                    title  : $("#title").val(),
                                    icon   : $("#icon").val(),
                                    json   : JSON.stringify(window.editor.dataStore),
                                    addToMenu : $(".cpaddtomenubutton").hasClass("btn-primary"),
                                    action : "save"
                                };

                                $.post("index.php", formData ).done(function(data){
                                    var response = JSON.parse( data );
                                    var alertclass;

                                    if ( response.result == 1 ) {
                                        createNewPage();
                                        renderPageCarrousel();
                                        alertclass = "alert-success";
                                    }
                                    else
                                    {
                                        alertclass = "alert-danger";
                                    }

                                    window.saveFlag = false;
                                    $('#messagebox').html('<div class="alert ' + alertclass + ' alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' + response.message +'</div>');
                                });
                                <?php
                            }
                        ?>
                    }

                    $('html, body').animate({
                        scrollTop: $('#messagebox').offset().top - $('#messagebox').height() - 20
                    }, 500);
                }

                <?/*
                 * Will prompt the user with a confirmation if he has changed anything in
                 * the current page. If he confirms, the callback argument function will
                 * be invoked and args will be passed as parameters
                 */?>
                function handleUserEdit( callback, args )
                {
                    if( isContentModified() )
                    {
                        bootbox.confirm('<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_LEAVE_MODAL)?>', function(result) {
                            if ( result ) {
                                callback( args );
                            }
                        });
                    }
                    else
                    {
                        callback( args );
                    }
                }

                <?/* Renders the app preview content of the custompage
                   * Also controlls whether or not the bottom menu will appear */?>
                function renderPreview()
                {
                    SirTrevor.onBeforeSubmit();

                    var dataStore = window.editor.dataStore.data, i, previewHTML = "";

                    for( i = 0; i < dataStore.length; i++ ){
                        var element = dataStore[i];

                        switch ( element.type ) {
                            case "text":
                                previewHTML += '<div class="custom-item-text"><p>'+SirTrevor.toHTML(element.data.text, "Text")+'</p></div>';
                                break;
                            case "image":

                                if ( element.data.file.blob )
                                {
                                    previewHTML += '<div class="custom-item-image"><img src="data:image/'+ element.data.file.extension.substring(1) +';base64,'+nl2br(element.data.file.blob)+'"></div>';
                                }
                                else
                                {
                                    previewHTML += '<div class="custom-item-image"><img src="'+ element.data.file.url +'"></div>';
                                }

                                break;
                            case "quote":
                                previewHTML += '<div class="custom-item-quote"><blockquote>'+SirTrevor.toHTML(element.data.text, "Quote")+'<cite>'+element.data.cite+'</cite></blockquote></div>';
                                break;
                            case "heading":
                                previewHTML += '<div class="custom-item-heading"><h1>'+SirTrevor.toHTML(element.data.text, "Heading")+'</h1></div>';
                                break;
                            case "video":
                                <?/* Each option has different methods of retrieving the video thumbnail
                                 * Youtube rocks and has all the images ready somewhere separated by ID
                                 * Vimeo on the other hand forces us to ajax it for the image.
                                 * Since ajax is processed assyncronously, we have to put a placeholder and
                                 * change its source after we get the server response */?>
                                switch ( element.data.source ){
                                    case "youtube":
                                        previewHTML += '<div class="custom-item-video"><img src="https://img.youtube.com/vi/'+element.data.remote_id+'/0.jpg" alt="placeholderimage"></div>';
                                        break;

                                    case "vimeo":
                                        var id = element.data.remote_id;
                                        previewHTML += '<div class="custom-item-video"><img id="videothumb'+id+'" src="" alt="placeholderimage"></div>';

                                        $.ajax({
                                            type:'GET',
                                            url: 'https://vimeo.com/api/v2/video/' + id  + '.json',
                                            jsonp: 'callback',
                                            dataType: 'jsonp',
                                            success: function(data){
                                                var video = data[0];
                                                $("#videothumb"+id ).attr( "src", video.thumbnail_large );
                                            }
                                        });
                                        break;
                                }
                                break;
                            case "list":
                                var list = element.data.text;
                                previewHTML += ' <div class="custom-item-list"><ul>'+SirTrevor.toHTML( list, "list" )+'</ul></div>';
                                break;
                        }
                    }

                    if ( previewHTML === "" ){
                        $('.custom-page-items').fadeOut( "fast", function(){
                            $(this).html( '<div class="custom-item-general"><?= system_showText(LANG_SITEMGR_CUSTOMPAGES_EMPTY) ?></div>' ).fadeIn("fast");
                        });

                        $('#bottommenu').hide();
                    }
                    else
                    {
                        $('.custom-page-items').fadeOut( "fast", function(){
                            $(this).html( previewHTML ).fadeIn("fast");
                        });
                        
                        $('#bottommenu').show();
                    }
                }

                <?/*
                 * Sets up the carousel's buttons functionality.
                 */?>
                function setCustomPageButtons()
                {
                    <?/* Loads clicked custom page's info into the forms... basically. */?>
                    $(".custompage").click( function( e ){
                        e.preventDefault();
                        handleUserEdit( loadCustomPage, { element : $(this) } );
                    });
                }

                <?/* Grabs an updated carrousel from the database */?>
                function renderPageCarrousel()
                {
                    $(".ocarousel").remove();

                    $.post("index.php", { action : "carousel" }).done( function(data){
                        $(".cpages-navigation").append( data );

                        $(".ocarousel").each(function(){
                            return new Ocarousel(this);
                        });

                        setCustomPageButtons();
                    });
                }

                <?/* Sets clicked button as active, loads page info via ajax, reinitializes
                 * Sir Trevor and renders said page's preview. Also controlls menu button states */?>
                function loadCustomPage( args )
                {
                    var element = args.element;

                    $('.active-custom-page').removeClass('active-custom-page');
                    element.parent("div").addClass("active-custom-page");

                    var pageid = element.data( "id" );
                    var container = $(".cpage-content");

                    container.fadeOut( "fast", function(){

                        window.editor.destroy();
                        
                        $.post("index.php", { action : "load", id : pageid }).done( function(data) {

                            data = JSON.parse( data );

                            $("#title").val( data.title );
                            $("#pageiconimage").html( data.iconImgTag );
                            $("#icon").val( data.icon );
                            $("#json").val( data.json );
                            $("#pageid").val( data.id );

                            $('.custom-page-name').fadeOut( "fast", function(){
                                $(this).html( $('#title').val() ).fadeIn("fast");
                            });

                            window.editor = new SirTrevor.Editor({
                                el: $('.js-st-instance'),
                                blockTypes: ["Image", "Heading", "Text", "Video", "List", "Quote"]
                            });

                            renderPreview();
                            window.oldSTJSON = JSON.stringify( window.editor.dataStore.data );
                            window.oldTitle  = data.title;
                            window.oldIcon   = data.icon;

                            $(".cpdeletebutton").show();
                            $(".cpaddtomenubutton").hide();
                            $(".cpsavebutton").html( "<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_SAVE);?>" );
                            container.fadeIn();
                        });
                    });
                }

                $(document).ready(function() {
                    <?/* Sir Trevor setup */?>
                    SirTrevor.LANGUAGE = "<?= $sirTrevorLanguage; ?>";

                    SirTrevor.EventBus.on("block:create:new block:create:existing block:remove", function(){
                        $('.st-block').focusout(function() { renderPreview(); });
                    });

                    SirTrevor.EventBus.on("block:remove", function(){ renderPreview(); });

                    SirTrevor.setBlockOptions("Image", {
                        drop_options: {
                            html: ['<div class="st-block__dropzone">',
                                '<span class="st-icon"><%= _.result(block, "icon_name") %></span>',
                                '<p><%= i18n.t("blocks:image:drop", { block: "<span>" + _.result(block, "title") + "</span>" }) %>',
                                '</p></div>'].join('\n'),
                            re_render_on_reorder: false
                        },
                        onUploadSuccess : function(data) {
                            this.setData(data);
                            this.ready();
                            renderPreview();
                        },
                        onUploadError : function(jqXHR, status, errorThrown){
                            $('#messagebox').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>' + jqXHR.responseText + '</div>');
                            $('html, body').animate({
                                scrollTop: $('#messagebox').offset().top - $('#messagebox').height() - 20
                            }, 500);
                            this.remove();
                        }
                    });

                    SirTrevor.setBlockOptions("Video", {
                        drop_options: {
                            html: ['<div class="st-block__dropzone">',
                                '<span class="st-icon"><%= _.result(block, "icon_name") %></span>',
                                '<p><%= i18n.t("blocks:video:drop", { block: "<span>" + _.result(block, "title") + "</span>" }) %>',
                                '</p></div>'].join('\n'),
                            re_render_on_reorder: false
                        }
                    });

                    window.editor = new SirTrevor.Editor({
                        el: $('.js-st-instance'),
                        blockTypes: ["Image", "Heading", "Text", "Video", "List", "Quote"]
                    });

                    SirTrevor.setDefaults({
                        uploadUrl: "index.php"
                    });

                    <?/* End of Sir Trevor's config. Phew. */?>

                    $('#title').focusout(function() {
                        $('.custom-page-name').fadeOut( "fast", function(){
                            $(this).html( $('#title').val() ).fadeIn("fast");
                        });
                    });

                    $('.cpsavebutton').click(function(e){
                        e.preventDefault();
                        savePage();
                    });

                    <?/* Confirms user's intention to leave the page
                     * and warns him about what happens when someone
                     * forgets to save one hour's worth of page editing */?>
                    $('#nextbutton').click(function(e){
                        e.preventDefault();

                        if( isContentModified() )
                        {
                            bootbox.confirm('<?=system_showText(LANG_SITEMGR_CUSTOMPAGES_LEAVE_MODAL)?>', function(result) {
                                if (result) {
                                    document.location.href = "<?= DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/menu/" ?>";
                                }
                            });
                        }
                        else
                        {
                            document.location.href = "<?= DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/menu/" ?>";
                        }
                    });

                    <?/* Prompts user to select a new icon for his page */?>
                    $("#pageiconimage").click(function(e){
                        e.preventDefault();
                        $("#modal-iconselect").modal();
                        $(".iconbuttonmodal").parent("li").removeClass("active");
                        $("#" + $("#icon").val() ).parent("li").addClass("active");
                    });

                    <?/* Sets cliccked icon as the page's icon and closes the modal */?>
                    $(".iconbuttonmodal").click(function(e){
                        e.preventDefault();
                        $("#pageiconimage").html( "<?="<img src='".DEFAULT_URL."/assets/icons/api/"?>" + $(this).attr('id') + ".png' alt='Icon'>" );
                        $("#icon").val( $(this).attr('id') );
                        $("#modal-iconselect").modal('hide');
                    });

                    <?/* Prompts user to choose the ultimate fate of current page. This is not shown if the page is new */?>
                    $('.cpdeletebutton').click(function(e){
                        e.preventDefault();
                        confirmBox('<?= system_showText(LANG_SITEMGR_CUSTOMPAGES_REMOVE_MODAL_CONFIRM); ?>', $('#pageid').val() );
                    });

                    <?/* Allows the user to add the newly created page to the menu automagically */?>
                    $('.cpaddtomenubutton').click(function(e){
                        $('.cpaddtomenubutton').toggleClass( "btn-primary" ).blur();
                        $('.cpaddtomenubutton').toggleClass( "btn-default" ).blur();
                    });

                    <?/* this is necessary to remove submit functionality which is set by default on this modal source */?>
                    $('#modal-confirm-button').unbind( "click" );

                    <?/* gets the id of the soon-to-be-extinct page and queries the server
                     * renders new carousel in order to update and remove deleted pages from it */?>
                    $('#modal-confirm-button').click(function(){
                        <?php
                            if ( DEMO_LIVE_MODE )
                            {
                                ?>
                                livemodeMessage(true, false);
                                <?php
                            }
                            else
                            {
                                ?>
                                var idToDelete = $("#modal-confirm-form").val();

                                if ( idToDelete > 0 ){
                                    $.post("index.php", { action : "delete", id : idToDelete } ).done(function(data){
                                        $('#messagebox').html('<div class="alert alert-success alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?= system_showText(LANG_SITEMGR_CUSTOMPAGES_REMOVE_SUCCESS); ?></div>');
                                    });
                                }
                                else{
                                    $('#messagebox').html('<div class="alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button><?= system_showText(LANG_SITEMGR_CUSTOMPAGES_REMOVE_FAILURE); ?></div>');
                                }

                                $('html, body').animate({
                                    scrollTop: $('#messagebox').offset().top - $('#messagebox').height() - 20
                                }, 500);
                                <?php
                            }
                        ?>

                        createNewPage();
                        renderPageCarrousel();
                        $('#modal-confirm').modal('hide');
                    });

                    <?/*
                     * resets form to default state
                     *  This button is 'clicked' automatically in some parts of the code */?>
                    $(".cpage-new").click( function(e){
                        e.preventDefault();
                        handleUserEdit( createNewPage );
                    });

                    <?/* Initializes the custom pages carousel. Looking for configs? it's set as attributes
                     * on the carousel's div. Check opencarousel's documentations */?>
                    renderPageCarrousel();

                    <?/* This is the icon modal List.js configuration. The filter thing. */?>
                    window.list = new List('iconmodaldiv', { valueNames: [ 'modaliconbuttonlabel' ], page : 2000 });

                    <?/* These will store the default values of a loaded page for the isContentModified
                     * function to have a comparison base */?>
                    window.oldSTJSON = JSON.stringify( window.editor.dataStore.data );
                    window.oldTitle  = $("#title").val();
                    window.oldIcon   = $("#icon").val();
                });
            </script>
            <?php
            break;

        /* ================== MENU ==================  */
        case "menu":
            ?>
            <script>
                function JS_submit() {
                    serialize();
                    document.form_menu.submit();
                }

               function ResetNavigation() {
                   confirmBox('<?= system_showText(LANG_SITEMGR_NAVIGATION_CONFIRM_RESET); ?>', 'reset_navigation');
               }

               function editMenu(id, show) {
                   if (show) {
                       $("#preview_item" + id).css("display", "none");
                       $("#edit_item" + id).css("display", "");
                   } else {
                       $("#preview_item" + id).css("display", "");
                       $("#edit_item" + id).css("display", "none");
                       $("#navigation_text_preview_" + id).html($("#navigation_text_cancel_" + id).val());
                       $("#navigation_text_" + id).attr("value", $("#navigation_text_cancel_" + id).val());
                       updatePreview($("#navigation_text_cancel_" + id));
                   }
               }

               function updateItem(id, obj) {
                   $("#navigation_text_preview_" + id).html(obj.value);
               }

               function NextStep(redirect, id) {

               <? if (DEMO_LIVE_MODE) { ?>
                   if (redirect) {
                       window.location.href = "<?= DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/menu/?successMessage=1" ?>";
                   } else {
                       livemodeMessage(true, false);
                   }
               <? } else { ?>
                   $("#SaveByAjax").val("true");
                   $('#sortable').sortable('option', 'items', 'li');
                   $("#order_options").attr("value", $("#sortable").sortable("toArray"));

                   $.post("<?= $_SERVER["PHP_SELF"] ?>", $("#form_menu").serialize(), function(data) {
                       if ($.trim(data) == "ok") {
                           if (redirect) {
                               window.location.href = "<?= DEFAULT_URL . "/" . SITEMGR_ALIAS . "/mobile/menu/?successMessage=1" ?>";
                           } else {
                               $("#preview_item" + id).css("display", "");
                               $("#edit_item" + id).css("display", "none");
                               $("#auxErrorMessage").css("display", "none");
                               $("#successMessage").css("display", "none");
                               $('#sortable').sortable('option', 'items', 'li:not(.static)');
                           }
                       } else {
                           $("#auxErrorMessage").html(data);
                           $("#successMessage").css("display", "none");
                           $("#auxErrorMessage2").css("display", "none");
                           $("#auxErrorMessage").css("display", "");
                           $('html, body').animate({
                               scrollTop: $('.container h4').offset().top
                           }, 500);
                       }
                   });
               <? } ?>
               }

               $(function() {
                    disableDropdown();
                    $("#sortable").sortable({
                        items: 'li:not(.static)',
                        start: function(){
                            $('.static', this).each(function(){
                                var $this = $(this);
                                $this.data('pos', $this.index());
                            });
                        },
                        change: function(){
                            $sortable = $(this);
                            $statics = $('.static', this).detach();
                            $helper = $('<li></li>').prependTo(this);
                            $statics.each(function(){
                                var $this = $(this);
                                var target = $this.data('pos');

                                $this.insertAfter($('li', $sortable).eq(target));
                            });
                            $helper.remove();
                        },
                        cancel: " input, select, option, #sortable-title, .alert-tip",
                        stop: function() {
                            updatePreview();
                        }
                    });
                });
            </script>
            <?php
            break;

        /* ================== finalstep.php - BUILD ==================  */
        case "finalstep":
            ?>
            <script>
                function JS_submit() {
                    serialize();
                    document.form_menu.submit();
                }

                function boxReviewSteps() {
                    $("#reviewSteps").fadeIn(1000);
                }
            </script>
            <?php
            break;
    }
?>


<script>
    /*
     * Auxiliary function to fix line breaks on the preview
     */
    function nl2br(str, is_xhtml) {
        var breakTag = (is_xhtml || typeof is_xhtml === 'undefined') ? '<br ' + '/>' : '<br>'; // Adjust comment to avoid issue on phpjs.org display

        return (str + '').replace(/([^>\r\n]?)(\r\n|\n\r|\r|\n)/g, '$1' + breakTag + '$2');
    }

    $(".icon-device-apple").click(function() {
        $("#device-android").css("display", "none");
        $("#device-apple").css("display", "");
        $("#tab_selected").attr("value", "apple");
    });
    $(".icon-device-android").click(function() {
        $("#device-android").css("display", "");
        $("#device-apple").css("display", "none");
        $("#tab_selected").attr("value", "android");
    });
</script>