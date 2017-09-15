<!-- edit slider modal -->
<div class="modal fade wysiwyg" id="remove-widget-modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog">
        <div class="modal-content modal-danger">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                <h4 class="modal-title" id="myModalLabel"><?= system_showText(LANG_SITEMGR_REMOVE_WIDGET); ?></h4>
            </div>
            <div class="modal-body text-center">
                <p><?= system_showText(LANG_SITEMGR_WIDGET_REMOVE_QUESTION); ?></p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-lg" data-dismiss="modal"><?= system_showText(LANG_SITEMGR_CANCEL); ?></button>
                <button type="button" class="btn btn-danger btn-lg confirmRemoval"><?= system_showText(LANG_SITEMGR_YESCONTINUE); ?></button>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->
