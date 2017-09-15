<?php

abstract class BaseReport
{
    protected $summary = [];
    protected $detail = [];

    /**
     * Stores the field name to be used when retrieving data from the Current Day, Daily and Monthly tables
     * @var string
     */
    protected $itemField;

    /**
     * The current day report storage table
     * @var string
     */
    protected $dayTable;
    /**
     * The current month report storage table
     * @var string
     */
    protected $monthTable;
    /**
     * The monthly report storage table
     * @var string
     */
    protected $monthlyTable;

    /**
     * The number of initial reports to be shown
     * @var int
     */
    protected $initialReportNumber = 2;

    /**
     * This function will attempt the following:
     *
     * If $date is already a DateTime instance, do nothing.
     * If $date is a string, convert to a DateTime instance.
     * return null otherwise.
     *
     * @param string $date
     * @return \DateTime
     */
    public static function convertToDateTime($date)
    {
        $return = null;

        if (is_a($date, 'DateTime')) {
            $return = $date;
        } elseif (is_string($date)) {
            try {
                $return = new DateTime($date);
            } catch (Exception $exc) {
            }
        }

        return $return;
    }

    /**
     * A address dictionary for the instance properties where the Key is the report_type value from the database
     * and the value is the address of the instance's associated property.
     * @var array
     */
    protected $reportTypeDictionary;

    /**
     * A dictionary containing information for each type of report. The structure is as follows:
     *
     *  "click_thru"   => array(
     *          "property" => &$this->click, // Instance property address
     *          "color"    => "51,181,229",  // RGB color string
     *          "label"    => system_showText(LANG_LABEL_WEBSITEVIEWS),
     *          "enabled"  => $array_fields && ( in_array( "url"  , $array_fields ) )
     *      )
     *
     * @var array
     */
    protected $reportDictionary;

    /**
     * This stores an isntance of the object being handled by the class. Can be a listing, event, etc...
     * @var mixed
     */
    protected $item;

    public function __construct($item)
    {
        $this->item = $item;

        /* These maps each id to its corresponding property in this object */
        $this->reportTypeDictionary = [
            1 => &$this->summary,
            2 => &$this->detail,
        ];

    }

    /**
     * Retrieves report data from the current day
     *
     * If $startDate is not provided, the item creation date will be used instead
     * If $endDate is not provided, the current date will be used instead
     *
     * @param DateTime|string $startDate SQL formatted date Y-m-d
     * @param DateTime|string $endDate SQL formatted date Y-m-d
     * @param bool $dayAndMonth Will use Day and Month as array keys instead of Month and Year
     */
    public function retrieveDay($startDate = null, $endDate = null, $dayAndMonth = false)
    {
        $timeRangeClause = "";
        $database = DatabaseHandler::getDomainConnection();

        if ($startDate || $endDate) {
            $this->getDateSpan($startDate, $endDate);
            $timeRangeClause = "( DATE( `date` ) BETWEEN '{$startDate->format("Y-m-d")}' AND '{$endDate->format("Y-m-d")}' ) AND ";
        }

        $functions = $dayAndMonth ? ["MONTH", "DAY"] : ["YEAR", "MONTH"];

        $sql = <<<SQL
    SELECT
        {$functions[0]}(`date`) AS 'block',
        {$functions[1]}(`date`) AS 'unit',
        SUM(`report_amount`)    AS 'amount',
        `report_type`           AS 'type'
    FROM `{$this->dayTable}`
    WHERE
        {$timeRangeClause}
        `{$this->itemField}` = :itemId
    GROUP BY `block`, `unit`, `type`
SQL;

        $statement = $database->prepare($sql);

        if ($statement->execute(["itemId" => $this->item->getNumber("id")])) {

            while ($info = $statement->fetchObject()) {
                if (array_key_exists($info->type, $this->reportTypeDictionary)) {
                    $this->reportTypeDictionary[$info->type][$info->block][$info->unit] += $info->amount;
                }
            }
        }
    }

    public function retrieveDaily($startDate = null, $endDate = null, $dayAndMonth = false)
    {
        $this->retrieve($this->monthTable, $startDate, $endDate, $dayAndMonth);
    }


    public function retrieveMonth($startDate = null, $endDate = null, $dayAndMonth = false)
    {
        $this->getDateSpan($startDate, $endDate);

        /* @var $startDate \DateTime */
        /* @var $endDate \DateTime */

        $this->retrieve($this->monthlyTable, $startDate->format("Y-m-1"), $endDate->format("Y-m-t"), $dayAndMonth);
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
        SUM(`summary_view`)    AS 'summary',
        SUM(`detail_view`)     AS 'detail'
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
        $this->detail[$resultObject->block][$resultObject->unit] += $resultObject->detail;
        $this->summary[$resultObject->block][$resultObject->unit] += $resultObject->summary;
    }

