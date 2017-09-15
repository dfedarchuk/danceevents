<?php

/*==================================================================*\
######################################################################
#                                                                    #
# Copyright 2015 Arca Solutions, Inc. All Rights Reserved.           #
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
# * FILE: /frontend/footer_menu.php
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$items = $container->get('navigation.handler')->getFooter();
$router = $container->get('router');
?>

<ul class="<?=($ulClass ? "$ulClass" : "list-unstyled")?>">
    <?
    if($items) foreach ($items as $item) {
        if ($item->getCustom() == 'n' and strpos($item->getLink(), '/') !== true) {
            $link = $router->generate($item->getLink());
        } else {
            $link = $item->getLink();
        }
        ?>
        <li class="<?=($liClass ? "$liClass" : "")?>">
            <a href="<?= $link ?>">
                <?= $item->getLabel(); ?>
            </a>
        </li>
    <? } ?>
</ul>
