<?php

namespace ArcaSolutions\MultiDomainBundle\Services;

use ArcaSolutions\CoreBundle\Kernel\Kernel;
use Symfony\Bridge\Monolog\Logger;
use Symfony\Component\HttpKernel\KernelInterface;

/**
 * Class Settings
 *
 * Class responsible for retrieving information from the domain that is accessing the system.
 *
 * @package ArcaSolutions\MultiDomainBundle\Services
 */
class Settings
{
    /**
     * @var array
     */
    protected $hostConfig = [];

    /**
     * @var string|null
     */
    protected $activeHost = null;

    /**
     * @var string|null
     */
    protected $originalActiveHost = null;

    /**
     * @var Logger
     */
    protected $logger;

    /**
     * Settings constructor.
     *
     * @param KernelInterface $kernel
     * @param $hostsConfig
     * @param Logger $logger
     */
    public function __construct(KernelInterface $kernel, $hostsConfig, Logger $logger)
    {
        $this->setHostConfig($hostsConfig);
        $this->logger = $logger;

        /* @var Kernel $kernel */
        $domain = $kernel->getDomain() and $this->setActiveHost($domain);
    }

    /**
     * @param array $hostConfig
     */
    protected function setHostConfig($hostConfig)
    {
        $this->hostConfig = $hostConfig;
    }

    /**
     * @return array
     */
    public function getHostConfig()
    {
        return $this->hostConfig;
    }

    /**
     * @return null
     */
    public function getActiveHost()
    {
        return $this->activeHost;
    }

    /**
     * @param null $activeHost
     * @throws \Exception
     */
    public function setActiveHost($activeHost)
    {
        $this->originalActiveHost = $activeHost;

        $activeHost = str_replace('-', '_', $activeHost);

        if (isset($this->hostConfig[$activeHost])) {
            $this->activeHost = $activeHost;
        } else {
            $this->logger->critical("[MultiDomain/Settings] - Unable to set Active Host.");
            throw new \Exception(sprintf('Cannot find host %s for this eDirectory installation', $activeHost));
        }
    }

    /**
     * @return null
     */
    public function getOriginalActiveHost()
    {
        return $this->originalActiveHost;
    }

    /**
     * @return int
     */
    public function getId()
    {
        return $this->getSetting("id");
    }

    /**
     * @param $name
     * @return mixed
     */
    public function getSetting($name)
    {
        $returnValue = null;

        if ($this->hostConfig and $this->activeHost and isset($this->hostConfig[$this->activeHost])) {
            $returnValue = $this->hostConfig[$this->activeHost][$name];
        }

        return $returnValue;
    }

    /**
     * @return string
     */
    public function getPath()
    {
        return $this->getSetting("path");
    }

    /**
     * @return string
     */
    public function getTemplate()
    {
        return $this->getSetting("template");
    }

    /**
     * @return string
     */
    public function getLocale()
    {
        return $this->getSetting("locale");
    }

    /**
     * @return string
     */
    public function getDatabase()
    {
        return $this->getSetting("database");
    }

    /**
     * @return string
     */
    public function getElastic()
    {
        return $this->getSetting("elastic");
    }

    /**
     * @return string
     */
    public function getTitle()
    {
        return $this->getSetting("title");
    }

    /**
     * @return string
     */
    public function getBranded()
    {
        return $this->getSetting("branded");
    }
}