    /**
     * Retrieve report data from all report tables of this module in the specified date range.
     *
     * If $startDate is not provided, the item creation date will be used instead
     * If $endDate is not provided, the current date will be used instead
     *
     * @param DateTime $startDate SQL formatted date Y-m-d
     * @param DateTime $endDate SQL formatted date Y-m-d
     */
    public function retrieveAllData($startDate = null, $endDate = null)
    {
        $this->retrieveDay($startDate, $endDate);
        $this->retrieveDaily($startDate, $endDate);
        $this->retrieveMonth($startDate, $endDate);
    }

    /**
     * Compiles instance data into a formatted array to be used with the Javascript generation function..
     *
     * @param string $startDate SQL formatted date Y-m-d
     * @param string $endDate SQL formatted date Y-m-d
     * @return array
     */
    public function compileData($startDate = null, $endDate = null)
    {
        $this->getDateSpan($startDate, $endDate);

        $minMonth = (int)$startDate->format('m');
        $minYear = (int)$startDate->format('Y');

        $maxMonth = (int)$endDate->format('m');
        $maxYear = (int)$endDate->format('Y');

        if ($minYear == $maxYear && $minMonth == $maxMonth) {
            return $this->compileDailyData();
        } else {
            return $this->compileMonthData($startDate, $endDate);
        }
    }

    /**
     * Compiles data gathered from the current month table into a Month->Day data format
     *
     * @param mixed $startDate
     * @param mixed $endDate
     * @param int $divisions
     * @return array
     */
    public function compileDailyData($startDate = null, $endDate = null, $divisions = 10)
    {
        $this->getDateSpan($startDate, $endDate);

        $this->retrieveDay($startDate, $endDate, true);
        $this->retrieveDaily($startDate, $endDate, true);

        $minDay = (int)$startDate->format('d');
        $maxDay = (int)$endDate->format('d');

        $month = (int)$startDate->format('m');
        $monthNames = explode(",", LANG_DATE_MONTHS);

        $data = null;
        $iteration = 0;
        $data['maximumValue'] = 0;

        $dayInterval = max([($maxDay - $minDay) / $divisions, 1]);

        /* Organize data */
        foreach ($this->reportDictionary as $property => $settings) {
            if ($settings['enabled']) {
                $data[$property]['label'] = $settings['label'];
                $data[$property]['color'] = $settings['color'];

                $value = 0;

                for ($day = 0; $minDay + $day <= $maxDay; $day++) {
                    $value += (empty($settings['property'][$month][$minDay + $day]) ? 0 : $settings['property'][$month][$minDay + $day]);

                    if ($day % $dayInterval == 0) {
                        !$iteration && $data["labels"][] = ($minDay + $day) . " - " . ucfirst(string_substr($monthNames[$month - 1],
                                0, 3));
                        $data['graphs'][$property]['data'][] = $value;

                        /* Gather the maximum value from the initial reports in order to show a properly sized graph */
                        if ($iteration < $this->initialReportNumber && $data['maximumValue'] < $value) {
                            $data['maximumValue'] = $value;
                        }

                        $value = 0;
                    }
                }
                $iteration++;
            }

        }

        return $data;
    }

    /**
     * Compiles instance data into a formatted array to be used with the Javascript generation function..
     *
     * @param string $startDate SQL formatted date Y-m-d
     * @param string $endDate SQL formatted date Y-m-d
     * @return array
     */
    public function compileMonthData($startDate = null, $endDate = null)
    {
        $this->getDateSpan($startDate, $endDate);
        $this->retrieveAllData($startDate, $endDate);

        $minMonth = (int)$startDate->format('m');
        $minYear = (int)$startDate->format('Y');

        $maxMonth = (int)$endDate->format('m');
        $maxYear = (int)$endDate->format('Y');

        $monthNames = explode(",", LANG_DATE_MONTHS);

        $data = null;
        $iteration = 0;
        $data['maximumValue'] = 0;

        /* Organize data */
        foreach ($this->reportDictionary as $property => $settings) {
            if ($settings['enabled']) {
                $data[$property]['label'] = $settings['label'];
                $data[$property]['color'] = $settings['color'];

                for ($year = $minYear; $year <= $maxYear; $year++) {
                    $monthStart = ($year == $minYear ? $minMonth : 1);
                    $monthLimit = ($year == $maxYear ? $maxMonth : 12);

                    for ($month = $monthStart; $month <= $monthLimit; $month++) {
                        /* Fills out the month labels array. First iteration only. */
                        $iteration or $data["labels"][] = ucfirst(string_substr($monthNames[$month - 1], 0, 3)) . " / " . ($minYear == $maxYear ? "" : $year);

                        $value = ($settings['property'][$year][$month] ? $settings['property'][$year][$month] : 0);

                        $data['graphs'][$property]['data'][] = $value;

                        /* Gather the maximum value from the initial reports in order to show a properly sized graph */
                        if ($iteration < $this->initialReportNumber && $data['maximumValue'] < $value) {
                            $data['maximumValue'] = $value;
                        }
                    }
                }
                $iteration++;
            }
        }

        return $data;
    }

