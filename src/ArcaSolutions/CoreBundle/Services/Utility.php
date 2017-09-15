<?php

namespace ArcaSolutions\CoreBundle\Services;

use ArcaSolutions\SearchBundle\Entity\Filters\DistanceFilter;
use ArcaSolutions\SearchBundle\Services\ParameterHandler;
use ArcaSolutions\WebBundle\Entity\Content;
use Elastica\Document;
use Elastica\Result;
use Symfony\Component\DependencyInjection\ContainerInterface;

class Utility extends \Twig_Extension
{
    /*
     * This is a workaround to counter the '0000-00-00' date issue in DateTime.
     * The right thing to do here would be to change eDirectory's way of storing null dates from
     * 0000-00-00 to actually having NULL values.
    */
    const BAD_DATE_VALUE = "-0001-11-30";

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     * Filters everything matching the $regex rules from the $input string
     *
     * @param $input
     * @param $regex
     *
     * @return string
     */
    public static function regexFilter($input, $regex)
    {
        return preg_replace($regex, '', strval($input));
    }

    /**
     * Converts an array of string into a $delimiter separated string
     *
     * Example: ["red", "blue", "green"] -> "Red, Blue, Green"
     *
     * @param mixed $input
     * @param string $delimiter
     * @return string
     */
    public static function convertArrayToString($input, $delimiter = ",")
    {
        if (is_string($input)) {
            $return = $input;
        } elseif (is_array($input)) {
            $return = implode($delimiter, $input);
        } else {
            $return = (string)$input;
        }

        return $return;
    }

    /**
     * Transforms a string into a multidimensional array where each part
     * of the $inputString separated by the $separator character is a level
     * of the $outputArray, whose last level will be asigned the $value.
     *
     * Example:
     *
     * $inputString = "this.is.a.test"
     * $value = "Carolina"
     * $separator = "."
     *
     * Result:
     * $outputArray[this][is][a][test] = "Carolina"
     *
     * @param array $outputArray
     * @param string $inputString
     * @param mixed $value
     * @param string $separator
     */
    public static function assignArrayByPath(&$outputArray, $inputString, $value, $separator = ".")
    {
        $keys = explode($separator, $inputString);

        while ($key = array_shift($keys)) {
            $outputArray = &$outputArray[$key];
        }

        $outputArray = $value;
    }

