<?php

namespace ArcaSolutions\CoreBundle\Services;

use Symfony\Component\DependencyInjection\ContainerInterface;

class LanguageHandler extends \Twig_Extension
{
    //region Constants
    const DEFAULT_TIME_FORMAT = "h:i a";
    const DEFAULT_DATE_FORMAT = "m/d/Y";
    //endregion

    //region Properties
    /**
     * @var \DOMDocument
     */
    protected $DOMDocument = null;
    /**
     * @var ContainerInterface
     */
    protected $container;
    //endregion

    //region Constructor/Destructor
    /**
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    /**
     *
     */
    function __destruct()
    {
        if ($this->DOMDocument) {
            $domainTranslationFile = $this->getDomainTranslationFile();

            $this->DOMDocument->formatOutput = true;
            $this->DOMDocument->preserveWhiteSpace = false;
            $this->DOMDocument->save($domainTranslationFile);

            $this->clearTranslationCache();
        }
    }
    //endregion

    //region XML Handling
    /**
     * Returns the full path to the domain translation file.
     * @return string
     */
    protected function clearTranslationCache()
    {
        $s = DIRECTORY_SEPARATOR;
        $rootDir = $this->container->get("kernel")->getCacheDir();
        $translationCacheDir = "{$rootDir}{$s}translations";
        $this->container->get('utility')->removeFolderRecursive($translationCacheDir);
    }

    /**
     * Returns the full path to the domain translation file.
     * @return string
     */
    protected function getDomainTranslationFile()
    {
        $s = DIRECTORY_SEPARATOR;
        $domain = $this->getCustomLanguageDomain();
        $domainLocale = $this->container->get("multi_domain.information")->getLocale();
        $ISOlocale = $this->getISOLang($domainLocale);
        $rootDir = $this->container->get("kernel")->getRootDir();

        return "$rootDir{$s}Resources{$s}translations{$s}{$domain}.{$ISOlocale}.xlf";
    }

    /**
     * Removes the <trans-unit> node containing $source inside the <source> node.
     * @param $source
     * @return bool
     */
    public function removeLanguageNode($source)
    {
        $success = false;
        $fileNode = $this->getDOMDocument()->documentElement->getElementsByTagName('source');

        for ($i = 0; $i < $fileNode->length; $i++) {
            $transUnitNode = $fileNode->item($i);

            if ($transUnitNode->nodeValue == $source) {
                $parent = $transUnitNode->parentNode;
                $parent->parentNode->removeChild($parent);
                $success = true;
                break;
            }
        }

        return $success;
    }

    /**
     * Returns a DOMDocument instance
     * @return \DOMDocument
     */
    protected function getDOMDocument()
    {
        if (!$this->DOMDocument) {
            $domainTranslationFile = $this->getDomainTranslationFile();

            if (file_exists($domainTranslationFile)) {
                $this->DOMDocument = new \DOMDocument();
                $this->DOMDocument->load($domainTranslationFile);
            } else {
                $this->DOMDocument = $this->createDOMDocument();
            }
        }

        return $this->DOMDocument;
    }

    /**
     * Creates a new DOMDocument instance with the required structure up to the <body> tag
     * @return \DOMDocument
     */
    protected function createDOMDocument()
    {
        $domtree = new \DOMDocument('1.0', 'UTF-8');

        $xliffNode = $domtree->createElement("xliff");
        $xliffNode->setAttribute("xmlns", "urn:oasis:names:tc:xliff:document:1.2");
        $xliffNode->setAttribute("version", "1.2");
        $domtree->appendChild($xliffNode);

        $fileNode = $domtree->createElement("file");
        $fileNode->setAttribute("source-language", "en");
        $fileNode->setAttribute("datatype", "plaintext");
        $fileNode->setAttribute("original", "file.ext");
        $xliffNode->appendChild($fileNode);

        $bodyNode = $domtree->createElement("body");
        $fileNode->appendChild($bodyNode);

        return $domtree;
    }