    /**
     * Feeds Javascript code representing the $data sent as parameter into the JavaScriptHandler class
     *
     * If no argument is provided for the $data parameter, it will be automatically generated from this instance
     * since it's creation to the present day.
     *
     * @param array $data a $data array representing this instance generated by the compileData function
     * @return string
     */
    public function getJavascript($data = null)
    {
        $data or $data = $this->compileData();

        $chartLabels = json_encode($data["labels"]);
        $initialReports = "[ " . implode(", ",
                array_slice(array_keys($data['graphs']), 0, $this->initialReportNumber)) . " ]";

        $js = "";

        foreach ($data['graphs'] as $name => $report) {
            if ($report["data"]) {
                $joinedData = json_encode($report["data"]);

                $js .= "
                        var {$name} = {
                                fillColor        : \"rgba({$this->reportDictionary[$name]['color']},0.1)\",
                                strokeColor      : \"rgba({$this->reportDictionary[$name]['color']},0.3)\",
                                pointColor       : \"rgba({$this->reportDictionary[$name]['color']},1)\",
                                pointStrokeColor : \"#fff\",
                                data : {$joinedData}
                            };
                    ";
            }
        }

        $js .= "
                var chartLabels      = {$chartLabels};
                var initialReport    = {$initialReports};
                var maxInitialReport = {$data['maximumValue']};
            ";

        return $js;
    }

    /**
     * This function will convert entered dates to DateTime instances.
     *
     * In case &$startdate is missing, we'll use the item entry date.
     * In case &$endDate is missing, we'll use the current day.
     *
     * @param mixed &$startDate
     * @param mixed &$endDate
     */
    public function getDateSpan(&$startDate, &$endDate)
    {
        $startDate = self::convertToDateTime($startDate);
        $creationDate = self::convertToDateTime($this->item->getString("entered"));

        /* There's no need to show months prior to the creation date. */
        $startDate > $creationDate or $startDate = $creationDate;

        $endDate = self::convertToDateTime($endDate) or $endDate = new DateTime();
    }

    /**
     * Uses $data parameter to determine all HTML required to display the graphs properly
     * @param mixed $data
     */
    public function renderGraphs($data)
    {
        if($data["maximumValue"] and $firstGraph = reset($data["graphs"]) and count($firstGraph["data"]) > 1){
            $graphs = array_keys($data['graphs']);
            $i = 0;

            ?>
            <section class="stats-complete">

                <h2><?= system_showText(LANG_LABEL_STATISTICS); ?></h2>

                <div class="chart-legends">

                    <div class="hidden-legends <?= (count($graphs) <= $this->initialReportNumber ? "hidden-desktop" : "") ?>">

                        <span><?= system_showText(LANG_LABEL_VIEW_MORE_STATS) ?> &raquo;</span>
                        <ul id="optionLegend">

                            <? foreach ($graphs as $name) { ?>

                                <li class="legend-<?= ++$i ?> <?= ($i < $this->initialReportNumber ? "isvisible" : "") ?>" report="<?= $name ?>" onclick="selectLegend('select', <?= $i ?>, <?= $name ?>)">
                                    <i <?= ($i <= $this->initialReportNumber ? "class=\"checked\"" : "") ?>></i>
                                    <b style="background-color: rgb(<?= $this->reportDictionary[$name]['color'] ?>)"></b>
                                    <?= $this->reportDictionary[$name]['label'] ?>
                                </li>

                            <? } ?>

                            <? if (count($graphs) > $this->initialReportNumber) { ?>

                                <li class="legend-ALL" onclick="selectLegend('viewALL', <?= $i; ?>)">
                                    <i></i>
                                    <b></b>
                                    <?= system_showText(LANG_LABEL_VIEW_ALL) ?>
                                </li>

                            <? } ?>
                        </ul>
                    </div>

                    <ul id="controlLegend">
                        <li class="legend-1 isvisible" <?= (count($graphs) > $this->initialReportNumber ? "onclick=\"selectLegend('select', 1, " . $graphs[0] . ")\"" : "") ?>>
                            <i class="checked"></i>
                            <b style="background-color: rgb(<?= $this->reportDictionary[$graphs[0]]['color'] ?>)"></b>
                            <?= $this->reportDictionary[$graphs[0]]['label'] ?>
                        </li>

                        <li class="legend-2 isvisible" <?= (count($graphs) > $this->initialReportNumber ? "onclick=\"selectLegend('select', 2, " . $graphs[1] . ")\"" : "") ?>>
                            <i class="checked"></i>
                            <b style="background-color: rgb(<?= $this->reportDictionary[$graphs[1]]['color'] ?>)"></b>
                            <?= $this->reportDictionary[$graphs[1]]['label'] ?>
                        </li>
                    </ul>
                </div>

                <canvas id="myChart" width="705" height="200"></canvas>
            </section>
            <?
        }

    }

    /**
     * @return mixed
     */
    public function getSummary()
    {
        return $this->summary;
    }

    /**
     * @return mixed
     */
    public function getDetail()
    {
        return $this->detail;
    }
}
