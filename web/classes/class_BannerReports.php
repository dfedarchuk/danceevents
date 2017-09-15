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
# * FILE: /classes/class_BannerReports.php
# ----------------------------------------------------------------------------------------------------

class BannerReports extends BaseReport
{
    protected $click;
    protected $view;

    public function __construct($item)
    {
        parent::__construct($item);

        $this->itemField = "banner_id";
        $this->dayTable = "Report_Banner";
        $this->monthTable = "Report_Banner_Daily";
        $this->monthlyTable = "Report_Banner_Monthly";

        /* These maps each id to its corresponding property in this object */
        $this->reportTypeDictionary = [
            1 => &$this->click,
            2 => &$this->view,
        ];

        $this->reportDictionary = [
            "click_thru" => [
                "property" => &$this->click,
                "color"    => "51,181,229",
                "label"    => system_showText(LANG_LABEL_WEBSITEVIEWS),
                "enabled"  => true
            ],
            "email_sent" => [
                "property" => &$this->view,
                "color"    => "39,174,96",
                "label"    => system_showText(LANG_LABEL_TOTALVIEWERS),
                "enabled"  => true
            ]
        ];
    }

    /**
     * Gathers click and view data from this month's days and orders by Year and Month
     *
     * @param $table
     * @param DateTime $startDate
     * @param DateTime $endDate
     * @param bool $dayAndMonth
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

        $sql = <<<SQL
    SELECT
        {$functions[0]}(`day`) AS 'block',
        {$functions[1]}(`day`) AS 'unit',
        SUM(`click_thru`)      AS 'click',
        SUM(`view`)            AS 'view'
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
        $this->click[$resultObject->block][$resultObject->unit] += $resultObject->click;
        $this->view[$resultObject->block][$resultObject->unit] += $resultObject->view;
    }

}
