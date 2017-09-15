<?php

namespace ArcaSolutions\BannersBundle\Entity\Helpers;

class BannerType
{
    const LEADERBOARD     = 1;
    const LARGE_MOBILE    = 2;
    const SQUARE          = 3;
    const WIDE_SKYSCRAPER = 4;
    const SPONSORED_LINKS = 50;

    const EXPIRATION_BY_IMPRESSION = 1;
    const EXPIRATION_BY_DATE = 2;

    const TARGET_REDIRECT = 1;
    const TARGET_NEW = 2;

    const SHOWTYPE_IMAGE = 0;
    const SHOWTYPE_SCRIPT = 1;
}
