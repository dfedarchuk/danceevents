<?php

$sliderId = $r ? $r : $sliders[$i]->getId();

if ($sliders[$i]->getImagePath()) {
    $image = <<<HTML
<img src="{$sliders[$i]->getImagePath()}" alt="eDirectory"/>
HTML;
} else {
    $image = '&nbsp';
}

if ($sliders[$i]->getTitle()) {
    $sliderTitle = $sliders[$i]->getTitle();
} else {
    $sliderTitle = '&nbsp';
}

$sliderHtml .= <<<HTML
<li id="li$sliderId" class="col5 col-sm-6 slideLi">
    <input type="hidden" name="orderId" value="$sliderId">
    <h5>$sliderTitle</h5>
    <div class="row">
        <div class="col-md-2">
            <i class="fa fa-bars" aria-hidden="true"></i>
        </div>
            <div class="col-md-8 click-area" data-divid="$sliderId">
                <a class="thumbnail add-new" href="#" tabindex="">
                    $image
                </a>
            </div>
        <div class="col-md-2">
            <a class="sortable-remove removeSlide" href="javascript:void(0)" data-slideid="$sliderId" title="Remove" tabindex="">
                <i class="fa fa-trash" aria-hidden="true"></i>
            </a>
        </div>
    </div>
</li>
HTML;