    /**
     * Converts an array of string into a gramatically correct readable text.
     *
     * Example: ["red", "blue", "green"] -> "Red, Blue and Green"
     * Example: ["blue", "green"] -> "Blue and Green"
     * Example: ["green"] -> "Green"
     *
     * @param $array
     * @param string $and
     * @param string $comma
     * @param bool|true $capitalize
     * @return null|string
     */
    public function convertArrayToHumanReadableString($array, $and = null, $comma = ", ", $capitalize = false)
    {
        $return = null;

        if ($and === null) {
            $and = $this->container->get("translator")->trans("and");
        }

        if ($array) {
            $capitalize and $array = array_map("ucwords", $array);
            $lastPart = array_pop($array);

            if (count($array)) {
                $return = implode($comma, $array) . " {$and} {$lastPart}";
            } else {
                $return = $lastPart;
            }
        }

        return $return;
    }

    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'utility';
    }

    public function getFilters()
    {
        return [
            new \Twig_SimpleFilter(
                'regexFilter',
                [$this, 'regexFilter'],
                ['is_safe' => ['all']]
            )
        ];
    }

    /**
     * @return array
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'extractDataFromResult',
                [$this, 'extractDataFromResult']
            ),
            new \Twig_SimpleFunction(
                'parseDistanceUnit',
                [$this, 'parseDistanceUnit']
            ),
            new \Twig_SimpleFunction(
                'encrypt',
                [$this, 'encode']
            ),
            new \Twig_SimpleFunction(
                'convertToPaginationFormat',
                [$this, 'convertToPaginationFormat']
            ),
            new \Twig_SimpleFunction(
                'convertFromPaginationFormat',
                [$this, 'convertFromPaginationFormat']
            ),
            new \Twig_SimpleFunction(
                'utility_getLogoImage',
                [$this, 'getLogoImage']
            ),
            new \Twig_SimpleFunction(
                'utility_getNoImage',
                [$this, 'getNoImage'],
                ['needs_environment' => true, 'is_safe' => ['all']]
            ),
            new \Twig_SimpleFunction(
                'utility_getCurrentTheme',
                [$this, 'getCurrentTheme']
            ),
            new \Twig_SimpleFunction(
                'getLocationLevel',
                [$this, 'getLocationLevel']
            ),
            new \Twig_SimpleFunction(
                'utility_generateSearchUrl',
                [$this, 'generateSearchUrl']
            ),
            new \Twig_SimpleFunction(
                'generateSEOFromPage',
                [$this, 'generateSEOFromPage'],
                ['is_safe' => ['all']]
            ),
        ];
    }

    /**
     * Returns an array containing "lat" and "lon" keys with its associated values if they are defined in the
     * cookies. Otherwise returns null.
     * @return array|null
     */
    public function getGeoPointFromCookies()
    {
        $return = null;
        $request = $this->container->get("request_stack")->getCurrentRequest();

        if ($cookieGeoLocation = $request->cookies->get(DistanceFilter::getGeoLocationCookieName())) {
            $return = self::extractGeoPoint($cookieGeoLocation);
        }

        return $return;
    }

    /**
     * Extracts a geocordinate from an input string
     *
     * Returns an array containing 'lat' and 'lon' keys or null if input is invalid.
     *
     * @param string $userGeoLocation
     * @return array|null
     */
    public static function extractGeoPoint($userGeoLocation)
    {
        $return = null;

        if ($geoLocationParts = Utility::convertStringToArray($userGeoLocation) and count($geoLocationParts) == 2) {
            $return = [
                'lat' => $geoLocationParts[0],
                'lon' => $geoLocationParts[1]
            ];
        }

        return $return;
    }

    /**
     * Breaks a string into parts separated by the $delimiter and returns an array containing these parts
     *
     * Example: "Red, Blue, Green" -> ["Red", "Blue", "Green"]
     *
     * @param mixed $input
     * @param string $delimiter
     * @return array
     */
    public static function convertStringToArray($input, $delimiter = ",")
    {
        if (is_array($input)) {
            $return = $input;
        } elseif (is_string($input)) {
            $return = explode($delimiter, $input);
        } else {
            $return = (array)$input;
        }

        return $return;
    }

    /**
     * Extracts data from a result taking into consideration the variations caused by scripted_fields
     *
     * @param Result|Document $result
     *
     * @return array|mixed
     */
    public function extractDataFromResult($result)
    {
        $data = $result->getData();

        return isset($data['scriptedFieldData']) ? reset($data['scriptedFieldData']) : $data;
    }

    /**
     * Converts a $distance from Kilometers to Miles if the configured unit is miles.
     * Returns a string containing the converted (or not) $distance concatenated with its unit
     *
     * Important: The input($distance) MUST be in kilometers.
     *
     * @param $distance
     *
     * @return string
     */
    public function parseDistanceUnit($distance)
    {
        $translator = $this->container->get("translator");

        $distanceUnit = $translator->trans("distance.unit", [], "units");
        $thousandsSeparator = $translator->trans("thousands.separator", [], "units");
        $decimalSeparator = $translator->trans("decimal.separator", [], "units");

        switch ($distanceUnit) {
            case "mi":
                $distance *= 0.621371;
                break;
        }

        $distance = number_format($distance, 2, $decimalSeparator, $thousandsSeparator);

        return "{$distance} {$distanceUnit}";
    }

    public function encode($string)
    {
        return $this->container->get("url_encryption")->encrypt(json_encode($string));
    }

    /**
     * 10 => p:10
     * @param $value
     * @return string
     */
    public function convertToPaginationFormat($value)
    {
        return $this->container->get("search.engine")->convertToPaginationFormat($value);
    }

    /**
     * p:10 => 10
     * @param $value
     * @return int
     */
    public function convertFromPaginationFormat($value)
    {
        return $this->container->get("search.engine")->convertFromPaginationFormat($value);
    }

    /**
     * Returns a full url to the noimage image and its related HTML code
     * @param \Twig_Environment $twig_Environment
     * @param string $title The image's alt attribute text
     * @return string
     */
    public function getNoImage(\Twig_Environment $twig_Environment, $title = null)
    {
        $title or $title = $this->container->get("multi_domain.information")->getTitle();
        $assets = $this->container->get("templating.helper.assets");

        $noImageImage = $assets->getUrl("noimage.gif", "domain_content");

        if (!file_exists(preg_replace("/^[\\/\\\\]+/", "", $noImageImage))) {
            $noImageImage = $this->getLogoImage();
        }

        return $twig_Environment->render(
            "::blocks/noimage.html.twig",
            [
                "noImageImage" => $noImageImage,
                "title"        => $title,
            ]
        );
    }

    /**
     * Returns a full url to the logo image
     * @param bool $fullPath
     * @return string
     */
    public function getLogoImage($fullPath = false)
    {
        $assets = $this->container->get("templating.helper.assets");
        $logoImg = $assets->getUrl("img_logo.png", "domain_content");

        if (!file_exists(preg_replace("/^[\\/\\\\]+/", "", $logoImg))) {
            $logoImg = $assets->getUrl("img_logo.png", "assets_images");
        }

        if ($fullPath) {
            $logoImg = $this->container->get("request_stack")->getCurrentRequest()->getSchemeAndHttpHost() . $logoImg;
        }

        return $logoImg;
    }

    /**
     * Returns the the current theme's name
     * @return string
     */
    public function getCurrentTheme()
    {
        return $this->container->get('liip_theme.active_theme')->getName();
    }

    /**
     * Removes $folder and everything within
     * @param $folder
     */
    public function removeFolderRecursive($folder)
    {
        if (file_exists($folder) && is_dir($folder)) {
            $it = new \RecursiveDirectoryIterator($folder, \RecursiveDirectoryIterator::SKIP_DOTS);
            $files = new \RecursiveIteratorIterator($it, \RecursiveIteratorIterator::CHILD_FIRST);

            foreach ($files as $file) {
                if ($file->isDir()) {
                    @rmdir($file->getRealPath());
                } else {
                    @unlink($file->getRealPath());
                }
            }

            rmdir($folder);
        }
    }

    /**
     * Copies the entire $source folder into $destination
     * @param $source
     * @param $destination
     */
    public function copyFolderRecursive($source, $destination)
    {
        file_exists($destination) or mkdir($destination);

        $files = new \RecursiveDirectoryIterator($source, \RecursiveDirectoryIterator::SKIP_DOTS);

        /* @var $file \SplFileInfo */
        foreach ($files as $file) {
            if ($file->isDir()) {
                $this->copyFolderRecursive($file->getRealPath(),
                    $destination . DIRECTORY_SEPARATOR . $file->getBasename());
            } else {
                copy($file->getRealPath(), $destination . DIRECTORY_SEPARATOR . $file->getBasename());
            }
        }
    }

    public function getLocationLevel()
    {
        return $this->container->get('location.service')->getLocationsEnabled(true);
    }

    /**
     * Returns the user defined alias for a certain $module
     * @param $module
     * @return null|string
     */
    public function getModuleAlias($module)
    {
        return $this->container->get("search.engine")->getModuleAlias($module);
    }

    /**
     * Generates a search url based on the passed parameters.
     *
     * @param string[] $keywords
     * @param string[] $modules
     * @param array $categoryFriendlyUrls
     * @param array $locationFriendlyUrls
     * @param string $startDate MUST follow the MySQL format (Y-m-d)
     * @param string $endDate MUST follow the MySQL format (Y-m-d)
     * @return string
     */
    public function generateSearchUrl(
        $keywords = [],
        $modules = [],
        $categoryFriendlyUrls = [],
        $locationFriendlyUrls = [],
        $startDate = null,
        $endDate = null
    ) {
        $parameterHandler = new ParameterHandler($this->container, false);

        $overridingParameters = [];

        if ($keywords = (array)$keywords) {
            while ($keyword = array_pop($keywords)) {
                $parameterHandler->addKeyword($keyword);
            }
        }

        if ($modules = (array)$modules) {
            while ($module = array_pop($modules)) {
                $parameterHandler->addModule($module);
            }
        }

        if ($categoryFriendlyUrls = (array)$categoryFriendlyUrls) {
            $overridingParameters[ParameterHandler::SLUG_CATEGORY] = $categoryFriendlyUrls;
        }

        if ($locationFriendlyUrls = (array)$locationFriendlyUrls) {
            $overridingParameters[ParameterHandler::SLUG_LOCATION] = $locationFriendlyUrls;
        }

        if ($startDate and $startDate = \DateTime::createFromFormat("Y-m-d", $startDate)) {
            $parameterHandler->setStartDate($startDate);
        }

        if ($endDate and $endDate = \DateTime::createFromFormat("Y-m-d", $endDate)) {
            $parameterHandler->setEndDate($endDate);
        }

        return $parameterHandler->buildUrl(1, $overridingParameters);
    }

    /**
     * @return bool
     */
    public function isRobotUser()
    {
        $return = false;

        if ($ips = (array)$this->container->get("request_stack")->getCurrentRequest()->getClientIps()) {
            while ($ip = array_pop($ips)) {
                $wildcardedIps[] = $ip;
                $wildcardedIps[] = preg_replace("/(\d+\.\d+\.\d+\.)(\d+)/", "$1*", $ip);
                $wildcardedIps[] = preg_replace("/(\d+\.\d+\.)(\d+\.\d+)/", "$1*.*", $ip);
                $wildcardedIps[] = preg_replace("/(\d+\.)(\d+\.\d+\.\d+)/", "$1*.*.*", $ip);
            }

            $result = $this->container->get("doctrine")->getRepository("CoreBundle:Robotsfilter", "main")->findBy(["value" => $wildcardedIps]);
            $return = !empty($result);
        }

        return $return;
    }

    /**
     * Generates SEO information from a given page title/keywords/description
     *
     * @param null $title
     * @param null $description
     * @param null $keywords
     * @return string
     * @internal param Content $content
     * @internal param null $backupTitle
     *
     */
    public function generateSEOFromPage($title = null, $description = null, $keywords = null)
    {
        if ($title) {
            $title = $this->container->get("translator")->trans(
                "%pageTitle% | %directoryTitle%",
                [
                    "%pageTitle%"      => $title,
                    "%directoryTitle%" => $this->container->get("multi_domain.information")->getTitle()
                ]
            );
        } else {
            $title = $this->container->get("multi_domain.information")->getTitle();
        }

        $settings = $this->container->get("settings");
        $domain_info = $this->container->get('multi_domain.information');
        $url = $this->container->get("request_stack")->getCurrentRequest()->getUri();
        $image = $this->container->get('utility')->getLogoImage(true);

        $schema = [
            "@type"     => "Organization",
            'url'       => $url,
            'logo'      => $image,
            'name'      => $domain_info->getTitle(),
            'telephone' => $settings->getDomainSetting('contact_phone'),
            'address'   => [
                "@type"           => "PostalAddress",
                'streetAddress'   => $settings->getDomainSetting('contact_address'),
                'postalCode'      => $settings->getDomainSetting('contact_zipcode'),
                'addressCountry'  => $settings->getDomainSetting('contact_country'),
                'addressRegion'   => $settings->getDomainSetting('contact_state'),
                'addressLocality' => $settings->getDomainSetting('contact_city'),
            ],
        ];

        return $this->container->get("twig")->render(
            "::blocks/seo/base.og.html.twig",
            [
                "title"       => $title,
                "description" => $description,
                "keywords"    => $keywords,
                "author"      => $this->container->get("customtexthandler")->get('header_author'),
                "schema"      => json_encode($schema),
                "og"          => [
                    "url"         => $url,
                    "type"        => "website",
                    "title"       => $title,
                    "description" => $description,
                    "image"       => $image,
                ]
            ]
        );
    }

    /**
     * Strip accents from a given string
     *
     * @param $str
     * @return string
     */
    public static function stripAccents($str)
    {
        return strtr(utf8_decode($str), utf8_decode('àáâãäçèéêëìíîïñòóôõöùúûüýÿÀÁÂÃÄÇÈÉÊËÌÍÎÏÑÒÓÔÕÖÙÚÛÜÝ'), 'aaaaaceeeeiiiinooooouuuuyyAAAAACEEEEIIIINOOOOOUUUUY');
    }
}
