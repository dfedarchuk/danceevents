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
# * FILE: /classes/class_ListingReports.php
# ----------------------------------------------------------------------------------------------------

class ListingReports extends BaseReport
{
    protected $summary = [];
    protected $detail = [];
    protected $click = [];
    protected $email = [];
    protected $phone = [];
    protected $fax = [];
    protected $click_call = [];

    public function __construct($item)
    {
        parent::__construct($item);

        $this->itemField = "listing_id";
        $this->dayTable = "Report_Listing";
        $this->monthTable = "Report_Listing_Daily";
        $this->monthlyTable = "Report_Listing_Monthly";

        /* These maps each id to its corresponding property in this object */
        $this->reportTypeDictionary = [
            1 => &$this->summary,
            2 => &$this->detail,
            3 => &$this->click,
            4 => &$this->email,
            8 => &$this->click_call,
        ];

        $levelObj = new ListingLevel();
        $array_fields = system_getFormFields('listing', $this->item->getNumber("level"));

        $this->reportDictionary = [
            "click_thru"   => [
                "property" => &$this->click,
                "color"    => "51,181,229",
                "label"    => system_showText(LANG_LABEL_WEBSITEVIEWS),
                "enabled"  => $array_fields && (in_array("url", $array_fields))
            ],
            "click_call"   => [
                "property" => &$this->click_call,
                "color"    => "255,103,2",
                "label"    => system_showText(LANG_LABEL_CLICKTOCALL),
                "enabled"  => $array_fields && (TWILIO_APP_ENABLED == "on" && TWILIO_APP_ENABLED_CALL == "on" && in_array($this->item->getNumber("level"),
                            system_retrieveLevelsWithInfoEnabled("has_call")))
            ],
            "detail_view"  => [
                "property" => &$this->detail,
                "color"    => "39,174,96",
                "label"    => system_showText(LANG_LABEL_ADVERTISE_DETAILVIEW),
                "enabled"  => $array_fields && ($levelObj && $levelObj->getDetail($this->item->getNumber("level")) == "y")
            ],
            "email_sent"   => [
                "property" => &$this->email,
                "color"    => "106,176,222",
                "label"    => system_showText(LANG_LABEL_LEADS),
                "enabled"  => $array_fields && (in_array("email", $array_fields) || in_array("contact_email",
                            $array_fields))
            ],
            "summary_view" => [
                "property" => &$this->summary,
                "color"    => "211,84,0",
                "label"    => system_showText(LANG_LABEL_ADVERTISE_SUMMARYVIEW),
                "enabled"  => true
            ],
        ];

        if (REPORT_PHONE_FAX) {
            $this->reportTypeDictionary[5] = &$this->phone;
            $this->reportTypeDictionary[6] = &$this->fax;

            $this->reportDictionary["fax_view"] = [
                "property" => &$this->fax,
                "color"    => "217,83,79",
                "label"    => system_showText(LANG_LABEL_FAXVIEWS),
                "enabled"  => $array_fields && (in_array("fax", $array_fields))
            ];

            $this->reportDictionary["phone_view"] = [
                "property" => &$this->phone,
                "color"    => "26,188,156",
                "label"    => system_showText(LANG_LABEL_PHONEVIEWS),
                "enabled"  => $array_fields && (in_array("phone", $array_fields) || in_array("contact_phone",
                            $array_fields))
            ];
        }
    }

    /**
     * @inheritDoc
     */
    public function retrieve($table, $startDate = null, $endDate = null, $dayAndMonth = false)
    {
        $timeRangeClause = "";
        $database = DatabaseHandler::getDomainConnection();

        if ($startDate || $endDate) {
            $this->getDateSpan($startDate, $endDate);
            $timeRangeClause = "( DATE( `day` ) BETWEEN '{$startDate->format("Y-m-d")}' AND '{$endDate->format("Y-m-d")}' ) AND ";
        }

        $functions = $dayAndMonth ? ["MONTH", "DAY"] : ["YEAR", "MONTH"];

        $phoneFaxFields = REPORT_PHONE_FAX ? "SUM(`phone_view`)      AS 'phone',
        SUM(`fax_view`)        AS 'fax'," : "";

        $sql = <<<SQL
    SELECT
        {$functions[0]}(`day`) AS 'block',
        {$functions[1]}(`day`) AS 'unit',
        SUM(`summary_view`)    AS 'summary',
        SUM(`detail_view`)     AS 'detail',
        {$phoneFaxFields}
        SUM(`click_thru`)      AS 'click',
        SUM(`email_sent`)      AS 'email',
        SUM(`click_call`)      AS 'click_call'

    FROM {$table}
    WHERE
    {$timeRangeClause}
    `{$this->itemField}` = :itemId
    GROUP BY `block`, `unit`
SQL;

        $statement = $database->prepare($sql);

        if ($statement->execute(["itemId" => $this->item->getNumber("id")])) {

            while ($info = $statement->fetchObject()) {
                $this->fetchFromResults($info);
            }
        }
    }

    public function fetchFromResults($resultObject)
    {
        $this->summary[$resultObject->block][$resultObject->unit] += $resultObject->summary;
        $this->detail[$resultObject->block][$resultObject->unit] += $resultObject->detail;
        $this->click[$resultObject->block][$resultObject->unit] += $resultObject->click;
        $this->email[$resultObject->block][$resultObject->unit] += $resultObject->email;
        $this->click_call[$resultObject->block][$resultObject->unit] += $resultObject->click_call;

        if (REPORT_PHONE_FAX) {
            $this->phone[$resultObject->block][$resultObject->unit] += $resultObject->phone;
            $this->fax[$resultObject->block][$resultObject->unit] += $resultObject->fax;
        }
    }


}
