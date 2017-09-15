<?php

namespace ArcaSolutions\CoreBundle\Kernel;

use ArcaSolutions\MultiDomainBundle\HttpFoundation\MultiDomainRequest;
use Symfony\Component\Config\Loader\LoaderInterface;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;
use Symfony\Component\Yaml\Parser;

/**
 * eDirectory base application kernel.
 *
 * @package ArcaSolutions\CoreBundle\Kernel
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 */
abstract class Kernel extends BaseKernel
{
    protected $domain = null;

    const VERSION = '11.2.10';
    const VERSION_ID = '11210';
    const MAJOR_VERSION = '11';
    const MINOR_VERSION = '2';
    const RELEASE_VERSION = '10';
    const EXTRA_VERSION = '';

    const API_VERSION = 2;

    const ENV_DEV = 'dev';
    const ENV_PROD = 'prod';
    const ENV_TEST = 'test';
    const ENV_STAGING = 'staging';

    /**
     * {@inheritdoc}
     */
    public function registerBundles()
    {
        $bundles = [
            new \Doctrine\Bundle\DoctrineBundle\DoctrineBundle(),
            new \Symfony\Bundle\FrameworkBundle\FrameworkBundle(),
            new \Symfony\Bundle\SecurityBundle\SecurityBundle(),
            new \Symfony\Bundle\TwigBundle\TwigBundle(),
            new \Symfony\Bundle\MonologBundle\MonologBundle(),
            new \Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle(),
            new \Symfony\Bundle\AsseticBundle\AsseticBundle(),
            new \Sensio\Bundle\FrameworkExtraBundle\SensioFrameworkExtraBundle(),
            new \Ivory\GoogleMapBundle\IvoryGoogleMapBundle(),
            new \FOS\JsRoutingBundle\FOSJsRoutingBundle(),
            new \Knp\Bundle\PaginatorBundle\KnpPaginatorBundle(),
            new \Liip\ThemeBundle\LiipThemeBundle(),
            new \Liip\ImagineBundle\LiipImagineBundle(),
            new \JMS\TranslationBundle\JMSTranslationBundle(),
            new \Doctrine\Bundle\MigrationsBundle\DoctrineMigrationsBundle(),
            new \Doctrine\Bundle\FixturesBundle\DoctrineFixturesBundle(),

            /** Captcha Bundles */
            new \Gregwar\CaptchaBundle\GregwarCaptchaBundle(),
            new \EWZ\Bundle\RecaptchaBundle\EWZRecaptchaBundle(),

            /** Api Bundles */
            new \FOS\RestBundle\FOSRestBundle(),
            new \JMS\SerializerBundle\JMSSerializerBundle(),
            new \Nelmio\ApiDocBundle\NelmioApiDocBundle(),
            new \ArcaSolutions\ApiBundle\ApiBundle(),

            /** eDirectory Bundles */
            new \ArcaSolutions\MultiDomainBundle\MultiDomainBundle(),
            new \ArcaSolutions\WebBundle\WebBundle(),
            new \ArcaSolutions\CoreBundle\CoreBundle(),
            new \ArcaSolutions\SearchBundle\SearchBundle(),
            new \ArcaSolutions\ElasticsearchBundle\ElasticsearchBundle(),
            new \ArcaSolutions\ImageBundle\ImageBundle(),
            new \ArcaSolutions\ListingBundle\ListingBundle(),
            new \ArcaSolutions\ClassifiedBundle\ClassifiedBundle(),
            new \ArcaSolutions\EventBundle\EventBundle(),
            new \ArcaSolutions\ArticleBundle\ArticleBundle(),
            new \ArcaSolutions\DealBundle\DealBundle(),
            new \ArcaSolutions\BlogBundle\BlogBundle(),
            new \ArcaSolutions\BannersBundle\BannersBundle(),
            new \ArcaSolutions\ReportsBundle\ReportsBundle(),
            new \ArcaSolutions\UpgradeBundle\UpgradeBundle(),
            new \ArcaSolutions\WysiwygBundle\WysiwygBundle(),

        ];

        return $bundles;
    }

