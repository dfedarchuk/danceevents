<?
/* ==================================================================*\
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
  \*================================================================== */

# ----------------------------------------------------------------------------------------------------
# * FILE: /classes/class_ArticleReports.php
# ----------------------------------------------------------------------------------------------------

class ArticleReports extends BaseReport
{
    public function __construct($item)
    {
        parent::__construct($item);

        $this->itemField = "article_id";
        $this->dayTable = "Report_Article";
        $this->monthTable = "Report_Article_Daily";
        $this->monthlyTable = "Report_Article_Monthly";

        $levelObj = new ArticleLevel();

        $this->reportDictionary = [
            "detail_view"  => [
                "property" => &$this->detail,
                "color"    => "39,174,96",
                "label"    => system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW),
                "enabled"  => $levelObj && $levelObj->getDetail($this->item->getNumber("level")) == "y"
            ],
            "summary_view" => [
                "property" => &$this->summary,
                "color"    => "211,84,0",
                "label"    => system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW),
                "enabled"  => true
            ],
        ];
    }
}
