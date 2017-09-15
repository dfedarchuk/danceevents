<?
    /*
    * # Admin Panel for eDirectory
    * @copyright Copyright 2014 Arca Solutions, Inc.
    * @author Basecode - Arca Solutions, Inc.
    */

    # ----------------------------------------------------------------------------------------------------
	# * FILE: /includes/modals/modal-crop.php
	# ----------------------------------------------------------------------------------------------------

?>

    <div class="modal fade" id="modal-crop" tabindex="-1" role="dialog" aria-labelledby="modal-crop" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only"><?=system_showText(LANG_CLOSE);?></span></button>
                    <h4 class="modal-title"><?=system_showText(LANG_LABEL_IMAGE_CROP)?></h4>
                </div>
                
                <div class="modal-body">
                    <?php
                        $imageUploader->buildCrop();
                    ?>
                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->