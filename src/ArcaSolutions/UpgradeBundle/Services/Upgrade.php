<?php

namespace ArcaSolutions\UpgradeBundle\Services;

use ArcaSolutions\CoreBundle\Entity\Domain;
use ArcaSolutions\UpgradeBundle\Entity\BaseUpgrade;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use Symfony\Component\Finder\Finder;
use Symfony\Component\Finder\SplFileInfo;

class Upgrade
{
    /**
     * @var ContainerInterface
     */
    protected $container = null;
    /**
     * @var string
     */
    protected $domainDatabaseName = null;
    /**
     * @var \PDO
     */
    protected $domainConnection = null;
    /**
     * @var string
     */
    protected $mainDatabaseName = null;
    /**
     * @var \PDO
     */
    protected $mainConnection = null;
    /**
     * @var OutputInterface
     */
    protected $output = null;

    function __construct(ContainerInterface $container)
    {
        $this->container = $container;

        $this->mainDatabaseName = $container->getParameter('database_name');
    }

    /**
     * Scans the upgrade resource folder for possible upgrade packages.
     *
     * .sql files will be queried;
     * .php files must be children of the BaseUpgrade class, and implement required methods and properties;
     *
     * @param OutputInterface $output
     * @param bool $keepName
     * @param bool $noQuery Prevents execution of SQL queries
     * @param bool $noHandler Prevents execution of php handlers
     */
    public function upgrade($output = null, $keepName = false, $noQuery = false, $noHandler = false)
    {
        $output and $this->output = $output;
        $mainConnection = $this->getMainConnection();

        /* Gets active domains, each upgrade will be applied to all domains later on */
        if ($result = $mainConnection->query("SELECT * FROM `Domain` WHERE `status` = 'A'")) {
            $domains = $result->fetchAll(\PDO::FETCH_OBJ);

            /* Attempts to locate Resources/upgrades */
            $fileLocator = $this->container->get("file_locator");
            $upgradeFolders = $fileLocator->locate("upgrades");

            if (file_exists($upgradeFolders)) {
                $this->logText("Upgrade folder found. ({$upgradeFolders})");
                $finder = new Finder();

                /* Attempts to locate version upgrade folders */
                $upgrades = $finder->in($upgradeFolders)->directories()->sortByName()->notName("*_done")->depth(0);

                /* @var $upgrade SplFileInfo */
                foreach ($upgrades as $upgrade) {
                    $this->logText("Found [{$upgrade}] upgrade.");
                    $upgradeFinder = new Finder();
                    /* Gets and sorts out all files inside version upgrade folder */
                    $files = $upgradeFinder->in($upgrade->getRealPath())->files();

                    $handlers = [];
                    $queries = [];

                    /* @var $file SplFileInfo */
                    $this->logText("Searching for upgrade files...");
                    foreach ($files as $file) {
                        switch ($file->getExtension()) {
                            case "sql":
                                $this->logText("Found SQL script : '{$file->getRealPath()}'");
                                $queries[] = $file->getRealPath();
                                break;
                            case "php":
                                $this->logText("Found PHP handler : '{$file->getRealPath()}'");
                                $handlers[] = $file->getRealPath();
                                break;
                        }
                    }

                    /* Performs the upgrade properly for each domain, setting up it's database beforehand */
                    foreach ($domains as $domain) {
                        $this->logText("Performing upgrades for '[{$domain->id}] - {$domain->name}' domain.");
                        /* Loads domain database information into both domainConnection property and doctrine manager */
                        $this->setDomainDB($domain);

                        if ($noQuery) {
                            $this->logText("Skipping queries, as requested.");
                        } else {
                            $this->runQueries($queries);
                        }

                        if ($noHandler) {
                            $this->logText("Skipping handlers, as requested.");
                        } else {
                            $this->executeHandlers($handlers, $domain);
                        }
                    }

                    $this->logText("Upgrade '[{$upgrade}]' finished.");

                    if (!$keepName) {
                        $this->logText("Renaming upgrade folder...");
                        rename($upgrade->getRealPath(), $upgrade->getRealPath() . "_done");
                    }
                }
            }
        }
    }

    /**
     * Returns a Main database connection.
     * @return \PDO
     */
    public function getMainConnection()
    {
        if ($this->mainConnection === null) {
            $this->mainConnection = $this->kindleConnection($this->mainDatabaseName);
            $this->logText("Main Database ({$this->mainDatabaseName}) connection lit.");
        }

        return $this->mainConnection;
    }

    /**
     * Lights up a connection to the database whose information is contained within the parameters
     *
     * @param string $databaseName
     * @param string $host
     * @param string $username
     * @param string $password
     * @return \PDO
     */
    private function kindleConnection($databaseName, $host = null, $username = null, $password = null)
    {
        $host or $host = $this->container->getParameter('database_host');
        $username or $username = $this->container->getParameter('database_user');
        $password or $password = $this->container->getParameter('database_password');

        $connection = new \PDO("mysql:host={$host};dbname={$databaseName};charset=utf8", $username, $password);
        $connection->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);

