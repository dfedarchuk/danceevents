<?php

$sliderId = $r ? $r : $sliders[$i]->getId();
$openWindow = $sliders[$i]->getTarget() == "self" ? '' : 'checked=checked';
setting_get("sitemgr_language", $sitemgr_language);
$sitemgrLanguage = substr($sitemgr_language, 0, 2);

if ($sliders[$i]->getImagePath()) {
    $image = <<<HTML
<div class="edit-hover">
    <a href="#" class="sliderImageButton" data-imageinput="$sliderId" tabindex="">
        <img src="{$sliders[$i]->getImagePath()}" alt="{$sliders[$i]->getTitle()}" id="imgSlider$sliderId">
    </a>
</div>
HTML;
} else {
    $image = <<<HTML
<div class="new">
    <a class="thumbnail add-new sliderImageButton" data-imageinput="$sliderId" href="#" tabindex="">
        <div class="caption">
            <h6><i class="fa fa-plus-circle" aria-hidden="true"></i > {$translator->trans('Upload Image', [],
        'widgets', /** @Ignore */
        $sitemgrLanguage)}</h6 >
        </div >
    </a>
</div>
HTML;
}

$sliderInfoHtml .= <<<HTML
<div id="sliderInfo$sliderId" class="row sliderInfo" style="display: none">
<form method="post" name="form_sliderInfo$sliderId" id="form_sliderInfo$sliderId">
    <input type="hidden" name="slideId" value="$sliderId">
    <input type="hidden" name="imageId" id="imageId$sliderId" value="{$sliders[$i]->getImageId()}">
    <div class="col-md-6 ">
        <div class="form-group">
            <label for="idx_title_$sliderId" class="control-label">{$translator->trans('Title', [], 'widgets',
    /** @Ignore */
    $sitemgrLanguage)}</label>
            <input type="text" class="form-control" id="idx_title_$sliderId" name="title" placeholder="" value="{$sliders[$i]->getTitle()}">
        </div>
        <div class="form-group">
            <label for="idx_summary_$sliderId" class="control-label">{$translator->trans('Summary Description', [],
    'widgets', /** @Ignore */
    $sitemgrLanguage)}</label>
            <textarea class="form-control" id="idx_summary_$sliderId" name="summary" rows="5" placeholder="">{$sliders[$i]->getSummary()}</textarea>
        </div>
        <div class="form-group">
            <label for="idx_link_$sliderId" class="control-label">{$translator->trans('Link', [], 'widgets',
    /** @Ignore */
    $sitemgrLanguage)}</label>
            <input type="text" class="form-control sliderLink" id="idx_link_$sliderId" name="link" placeholder="" value="{$sliders[$i]->getLink()}">
        </div>
        <div class="form-group">
            <div class="checkbox">
                <label for="idx_window_$sliderId" class="control-label">
                    <input class="required" type="checkbox" value="1" name="openWindow" id="idx_window_$sliderId" $openWindow>
                    {$translator->trans('Open in a new window', [], 'widgets', /** @Ignore */
    $sitemgrLanguage)}
                </label>
            </div>
        </div>
    </div>
</form>
<div class="col-md-6">
    <div class="form-thumbnails">
        <div class="upload-logo">
            <form id="form_slider_$sliderId">
                <input type="file" class="hide" id="slideImage$sliderId" name="slideImage" data-slider="$sliderId" onChange="saveSlider(this);">
            </form>
            <div id="image-background$sliderId" class="img-background text-center">
                $image
            </div>
            <p>
                <small class="help-block">{$translator->trans('We recommend using an image that is %dimension% px to cover the entire site, and account for larger screen sizes. Please make sure images are at least 1200 pixels wide and keep roughly the same aspect ratio.',
    ['%dimension%' => IMAGE_THEME_BACKGROUND_W." x ".IMAGE_THEME_BACKGROUND_H], 'widgets', /** @Ignore */
    $sitemgrLanguage)}</small>
            </p>
        </div>
    </div>
</div>
</div>

HTML;
