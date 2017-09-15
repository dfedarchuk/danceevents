<div id="<?= $i ?>">

    <a class="add-plus-circle-widget btn-new-widget"> </a>

    <div class="edit-widget row">
        <div class="edit-info hide" data-modaltype="<?= $widgetModal ?>" data-pagewidget="<?= $pageWidgetId ?>"
             data-widgetid="<?= $widgetId ?>" data-title="<?= $widgetTitleImg ?>" data-type="<?= $widgetType ?>"></div>
        <input type="hidden" name="widgetId" value="<?= $widgetId ?>">
        <input type="hidden" id="pageWidgetIdInput" name="pageWidgetId" value="<?= $pageWidgetId ?>">
        <div class="col-md-3 text-left">
            <h4><?= $widgetTitle ?></h4>
        </div>
        <div class="col-md-6">
            <div class="edit-hover">
            <?php if ($widgetModal) { ?>
                <a href="/includes/modals/widget/<?=$widgetModal?>.php" class="editWidgetButton"
                   data-divid="<?= $i ?>" data-toggle="modal" data-target="#" data-modal="<?= $widgetModal ?>">
                    <? } ?>
                    <? $imgPath = "../../assets/img/widget-placeholder/".EDIR_THEME."/".system_generateFriendlyURL($widgetTitleImg).".jpg";
                        if (!file_exists(EDIRECTORY_ROOT."/".SITEMGR_ALIAS."/assets/img/widget-placeholder/".EDIR_THEME."/".system_generateFriendlyURL($widgetTitleImg).".jpg")){
                            $imgPath = "../../assets/img/widget-placeholder/".EDIR_THEME."/custom-content.jpg";
                        } ?>
                    <img
                        src="<?= $imgPath ?>"/>
                    <?php if ($widgetModal) { ?>
                </a>
            <? } ?>
            </div>
        </div>
        <div class="col-md-2">
        </div>
        <div class="col-md-1 text-right">
            <i class="fa fa-bars" aria-hidden="true"></i>
            <?php if ($widgetModal) { ?>
                <a href="/includes/code/widgetActionAjax.php" class="editWidgetButton"
                   data-divid="<?= $i ?>" data-toggle="modal" data-target="#" data-modal="<?= $widgetModal ?>" >
                    <i class="fa fa-pencil" aria-hidden="true"></i>
                </a>
            <?php } ?>
            <a href="#" class="removeWidgetButton"
               data-divid="<?= $i ?>" data-toggle="modal" data-target="#remove-widget-modal">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</div>