        return $connection;
    }

    /**
     * Attempts to execute all BaseUpgrade children inside the version upgrade folder. (Wow, this sounds evil)
     *
     * @param $handlerNames
     * @param $domain
     * @return \bool[]
     */
    private function executeHandlers($handlerNames, $domain)
    {
        $results = [];

        while ($handlerName = array_pop($handlerNames)) {
            if (file_exists($handlerName)) {
                require_once $handlerName;

                $className = basename($handlerName, ".php");

                /* Only BaseUpgrade children must be executed. (Yeah, this definitelly sounds evil) */
                if (is_subclass_of($className, "ArcaSolutions\\UpgradeBundle\\Entity\\BaseUpgrade")) {
                    /* @var $handler BaseUpgrade */
                    $handler = new $className($this, $domain);
                    $this->logText("Executing ({$className}) upgrade.");
                    $results[$handlerName] = $handler->execute();
                }
            }
        }

        return $results;
    }

    /**
     * Reads and executes SQL queries in files array passed as $queryFiles parameter
     * @param string[] $queryFiles
     * @return array
     */
    private function runQueries($queryFiles)
    {
        $results = [];

        /* We are going to use array_pop, forcing this variable to be an array is necessary in order to avoid errors */
        is_array($queryFiles) or $queryFiles = (array)$queryFiles;

        while ($queryFile = array_pop($queryFiles)) {
            if (file_exists($queryFile)) {
                $SQL = file_get_contents($queryFile);

                $query = str_replace(
                    ["{{DOMAIN_DB}}", "{{MAIN_DB}}"],
                    [$this->domainDatabaseName, $this->mainDatabaseName],
                    $SQL
                );

                $domainConnection = $this->getDomainConnection();

                $domainConnection->beginTransaction();
                try {
                    $domainConnection->exec($query);
                    $domainConnection->commit();
                    $this->logText("Query '{$queryFile}' successfully executed.");
                } catch (\Exception $e) {
                    $domainConnection->rollBack();
                    $this->logText("Query '{$queryFile}' failed. Info : {$e->getMessage()}");
                }
            }
        }

        return $results;
    }

    /**
     * Returns the currently active domain connection.
     * @return \PDO|null
     */
    public function getDomainConnection()
    {
        return $this->domainConnection;
    }

    /**
     * @return ContainerInterface
     */
    public function getContainer()
    {
        return $this->container;
    }

    /**
     * @return string
     */
    public function getDomainDatabaseName()
    {
        return $this->domainDatabaseName;
    }

    /**
     * @return string
     */
    public function getMainDatabaseName()
    {
        return $this->mainDatabaseName;
    }

    /**
     * Returns the path to the theme root folder.
     * Usually: /web/theme
     * @return string
     */
    public function getRootThemeFolder()
    {
        return $this->getWebFolder() . DIRECTORY_SEPARATOR . "theme";
    }

    /**
     * Returns the path to the theme domain folder.
     * Usually: /web/custom/domain_x/theme
     * @param object $domain
     * @return string
     */
    public function getDomainThemeFolder($domain)
    {
        return $this->getDomainFolder($domain) . DIRECTORY_SEPARATOR . "theme";
    }

    /**
     * Returns the path to the domain folder.
     * Usually: /web/custom/domain_x
     * @param object $domain
     * @return string
     */
    public function getDomainFolder($domain)
    {
        return $this->getCustomFolder() . DIRECTORY_SEPARATOR . "domain_" . $domain->id;
    }

    /**
     * Returns the path to the custom folder.
     * Usually: /web/custom
     * @return string
     */
    public function getCustomFolder()
    {
        return $this->getWebFolder() . DIRECTORY_SEPARATOR . "custom";
    }

    /**
     * Returns the path to the web folder.
     * Usually: /web
     * @return string
     */
    public function getWebFolder()
    {
        return $this->getRootFolder() . DIRECTORY_SEPARATOR . "web";
    }

    /**
     * Returns the path to the root folder.
     * Usually: /
     * @return string
     */
    public function getRootFolder()
    {
        return $this->container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . "..";
    }

    /**
     * Returns the path to the config folder.
     * Usually: /app/config
     * @return string
     */
    public function getConfigurationFolder()
    {
        return $this->container->get('kernel')->getRootDir() . DIRECTORY_SEPARATOR . "config";
    }

    /**
     * Returns the Output instance. Usually used to display things on the terminal.
     * @return OutputInterface
     */
    public function getOutput()
    {
        return $this->output;
    }

    /**
     * Writes either to the output, if exists, or to the log files.
     * @param $text
     */
    protected function logText($text)
    {
        if ($this->output) {
            $this->output->writeln($text);
        } else {
            $this->container->get("logger")->info("[Upgrade] " . $text);
        }
    }

    /**
     * Sets all connection information for a certain Domain
     * @param Domain $domain
     */
    public function setDomain(Domain $domain)
    {
        $object = (object)[
            "database_name" => $domain->getDatabaseName(),
            "database_host" => $domain->getDatabaseHost(),
            "database_username" => $domain->getDatabaseUsername(),
            "database_password" => $domain->getDatabasePassword(),
            "url" => $domain->getUrl()
        ];

        $this->setDomainDB($object);
    }

    protected function setDomainDB($domain)
    {
        $this->domainDatabaseName = $domain->database_name;
        $this->domainConnection = $this->kindleConnection(
            $domain->database_name,
            $domain->database_host,
            $domain->database_username,
            $domain->database_password
        );

        $this->container->get("multi_domain.information")->setActiveHost($domain->url);

        $connection = $this->container->get("doctrine.dbal.domain_connection");
        $params = $connection->getParams();

        $dbname = $domain->database_name;

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
            } catch (\Exception $e) {
                $this->logText('<error>Could not instantiate domain connection.</error>');
            }
        }
    }
}