    /**
     * Returns the current selected domain. Attempts to get info from Request or from the database, if the former fails.
     * @return null|string
     * @throws \Exception
     */
    public function getDomain()
    {
        if ($this->domain === null) {
            /* If there's a request, get data from the request */
            if ($request = MultiDomainRequest::createFromGlobals() and $host = $request->getHost()) {
                $this->domain = $host;
            } else {
                /* No request data... Let's try our database */
                $s = DIRECTORY_SEPARATOR;
                $parametersPath = $this->getRootDir() . "{$s}config{$s}parameters.yml";

                if (file_exists($parametersPath)) {
                    try {
                        /* Parsing and retrieving information from parameters.yml */
                        $yaml = new Parser();
                        $parsedParameterArray = $yaml->parse(file_get_contents($parametersPath));
                        $parameters = $parsedParameterArray["parameters"];

                        $dbHost = $parameters["database_host"];
                        $dbName = $parameters["database_name"];
                        $dbUser = $parameters["database_user"];
                        $dbPassword = $parameters["database_password"];
                        $dbCharset = $parameters["database_charset"];

                        /* Connection creation */
                        $connection = new \PDO(
                            "mysql:host={$dbHost};dbname={$dbName};charset={$dbCharset}",
                            $dbUser,
                            $dbPassword
                        );

                        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

                        /* If we DO have this constant defined, let's use it's value */
                        if (defined("SELECTED_DOMAIN_ID")) {
                            $statement = $connection->prepare("SELECT `url` FROM `Domain` WHERE `id` = :id");
                            $statement->bindValue("id", SELECTED_DOMAIN_ID);
                            $statement->execute();

                            if ($selectedDomain = $statement->fetchObject()) {
                                $this->domain = $selectedDomain->url;
                            }
                        } elseif (defined("SELECTED_DOMAIN_URL")) {
                            $this->domain = SELECTED_DOMAIN_URL;
                        }

                        /* Request, SELECTED_DOMAIN_URL and SELECTED_DOMAIN_ID are missing. */
                        if ($this->domain === null) {
                            $statement = $connection->query("SELECT `url` FROM `Domain` WHERE `status` = 'A'");

                            /* Let's try to get this info from the Database still, hoping there's only one active domain */
                            if ($statement->rowCount() == 1 and $selectedDomain = $statement->fetchObject()) {
                                $this->domain = $selectedDomain->url;
                            }
                        }
                    } catch (\Exception $e) {
                    }
                } else {
                    throw new \Exception("Unable to find parameters configuration file.");
                }
            }
        }

        return $this->domain;
    }

    /**
     * {@inheritdoc}
     */
    public function registerContainerConfiguration(LoaderInterface $loader)
    {
        $rootDir = $this->getRootDir();

        $loader->load($rootDir . '/config/config_' . $this->environment . '.yml');

        if ($domain = $this->getDomain()) {
            /*
             * Imports config files config/domains/<domain>.ext.yml
             */
            $configurationFileExtensionList = ['configs', 'payment', 'route'];

            foreach ($configurationFileExtensionList as $ext) {
                $loader->load($rootDir . '/config/domains/' . $domain . '.' . $ext . '.yml');
            }
        }
    }

    /**
     * {@inheritdoc}
     */
    public function getCacheDir()
    {
        $domain = empty($_SERVER['SERVER_NAME']) ? false : $_SERVER['SERVER_NAME'];

        if (!$domain) {
            if (defined("SELECTED_DOMAIN_ID")) {
                $s = DIRECTORY_SEPARATOR;
                require_once EDIRECTORY_ROOT . "{$s}classes{$s}class_DatabaseHandler.php";
                $db = \DatabaseHandler::getMainConnection();

                $statement = $db->prepare("SELECT `url` FROM `Domain` WHERE `id` = :id");
                $statement->execute([":id" => SELECTED_DOMAIN_ID]);

                if ($result = $statement->fetchObject()) {
                    $domain = $result->url;
                }
            } elseif (defined("SELECTED_DOMAIN_URL")) {
                $domain = SELECTED_DOMAIN_URL;
            } else {
                defined("DOMAIN_NOT_SELECTED") or define("DOMAIN_NOT_SELECTED", true);
            }
        }


        $domain = str_replace('www.', '', $domain);

        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/edirectory/cache/' . $this->environment . '/' . $domain;
        }

        return $this->rootDir . '/cache/' . $this->environment . '/' . $domain;
    }

    /**
     * @return boolean
     */
    protected function isVagrantEnvironment()
    {
        return (getenv('HOME') === '/home/vagrant' || getenv('VAGRANT') === 'VAGRANT') && is_dir('/dev/shm');
    }

    /**
     * {@inheritdoc}
     */
    public function getLogDir()
    {
        if ($this->isVagrantEnvironment()) {
            return '/dev/shm/edirectory/logs';
        }

        return parent::getLogDir();
    }
}
