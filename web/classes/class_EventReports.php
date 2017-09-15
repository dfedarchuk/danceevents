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
# * FILE: /classes/class_EventReports.php
# ----------------------------------------------------------------------------------------------------

class EventReports extends BaseReport
{
    public function __construct($item)
    {
        parent::__construct($item);

        $this->itemField = "event_id";
        $this->dayTable = "Report_Event";
        $this->monthTable = "Report_Event_Daily";
        $this->monthlyTable = "Report_Event_Monthly";

        $levelObj = new EventLevel();
        $array_fields = system_getFormFields('event', $this->item->getNumber("level"));

        $this->reportDictionary = [
            "detail_view"  => [
                "property" => &$this->detail,
                "color"    => "39,174,96",
                "label"    => system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW),
                "enabled"  => $array_fields && ($levelObj && $levelObj->getDetail($this->item->getNumber("level")) == "y")
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
