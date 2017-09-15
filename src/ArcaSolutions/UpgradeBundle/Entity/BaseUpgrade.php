<?php

namespace ArcaSolutions\UpgradeBundle\Entity;

use ArcaSolutions\UpgradeBundle\Services\Upgrade;
use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Filesystem\Filesystem;
use Symfony\Component\Process\Process;

abstract class BaseUpgrade
{
    /**
     * @var string
     */
    protected $version;
    /**
     * @var Upgrade
     */
    protected $upgradeService;
    /**
     * @var object
     */
    protected $domainInfo;

    /**
     * @param Upgrade $upgradeService
     * @param $domainInfo
     */
    public function __construct(Upgrade $upgradeService, $domainInfo)
    {
        $this->upgradeService = $upgradeService;
        $this->domainInfo = $domainInfo;
    }

    /**
     * Returns this patch's version
     * @return string
     */
    public function getVersion()
    {
        return $this->version;
    }

    /**
     * Runs code required to make more specific and delicate changes to the program structure or database.
     * @return bool
     */
    abstract public function execute();

    /**
     * Writes either to the output, if exists, or to the error log files.
     * @param $text
     */
    protected function logError($text)
    {
        if ($output = $this->upgradeService->getOutput()) {
            $output->writeln("<error>[ERROR]</error> Upgrade [Version {$this->version}] : " . $text);
        } else {
            $this->upgradeService->getContainer()->get("logger")->error("[ERROR] Upgrade [Version {$this->version}] : " . $text);
        }
    }

    /**
     * Writes either to the output, if exists, or to the info log files.
     * @param $text
     */
    protected function logInfo($text)
    {
        if ($output = $this->upgradeService->getOutput()) {
            $output->writeln("<info>[INFO]</info> Upgrade [Version {$this->version}] : " . $text);
        } else {
            $this->upgradeService->getContainer()->get("logger")->error("[ERROR] Upgrade [Version {$this->version}] : " . $text);
        }
    }

    /**
     * Resets elasticsearch index
     */
    protected function rebuildElasticsearchIndex()
    {
        $this->logInfo("Rebuilding Elasticsearch Index.");
        if ($this->upgradeService->getContainer()->get("elasticsearch.synchronization")->createIndex()) {
            $this->logInfo("Index successfully recreated.");
            $this->logInfo("Resynchronizing. This can take quite a while... Sit back and relax.");
            if ($this->upgradeService->getContainer()->get("elasticsearch.synchronization")->synchronizeAll()) {
                $this->logInfo("Synchronization complete.");
            } else {
                $this->logError("Synchronization failed. Check logs for more information.");
            }
        } else {
            $this->logError("Index creation failed. Check logs for more information.");
        }
    }

    /**
     * Pushes up a curl request of $type to the $url specified
     *
     * @param $type
     * @param $url
     * @param array $options
     * @return bool
     */
    protected function sendCurl($type, $url, array $options = [])
    {
        $return = false;
        $guzzleClient = new Client();

        try {
            switch ($type) {
                case 'get':
                    $guzzleClient->get($url, $options);
                    $return = true;
                    break;
                case 'post':
                    $guzzleClient->post($url, $options);
                    $return = true;
                    break;
                case 'delete':
                    $guzzleClient->delete($url);
                    $return = true;
                    break;
            }
        } catch (RequestException $e) {
        }

        return $return;
    }

    /**
     * Creates a full backup of edirectory's folder
     * @param string $patchName The full path to the .tar.gz file
     */
    protected function applyFilePatch($patchName)
    {
        if (file_exists($patchName)) {
            $rootFolder = realpath($this->upgradeService->getRootFolder());

            $proccess = new Process("tar -xzf {$patchName}", $rootFolder);
            $proccess->run();

            if ($proccess->isSuccessful()) {
                $this->logInfo("Path successfully extracted.");
            } else {
                $this->logError("Failed to extract patch.");
            }
        } else {
            $this->logError("Patch '{$patchName}' does not exist or could not be found.");
        }
    }

    /**
     * Creates a full backup of edirectory's folder
     */
    protected function backupEdirectoryFolder()
    {
        $rootFolder = realpath($this->upgradeService->getRootFolder());

        $i = 1;
        do {
            $destination = "{$rootFolder}_backup_" . $i++;
        } while (file_exists($destination));

        $this->upgradeService->getContainer()->get("utility")->copyFolderRecursive($rootFolder, $destination);
    }

    /**
     * Attempts to remove files sent by parameter.
     *
     * <b>IMPORTANT!</b> ALL FILES MUST CONTAIN THE FULL PATH TO IT, STARTING FROM THE ROOT EDIRECTORY FOLDER
     *
     * Example:
     *          Removing a folder        : app/Resources/themes/default
     *          Removing a specific file : app/Resources/themes/default/base.html.twig
     *
     * @param $filesToBeRemoved
     */
    protected function removeFiles($filesToBeRemoved)
    {
        $this->logInfo("Removing files...");

        $rootPath = realpath($this->upgradeService->getRootFolder());

        $fileSystem = new Filesystem();

        foreach ($filesToBeRemoved as $file) {
            $fullFilePath = $rootPath . DIRECTORY_SEPARATOR . $file;

            if (file_exists($fullFilePath)) {
                try {
                    $fileSystem->remove($fullFilePath);
                    $this->logInfo("File '{$file}' removed.");
                } catch (Exception $e) {
                    $this->logError("Failed to remove file '{$file}'. Exception = '{$e->getMessage()}'");
                }
            } else {
                $this->logInfo("File '{$file}' does not exist. No need to remove.");
            }
        }

        $this->logInfo("File removal complete. If any file failed to remove, <comment>please do so manually</comment>.");
    }
}
