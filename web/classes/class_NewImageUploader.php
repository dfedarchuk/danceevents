<?
	/*==================================================================*\
	######################################################################
	#                                                                    #
	# Copyright 2014 Arca Solutions, Inc. All Rights Reserved.           #
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
	# * FILE: /classes/NewImageUploader.php
	# ----------------------------------------------------------------------------------------------------

    class NewImageUploader
    {
        public $module;
        public $galleryHash;
        public $galleryID;
        public $maxImages;
        public $domainID;

        public $isModal;
        public $isSiteManager;

        public function __construct( $module, $galleryHash, $galleryID, $maxImages, $domainID, $isModal = false, $isSiteManager = false )
        {
            $this->module        = $module;
            $this->galleryHash   = $galleryHash;
            $this->galleryID     = $galleryID;
            $this->maxImages     = $maxImages;
            $this->domainID      = $domainID;
            $this->isModal       = $isModal;
            $this->isSiteManager = $isSiteManager;
        }

        /**
         * Renders the necessary HTML for CropJS to work.
         */
        public function buildCrop()
        {
            ?>
                <div id="cropPanel" <?= ( $this->isModal ? "":'style="display: none;"') ?>>
                    <div class="row">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <img src="" id="crop_image">
                            </div>
                        </div>
                    </div>
                    <? if (string_strpos($_SERVER["PHP_SELF"], "deal.php") === false) { ?>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group">
                                <label for="crop_image_title"><?=string_ucwords(system_showText(LANG_LABEL_IMAGE_TITLE))?></label>
                                <input type="text" class="form-control" id="crop_image_title" maxlength="100">
                                <label for="crop_image_description"><?=string_ucwords(LANG_LABEL_IMAGE_DESCRIPTION)?></label>
                                <input type="text" class="form-control" id="crop_image_description" maxlength="100">
                            </div>
                        </div>
                    </div>
                    <? } ?>
                    <div>
                        <button type="button" class="btn btn-default" id="cropPanelCancelButton" data-dismiss="modal"><?=system_showText(LANG_CANCEL);?></button>
                        <button type="button" class="btn btn-primary action-save" id="button-edit-img" data-loading-text="<?=system_showText(LANG_LABEL_FORM_WAIT);?>" onclick="saveImage();"><?=system_showText(LANG_MSG_SAVE_CHANGES);?></button>
                    </div>
                </div>
            <?
        }

        /**
         * Renders the necessary HTML for ImageUpload to work.
         * @param bool $renderImageFields
         * @param string $divId
         * @param bool $plural
         */
        public function buildform($renderImageFields = false, $divId = "tour-images", $plural = true )
        {
                /* Auxiliary inputs for image upload */ ?>
                <input type="hidden" id="gallery_hash" name="gallery_hash" value="<?= $this->galleryHash ?>">
                <input type="hidden" id="item_type"    name="item_type"    value="<?= $this->module      ?>">
                <input type="hidden" id="galleryid"    name="galleryid"    value="<?= $this->galleryID   ?>">
                <input type="hidden" id="max_images"   name="max_images"   value="<?= $this->maxImages   ?>">
                <input type="hidden" id="domain_id"    name="domain_id"    value="<?= $this->domainID    ?>">

                <? if ($renderImageFields) { ?>
                <div class="panel panel-form-media" id="<?= $divId ?>">
                    <div class="panel-heading">
                        <?= system_showText( $plural ? LANG_LABEL_PHOTO_GALLERY : ($this->module == "blog" || $this->module == "promotion" ? LANG_LABEL_THUMBNAIL : LANG_LABEL_IMAGE) );?>
                        <div class="pull-right">
                            <input id="upload-images" type="file" name="files[]" class="filestyle upload-files file-noinput" <?= $plural ? "multiple" : "" ?>>
                        </div>
                    </div>
                    <div class="panel-body">
                        <p class="text-center text-muted"><?=system_showText(LANG_LABEL_PHOTO_GALLERY_MAIN)?></p><br>
                        <div id="filesImages" class="files uploaded-files"></div>
                        <div id="no-filesImages" class="no-files center-block text-center">
                            <i class="icon-images9"></i>
                            <p class="text-muted"><?=system_showText(LANG_MSG_DROP_IMAGE);?></p>
                        </div>
                    </div>
                    <div class="panel-footer text-center">
                        <p class="small text-muted"><?=system_showText(LANG_LABEL_RECOMMENDED_DIMENSIONS);?>: <?= constant( "IMAGE_".strtoupper($this->module)."_FULL_WIDTH" ); ?>px x <?= constant( "IMAGE_".strtoupper($this->module)."_FULL_HEIGHT" ); ?>px (JPG, GIF <?=system_showText(LANG_OR);?> PNG)</p>
                        <p class="small text-muted"><?=system_showText(LANG_MSG_MAX_FILE_SIZE)?> <?=UPLOAD_MAX_SIZE;?> MB. <?=system_showText(LANG_MSG_ANIMATEDGIF_NOT_SUPPORTED);?></p>
                    </div>
                </div>
                <?php }
        }

        /**
         * Adds all necessary Javascript for the entire system to work.
         */
        public function registerJavaScript()
        {
            /* The Templates plugin is included to render the upload/download items */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/tmpl.min.js" );
            /* The Load Image plugin is included for the preview images and image resizing functionality */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/load-image.all.min.js" );
            /* The Iframe Transport is required for browsers without support for XHR file uploads */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/jquery.iframe-transport.js" );
            /* The basic File Upload plugin */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/jquery.fileupload.js" );
            /* The File Upload processing plugin */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/jquery.fileupload-process.js" );
            /* The File Upload user interface plugin */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/jquery.fileupload-ui.js" );
            /* The main application script */
            JavaScriptHandler::registerFile( DEFAULT_URL."/scripts/jquery/jQuery-File-Upload-9.8.0/main.js" );

            /* The template to display files available for upload */
            $js = '
            {% for (var i=0, file; file=o.files[i]; i++) { %}

                <div class="template-upload row item fade">
                    <div class="col-sm-3 col-xs-6">&nbsp;</div>
                    <div class="col-sm-3 col-xs-6 pull-right">
                        {% if (!i) { %}
                        <p><span class="btn btn-sm btn-warning btn-iconic cancel"><i class="icon-ion-ios7-close-empty"></i></span></p>
                        {% } %}
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <strong>{%=file.name%}</strong>
                        <p class="error"></p>
                        <div class="progress progress-striped active" role="progressbar" aria-valuemin="0" aria-valuemax="100" aria-valuenow="0"><div class="progress-bar progress-bar-success" style="width:0%;"></div></div>
                    </div>
                </div>
            {% } %}
            ';
            JavaScriptHandler::registerLone($js, 'id="template-upload" type="text/x-tmpl"');

            /* The template to display files available for download */
            $js = '
            {% for (var i=0, file; file=o.files[i]; i++) { %}

                <div class="template-download row item fade">
                    <div id="gallery-image-{%=file.image_id%}" data-image_id="{%=file.image_id%}" data-thumb_id="{%=file.thumb_id%}" data-item_id="{%=file.item_id%}" data-temp="{%=file.temp%}" data-item_type="{%=file.item_type%}" data-image_default="{%=file.image_default%}" data-imgtype="{%=file.type%}" class="col-sm-3 col-xs-6 item-gallery {% if (file.image_default == "y") { %} image-default {% } %}" onclick="makeMain( this );">
                        {% if (file.thumbnailUrl) { %}
                        <img id="img-{%=file.image_id%}" src="{%=file.thumbnailUrl%}" alt="{%=file.name%}" data-title="{%=file.title%}" data-description="{%=file.description%}" data-width="{%=file.width%}" data-height="{%=file.height%}" class="img-responsive">
                        {% } %}
                    </div>
                    <div class="col-sm-3 col-xs-6 pull-right">
                        <p>
                            {% if (file.deleteUrl) { %}
                            <span class="btn btn-sm btn-primary btn-iconic" onclick="editImage({%=file.image_id%});" href="#"><i class="icon-edit38"></i></span>
                            <span id="deleteButton{%=file.image_id%}" class="btn btn-sm btn-danger btn-iconic delete" data-type="{%=file.deleteType%}" data-url="{%=file.deleteUrl%}"{% if (file.deleteWithCredentials) { %} data-xhr-fields="{"withCredentials":true}"{% } %}><i class="icon-ion-ios7-trash-outline"></i></span>
                            {% } else { %}
                            <span class="btn btn-sm btn-warning btn-iconic cancel"><i class="icon-ion-ios7-close-empty"></i></span>
                            {% } %}
                        </p>
                    </div>
                    <div class="col-sm-6 col-xs-12">
                        <strong id="preview-title-{%=file.image_id%}">
                            {% if (file.title) { %}
                                {%=file.title%}
                            {% } else { %}
                                {%=file.name%}
                            {% } %}
                        </strong>
                        {% if (file.error) { %}
                            <p>{%=file.error%}</p>
                        {% } else { %}
                            <p id="preview-description-{%=file.image_id%}">
                            {% if (file.description) { %}
                                {%=file.description%}
                            {% } %}
                            </p>
                        {% } %}
                    </div>
                </div>
            {% } %}
            ';
            JavaScriptHandler::registerLone($js, 'id="template-download" type="text/x-tmpl"');

            JavaScriptHandler::registerOnReady('
            $("#cropPanelCancelButton").click(function(){
                $("#cropPanel").fadeOut( function(){
                    $("#tour-images").fadeIn();
                });
            });

            ');

            JavaScriptHandler::registerLoose('
            window["blobs"] = [];

            function clearCropModule()
            {
                window.cropModule = {
                    cropSystem   : true,
                    temp         : null,
                    domainId     : '.$this->domainID.',
                    newImageId   : null,
                    originalBlob : null,
                    galleryId    : '.sprintf("%d", $this->galleryID).',
                    image : {
                        id          : null,
                        title       : null,
                        description : null,
                        type        : null
                    },
                    newDimensions : {
                        startPoint : { x : 0, y : 0 },
                        endPoint   : { x : 0, y : 0 },
                        width      : 0,
                        height     : 0
                    },
                    '. ( $this->isSiteManager ? '
                    accountId    : null,' : '' ) .'
                };
            }

            var jcrop_api;

            $(".item-gallery").click(function(){
                var object = $(this);
                $(".image-default").removeClass("image-default");
                object.addClass("image-default");
                makeMain( object.data("image_id"), object.data("thumb_id"),  object.data("item_id"),  object.data("temp"),  object.data("item_type") );
            });

            function makeMain( item )
            {
                object = $(item);
                /*
                 * image_id and thumb_id are got in a different way because jQuery makes cache of the data()
                 * It means that if an image passed through this function once, the next time of that image
                 * in this function, jQuery would return the cached value of the data attribute.
                 * It is a problem because every time the user edit the image, the data attribute is going
                 * to be changed.
                 * See http://api.jquery.com/data/#data-html5
                 */
                var image_id  = object.attr("data-image_id");
                var thumb_id  = object.attr("data-thumb_id");
                var item_id   = object.data("item_id");
                var temp      = object.data("temp");
                var item_type = object.data("item_type");

                //Call ajax only for non-default images
                if (object.data("image_default") == "n")
                {
                    $.get(DEFAULT_URL + "/makemainimage.php", {
                        image_id: image_id,
                        thumb_id: thumb_id,
                        item_id: item_id,
                        temp: temp,
                        item_type: item_type,
                        gallery_hash: "'.$this->galleryHash.'",
                        domain_id: '.$this->domainID.'
                    }, function () {
                        //Remove image-default class from all images
                        $(".item-gallery").removeClass("image-default");
                        //Add image-default class for the image clicked
                        object.addClass("image-default");
                        //Remove onclick event for all images
                        $(".item-gallery").data("image_default", "n");
                        //Change image_default attribute for the image clicked
                        object.data("image_default", "y");
                    });
                }
            }

            function editImage(image_id) {
                clearCropModule();
                var cropImage = $("#img-" + image_id).first();

                '. ( $this->isSiteManager ? '
                window.cropModule.accountId         = $("#account_id").val();' : '' ) .'
                window.cropModule.image.id          = image_id;
                window.cropModule.image.title       = cropImage.data("title");
                window.cropModule.image.description = cropImage.data("description");
                window.cropModule.image.type        = $("#gallery-image-" + image_id ).data("imgtype");
                window.cropModule.temp              = $("#gallery-image-" + image_id ).data("temp");

                $("#crop_image_title").val( window.cropModule.image.title );
                $("#crop_image_description").val( window.cropModule.image.description );

                //Set image path
                if( image_id in window["blobs"] ){
                    $("#crop_image").attr("src", "data:image/"+ window["blobs"][image_id]["type"] +";base64,"+ window["blobs"][image_id]["blob"] );
                }
                else{
                    $("#crop_image").attr("src", cropImage.attr("src"));
                }

                //Destroy crop obj
                if (jcrop_api) {
                    jcrop_api.destroy();
                }

                //Initialize crop
                setJcrop( cropImage.data("width"), cropImage.data("height"));
                '.( $this->isModal ?
                '
                $("#modal-crop").modal("show");
                    ' : '
                $("#tour-images").fadeOut("fast", function(){
                    $("#cropPanel").fadeIn();
                    scrollPage("#cropPanel");
                });
                    ' ).'
            }

            function saveImage() {
                $("#button-edit-img").prop( "disabled", true );
                $("#button-edit-img").html( "'.system_showText(LANG_LABEL_FORM_WAIT).'", true );

                var image_id = window.cropModule.image.id;

                window.cropModule.image.title       = $("#crop_image_title").val();
                window.cropModule.image.description = $("#crop_image_description").val();

                if ( window.cropModule.image.title ) {
                    $("#preview-title-"+image_id).html( window.cropModule.image.title );
                    $("#img-" + image_id).data("title", window.cropModule.image.title );
                }

                if ( window.cropModule.image.description ) {
                    $("#preview-description-"+image_id).html( window.cropModule.image.description );
                    $("#img-" + image_id).data("description", window.cropModule.image.description );
                }

                if( image_id in window["blobs"] ){
                    var treatedBlob =  window["blobs"][image_id]["blob"];
                    treatedBlob = treatedBlob.replace( /\+/g, "-" );
                    treatedBlob = treatedBlob.replace( /\=/g, "." );
                    treatedBlob = treatedBlob.replace( /\//g, "_" );

                    window.cropModule.newImageId = window["blobs"][image_id]["newImageId"];
                    window.cropModule.originalBlob = treatedBlob;
                }

                $.post("'.$_SERVER["PHP_SELF"].'", window.cropModule ).done( function(data) {
                    var processedData = JSON.parse( data );
                    if (processedData) {
                        if( data.errors ){
                            console.log( data.errors );
                        }
                        else{
                            $("#img-"+image_id).attr( "src", processedData.croppedImagePath );
                            $("#gallery-image-"+image_id).attr("data-image_id", processedData.newImageId.toString());
                            $("#gallery-image-"+image_id).attr("data-thumb_id", processedData.newThumbId.toString());

                            if( !(image_id in window["blobs"]) ){
                                window["blobs"][image_id] = {
                                    type       : processedData.originalType,
                                    blob       : processedData.originalBlob
                                };
                            }

                            window["blobs"][image_id]["newImageId"] = processedData.newImageId;

                            var deleteUrl = $("#deleteButton" + image_id).data("url");
                            deleteUrl = deleteUrl.replace(/photo_(\d)+/, "photo_" + processedData.newImageId);
                            $("#deleteButton" + image_id).data("url", deleteUrl);
                        }
                    }

                    $("#button-edit-img").prop( "disabled", false );
                    $("#button-edit-img").html( "'.system_showText(LANG_MSG_SAVE_CHANGES).'", true );
                    $("#button-edit-img").removeClass( "disabled" );
                '.( $this->isModal ?
                    '
                    $("#modal-crop").modal("hide");
                    ' : '
                    $("#cropPanel").fadeOut("fast", function(){
                        $("#tour-images").fadeIn();
                        scrollPage("#img-"+image_id);
                    });
                    ' ).'
                });
            }

            // creating the Jcrop
            function setJcrop(imgWidth, imgHeight) {
                function showCoords(c) {
                    window.cropModule.newDimensions = {
                        startPoint : { x : c.x, y : c.y },
                        endPoint   : { x : c.x2, y : c.y2 },
                        width      : c.w,
                        height     : c.h
                    };
                };

                $("#crop_image").Jcrop({
                    onChange        : showCoords,
                    onSelect        : showCoords,
                    setSelect       : [ imgWidth * 0.1, imgHeight * 0.1, imgWidth * 0.9 , imgHeight * 0.9 ],
                    aspectRatio     : 0,
                    boxWidth        : 400,
                    boxHeight       : 400,
                    bgColor         : "transparent",
                    fullImageWidth  : imgWidth,
                    fullImageHeight : imgHeight,
                    keySupport      : false
                },function(){
                    jcrop_api = this;
                });
            }');

        }

        /* Renders the required HTML and JS to upload and crop files */
        public function render()
        {
            echo '<div id="cropSection">';
            $this->buildCrop();
            $this->buildform();
            echo '</div>';
            $this->registerJavaScript();
        }

        /**
         * Function to proccess post requests from image crops
         * @param string $url_base This is used to check user permissions and image name
         * @param string $moduleTable
         */
        public static function treatPost( $url_base, $moduleTable )
        {
            if( $_POST['cropSystem'] )
            {
                extract( $_POST );
                extract( $_GET );

                $dbMain = db_getDBObject( DEFAULT_DB, true );
                $dbObj  = db_getDBObjectByDomainID( $domainId, $dbMain );

                $responseArray = array(
                    "errors"           => null,
                    "croppedImagePath" => null
                );

                /* These are going to be deleted if the crop is successfull */
                $oldThumb = null;
                $oldImage = null;

                /* This is necessary in order to keep track in cases of multiple crops. */
                $idToChange = db_formatNumber( empty( $newImageId ) ? $image["id"] : $newImageId );

                /* If a gallery is temporary, we don't care about cleaning, its going to be deleted anyway
                 * However, if it's not, we need to guarantee old(unused) images will be deleted. */
                if( $temp != "y" )
                {
                    /* Checks permissions for members area (AKA smartass protection) */
                    if ( string_strpos( $url_base, "/" . MEMBERS_ALIAS . "" ) )
                    {
                        $accountId = (int)sess_getAccountIdFromSession();
                        $galleryId = (int)$galleryId;

                        $sql = "SELECT gallery_id FROM Gallery_Item WHERE item_id IN ( SELECT id FROM {$moduleTable} WHERE account_id = {$accountId} )";
                        $result = $dbObj->query( $sql );

                        $isOwner = false;

                        while ( ( $row = mysql_fetch_assoc($result) ) && !$isOwner )
                        {
                            if( $row["gallery_id"] == $galleryId || $moduleTable == "Promotion" )
                            {
                                $isOwner = true;
                            }
                        }

                        if ( !$isOwner )
                        {
                            exit;
                        }
                    }

                    /* Deletes old images */
                    $oldThumb = null;
                    $oldImage = new Image( $idToChange );

                    $sql = "SELECT thumb_id from Gallery_Image WHERE gallery_id = {$galleryId} AND image_id = {$idToChange} LIMIT 1";
                    $result = $dbObj->query( $sql );

                    if( $row = mysql_fetch_assoc($result) )
                    {
                        $oldThumb = new Image( $row["thumb_id"] );
                    }
                }

                /* This is necessary in order to transfer BASE64 data via URLs
                 * BASE64 strings contain +, / and =, which interfere with GET parameters */
                $originalBlob= strtr( $originalBlob, '-_.', '+/=');

                //Crop Image
                $originalImage = null;

                /* If no blob info is sent via post, we will assume we're dealing with the first image */
                if ( empty( $originalBlob ) )
                {
                    $files = glob( IMAGE_DIR."/*".$image["id"].".".string_strtolower( $image["type"] ) );

                    // TYPES
                    switch ( $image["type"] )
                    {
                        case "gif": $originalImage = imagecreatefromgif( $files[0] );  break;
                        case "jpg": $originalImage = imagecreatefromjpeg( $files[0] ); break;
                        case "png": $originalImage = imagecreatefrompng( $files[0] );  break;
                        default : $responseArray["errors"][] = "Couldn't open original image.";
                    }

                    /* This will create a binary representation of this image and send it back via json */
                    if( $originalImage )
                    {
                        $responseArray["originalBlob"] = base64_encode( file_get_contents( $files[0] ) );
                        $responseArray["originalType"] = $image["type"];
                    }
                }
                else
                {
                    /* If we get a blob from the form, we'll assemble it back into an image in order to crop*/
                    if ( !( $originalImage = @imagecreatefromstring( base64_decode( $originalBlob ) ) ) )
                    {
                        $responseArray["errors"][] = "Couldn't convert blob into image.";
                    }
                }

                if ( $newDimensions["width"] > 0 && $newDimensions["height"] > 0 && $originalImage && $responseArray["errors"] === null )
                {
                    $dst_r      = ImageCreateTrueColor( $newDimensions["width"], $newDimensions["height"] );
                    $lowQuality = false;

                    if ( $image["type"] == "png" || $image["type"] == "gif" )
                    {
                        imagealphablending( $dst_r, false );
                        imagesavealpha( $dst_r, true );

                        $transparent = imagecolorallocatealpha( $dst_r, 255, 255, 255, 127 );

                        imagefill( $dst_r, 0, 0, $transparent );
                        imagecolortransparent( $dst_r, $transparent );

                        if ( imagecolortransparent( $originalImage ) >= 0 )
                        {
                            $lowQuality = true; //only use imagecopyresized (low quality) if the image is a transparent gif
                        }
                    }

                    if ( $image["type"] == "gif" && $lowQuality )
                    {
                        imagecopyresized( $dst_r, $originalImage, 0, 0, $newDimensions["startPoint"]["x"], $newDimensions["startPoint"]["y"], $newDimensions["width"], $newDimensions["height"], $newDimensions["width"], $newDimensions["height"] );
                    }
                    else
                    {
                        imagecopyresampled( $dst_r, $originalImage, 0, 0, $newDimensions["startPoint"]["x"], $newDimensions["startPoint"]["y"], $newDimensions["width"], $newDimensions["height"], $newDimensions["width"], $newDimensions["height"] );
                    }

                    if ( FORCE_SAVE_JPG_AS_PNG == "on" && $image["type"] == "jpg" )
                    {
                        $crop_image = IMAGE_DIR."/crop_image_".uniqid( ($_COOKIE["PHPSESSID"]).strtotime( date( 'Y-m-d H:i:s' ) ) ).".png";
                    }
                    else
                    {
                        $crop_image = IMAGE_DIR."/crop_image_".uniqid( ($_COOKIE["PHPSESSID"]).strtotime( date( 'Y-m-d H:i:s' ) ) ).".".$image["type"];
                    }

                    if ( $image["type"] == 'gif' )
                    {
                        imagegif( $dst_r, $crop_image );
                    }
                    elseif ( $image["type"] == 'png' || FORCE_SAVE_JPG_AS_PNG == "on" )
                    {
                        imagepng( $dst_r, $crop_image );
                    }
                    elseif ( $image["type"] == 'jpg' )
                    {
                        imagejpeg( $dst_r, $crop_image );
                    }

                    if ( string_strpos( $url_base, "/".SITEMGR_ALIAS."" ) !== false )
                    {
                        if( $accountId = abs( (int)$accountId ) )
                        {
                            $auxPrefix = "{$accountId}_";
                        }
                        else
                        {
                            $auxPrefix = "sitemgr_";
                        }
                    }
                    else
                    {
                        $auxPrefix = $_SESSION[SESS_ACCOUNT_ID]."_";
                    }

                    /* retrieve the right dimensions for each module */
                    switch( $moduleTable )
                    {
                        case "Article" :
                            $imageFullWidth   = IMAGE_ARTICLE_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_ARTICLE_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_ARTICLE_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_ARTICLE_THUMB_HEIGHT;
                        case "Post" :
                            $imageFullWidth   = IMAGE_BLOG_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_BLOG_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_BLOG_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_BLOG_THUMB_HEIGHT;
                        case "Classified" :
                            $imageFullWidth   = IMAGE_CLASSIFIED_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_CLASSIFIED_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_CLASSIFIED_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_CLASSIFIED_THUMB_HEIGHT;
                        case "Event" :
                            $imageFullWidth   = IMAGE_EVENT_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_EVENT_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_EVENT_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_EVENT_THUMB_HEIGHT;
                        case "Promotion" :
                            $imageFullWidth   = IMAGE_PROMOTION_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_PROMOTION_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_PROMOTION_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_PROMOTION_THUMB_HEIGHT;
                        case "Listing" :
                        default :
                            $imageFullWidth   = IMAGE_LISTING_FULL_WIDTH;
                            $imageFullHeight  = IMAGE_LISTING_FULL_HEIGHT;
                            $imageThumbWidth  = IMAGE_LISTING_THUMB_WIDTH;
                            $imageThumbHeight = IMAGE_LISTING_THUMB_HEIGHT;
                    }

                    $imageArray = image_uploadForItem( $crop_image, $auxPrefix, $imageFullWidth, $imageFullHeight, $imageThumbWidth, $imageThumbHeight );


                    if ( $imageArray["image_id"] )
                    {
                        if ( $temp == "y" )
                        {
                            $sql = "UPDATE Gallery_Temp SET
                                        image_id = ".db_formatNumber( $imageArray["image_id"] ).",
                                        thumb_id = ".db_formatNumber( $imageArray["thumb_id"] ).",
                                        image_caption = ".db_formatString( $image["title"] ).",
                                        thumb_caption = ".db_formatString( $image["description"] )."
                                    WHERE image_id = $idToChange";
                        }
                        elseif ( string_strpos( $_SERVER["PHP_SELF"], "deal.php" ) !== false )
                        {
                            $sql = "UPDATE Promotion SET
                                        image_id = ".db_formatNumber( $imageArray["image_id"] ).",
                                        thumb_id = ".db_formatNumber( $imageArray["thumb_id"] )."
                                    WHERE image_id = $idToChange";
                        }
                        elseif ( string_strpos( $_SERVER["PHP_SELF"], "blog.php" ) !== false )
                        {
                            $sql = "UPDATE Post SET
                                        image_id = ".db_formatNumber( $imageArray["image_id"] ).",
                                        thumb_id = ".db_formatNumber( $imageArray["thumb_id"] )."
                                    WHERE image_id = $idToChange";
                        }
                        else
                        {

                            $sql = "UPDATE $moduleTable SET
                                        image_id = ".db_formatNumber( $imageArray["image_id"] ).",
                                        thumb_id = ".db_formatNumber( $imageArray["thumb_id"] )."
                                    WHERE image_id = $idToChange";
                            $dbObj->query( $sql );

                            $sql = "UPDATE Gallery_Image SET
                                        image_id = ".db_formatNumber( $imageArray["image_id"] ).",
                                        thumb_id = ".db_formatNumber( $imageArray["thumb_id"] ).",
                                        image_caption = ".db_formatString( $image["title"] ).",
                                        thumb_caption = ".db_formatString( $image["description"] )."
                                    WHERE image_id = $idToChange";
                        }

                        $dbObj->query( $sql );

                        $oldImage and $oldImage->Delete();
                        $oldThumb and $oldThumb->Delete();

                        $imgObj = new Image( $imageArray["image_id"] );

                        $responseArray["croppedImagePath"] = $imgObj->getPath();
                        $responseArray["newImageId"] = $imageArray["image_id"];
                        $responseArray["newThumbId"] = $imageArray["thumb_id"];
                    }
                }

                echo json_encode( $responseArray );
                exit;
            }
        }

    }
