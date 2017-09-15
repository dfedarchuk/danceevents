<?php

use ArcaSolutions\MultiDomainBundle\HttpFoundation\MultiDomainRequest;

class SymfonyCore
{
    /**
     * @var string
     */
    private static $environment = null;
    /**
     * @var \ArcaSolutions\CoreBundle\Kernel\Kernel
     */
    private static $kernel = null;
    /**
     * @var \Symfony\Component\DependencyInjection\ContainerInterface
     */
    private static $container = null;

    /**
     * @return \ArcaSolutions\CoreBundle\Kernel\Kernel
     */
    public static function getKernel()
    {
        return self::$kernel;
    }

    /**
     * Initializes Symfony kernel and container
     * @throws Exception
     */
    public static function initialize()
    {
        if (!self::$kernel) {
            $s = DIRECTORY_SEPARATOR;
            $autoloadFile = EDIRECTORY_ROOT . "{$s}..{$s}app{$s}autoload.php";
            $kernelFile = EDIRECTORY_ROOT . "{$s}..{$s}app{$s}AppKernel.php";

            if (file_exists($autoloadFile)) {
                require_once $autoloadFile;
            }

            if (file_exists($kernelFile)) {
                require_once $kernelFile;
            } else {
                throw new \Exception("\n\n\nUnable to locate App Kernel\nLocation: {$kernelFile}\n\n\n");
            }

            $env = static::getEnvironment();

            $kernel = new \AppKernel($env, $env == 'dev');
            $kernel->boot();
            $container = $kernel->getContainer();

            $request = MultiDomainRequest::createFromGlobals();
            $request->attributes->set('is_legacy', true);
            $request->server->set('SCRIPT_FILENAME', 'app.php');
            $container->enterScope('request');
            $container->get('request_stack')->push($request);
            $container->set('request', $request);

            self::$kernel = $kernel;
            self::$container = $container;
        }
    }

    /**
     * Returns the active environment. Will attempt to get it from .htaccess if the environment variable is not set.
     * If all else fails, will assume prod.
     * @return string
     */
    public static function getEnvironment()
    {
        if (static::$environment === null) {
            static::$environment = getenv('SYMFONY_ENV');

            /* SYMFONY_ENV is not defined. This means execution skipped .htaccess file */
            if (!static::$environment) {
                /* All right, let's steal the environment from .htaccess */
                $htaccessFile = EDIRECTORY_ROOT . DIRECTORY_SEPARATOR . ".htaccess";

                if (file_exists($htaccessFile)) {
                    $htaccessFileContent = file_get_contents($htaccessFile);

                    $matches = [];
                    preg_match("/(?<=setEnv SYMFONY\\_ENV \\')\\w+(?=\\')/", $htaccessFileContent, $matches);

                    /* Got it */
                    $matches and static::$environment = array_pop($matches);
                } else {
                    /* When all else fails, we'll take the safe bet */
                    static::$environment = "prod";
                }
            }
        }

        return static::$environment;
    }

    /**
     * Rebuilds ES location index
     */
    public static function rebuildElasticsearchLocations()
    {
        try {
            self::getContainer()->get("apccache.edirectory.service")->delete("_all-locations");
            self::getContainer()->get("location.synchronization")->generateAll();
        } catch (Exception $e) {
            $logger = SymfonyCore::getContainer()->get("logger");
            $logger->critical("Elasticsearch Synchronization Failure", ["exception" => $e]);
        }
    }

    /**
     * @return \Symfony\Component\DependencyInjection\ContainerInterface
     */
    public static function getContainer()
    {
        return self::$container;
    }

    public static function setDomainDB($domainId)
    {
        $container = self::$container;
        $connection = $container->get("doctrine.dbal.domain_connection");
        $params = $connection->getParams();

        /* @var $domain \ArcaSolutions\CoreBundle\Entity\Domain */
        if ($domain = $container->get("doctrine")->getRepository("CoreBundle:Domain", "main")->find($domainId)) {
            $dbname = $domain->getDatabaseName();

            if ($dbname != $params['dbname']) {
                $params['dbname'] = $dbname;
                if ($connection->isConnected()) {
                    $connection->close();
                }

                $connection->__construct(
                    $params,
                    $connection->getDriver(),
                    $connection->getConfiguration(),
                    $connection->getEventManager()
                );

                try {
                    $connection->connect();

                    $container->get("multi_domain.information")->setActiveHost($domain->getUrl());
                } catch (\Exception $e) {
                    $container->get('logger')->critical('Could not instantiate domain connection on Sitemgr');
                }
            }
        } else {
            $container->get('logger')->critical('Could not instantiate domain connection on Sitemgr');
        }
    }
}