    /**
     * @param $source
     * @param $target
     */
    public function setNode($source, $target)
    {
        $this->removeLanguageNode($source);
        $this->addLanguageNode($source, $target);
    }

    /**
     * Adds a new language node
     * @param $source
     * @param $target
     */
    protected function addLanguageNode($source, $target)
    {
        $document = $this->getDOMDocument();
        $body = $document->getElementsByTagName("body")->item(0);

        if ($body) {
            $child = $document->createElement("trans-unit");
            $body->appendChild($child);

            $child->setAttribute("id", uniqid());
            $child->appendChild($document->createElement("source", $source));
            $child->appendChild($document->createElement("target", $target));
        }
    }
    //endregion

    //region Getters/Setters
    /**
     * Sets time format
     * @param $timeFormat
     */
    public function setTimeFormat($timeFormat)
    {
        switch ($timeFormat) {
            case "24":
                $timeFormat = "H:i";
                break;
            case "12":
                $timeFormat = "h:i a";
                break;
        }

        $this->setNode("time.format", $timeFormat);
    }

    /**
     * Sets date format
     * @param $dateFormat
     */
    public function setDateFormat($dateFormat)
    {
        $this->setNode("date.format", $dateFormat);
    }

    protected function getCustomLanguageDomain()
    {
        return preg_replace("/[^\w]/", "", $this->container->get("multi_domain.information")->getActiveHost());
    }

    /**
     * Returns the selected date format.
     * @param $source
     * @param null $domain
     * @param null $default
     * @return string
     */
    public function getTranslation($source, $domain = null, $default = null)
    {
        $translator = $this->container->get("translator");

        /** @Ignore */
        $return = $translator->trans($source, [], $this->getCustomLanguageDomain());

        if (!$return or $return == $source) {

            $return = $domain ? /** @Ignore */ $translator->trans($source, [], $domain) : /** @Ignore */ $translator->trans($source);

            if (!$return or $return == $source) {
                $return = $default;
            }
        }

        return $return;
    }

    /**
     * Returns the selected date format.
     * @return string
     */
    public function getDateFormat()
    {
        return $this->getTranslation("date.format", "units", static::DEFAULT_DATE_FORMAT);
    }

    /**
     * Returns the selected time format.
     * @return string
     */
    public function getTimeFormat()
    {
        return $this->getTranslation("time.format", "units", static::DEFAULT_TIME_FORMAT);
    }

    /**
     * Returns a valid ISO code for a certain language $id
     *
     * @param $input
     * @return string
     */
    public function getISOLang($input)
    {
        switch (strtolower(preg_replace("/[^a-z]/i", "", $input))) {
            default:
            case "en":
            case "enus":
            case "engb":
                $return = "en";
                break;
            case "pt":
            case "ptbr":
            case "ptpt":
                $return = "pt";
                break;
            case "fr":
            case "frfr":
                $return = "fr";
                break;
            case "ge":
            case "gege":
            case "de":
                $return = "de";
                break;
            case "it":
            case "itit":
                $return = "it";
                break;
            case "es":
            case "eses":
                $return = "es";
                break;
            case "tr":
            case "trtr":
                $return = "tr";
                break;
        }

        return $return;
    }
    //endregion

    //region Twig
    /**
     * {@inheritdoc}
     */
    public function getName()
    {
        return 'languageHandler';
    }

    /**
     * {@inheritdoc}
     */
    public function getFunctions()
    {
        return [
            new \Twig_SimpleFunction(
                'getDateFormat',
                [$this, 'getDateFormat']
            ),
            new \Twig_SimpleFunction(
                'getTimeFormat',
                [$this, 'getTimeFormat']
            ),
            new \Twig_SimpleFunction(
                'getISOLang',
                [$this, 'getISOLang']
            ),
        ];
    }
    //endregion
}
