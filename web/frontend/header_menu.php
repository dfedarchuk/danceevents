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
# * FILE: /frontend/header_menu.php
# ----------------------------------------------------------------------------------------------------
$container = SymfonyCore::getContainer();
$items = $container->get('navigation.handler')->getHeader();
$router = $container->get('router');

if (!$skipUL) { ?>

<ul class="nav navbar-nav navbar-right">
    <?php }
    if($items) foreach ($items as $item) {
        if ($item->getCustom() == 'n' and strpos($item->getLink(), '/') !== true) {
            $link = $router->generate($item->getLink());
        } else {
            $link = $item->getLink();
        }
        ?>
        <li>
            <a href="<?= $link ?>">
                <?= $item->getLabel(); ?>
            </a>
        </li>
    <?php }

    if (!$skipUL) { ?>
</ul>

<? }
