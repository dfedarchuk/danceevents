<?php

namespace ArcaSolutions\MultiDomainBundle\Command;


use ArcaSolutions\MultiDomainBundle\Services\Settings;
use Doctrine\DBAL\ConnectionException;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class AbstractMultiDomainCommand
 *
 * @author Diego Mosela <diego.mosela@arcasolutions.com>
 * @package ArcaSolutions\MultiDomainBundle\Command
 */
abstract class AbstractMultiDomainCommand extends ContainerAwareCommand
{
    /**
     * @var Settings
     */
    var $multiDomian;

    protected function configure()
    {
        $this->addOption('all-domains', 'all', InputOption::VALUE_NONE, 'Execute for all domains.');
        $this->addOption('domain', 'd', InputOption::VALUE_OPTIONAL, 'The domain that will execute the command');
    }

    /**
     * MultiDomain Command Header
     *
     * @param SymfonyStyle $style
     * @param OutputInterface $output
     */
    protected function outputHeader(SymfonyStyle $style, OutputInterface $output)
    {
        $text = $this->multiDomian->getActiveHost() ? $this->multiDomian->getOriginalActiveHost() : "all domains";
        $style->section("MultiDomain - Running: ".$text);
    }

    /**
     * Gets the domain information with the information in the parameters
     *
     * @param InputInterface $input
     * @return Settings|array
     */
    protected function getMultiDomain(InputInterface $input)
    {
        /* @todo Required constants checks due to the --domain parameter being in the app/console. After refactoring all the commands to use this class will no longer be necessary */

        if ((!$input->getOption('all-domains') && !$input->getOption('domain')) && !defined("SELECTED_DOMAIN_URL")) {
            throw new \InvalidArgumentException('You MUST provide a valid domain url using the --domain=demodirectory.com option or use the --all-domains to run the command for all domains.');
        }

        /* Get MultiDomain Service */
        $this->multiDomian = $this->getContainer()->get('multi_domain.information');

        /* Set domain informed in --domain parameter */
        if (defined("SELECTED_DOMAIN_URL") and SELECTED_DOMAIN_URL) {
            $this->multiDomian->setActiveHost(SELECTED_DOMAIN_URL);
        }

        return $this->multiDomian;
    }

    /**
     * Sets the new domain
     *
     * @param $domain
     */
    protected function setDomain($domain)
    {
        $this->multiDomian->setActiveHost($domain);
    }

    /**
     * Gets the domain active
     *
     * @param $domian
     * @return Settings
     */
    protected function getDomain($domian)
    {
        $this->multiDomian->setActiveHost($domian);

        return $this->multiDomian;
    }

    protected function getConnection()
    {
        $connection = $this->getContainer()->get('doctrine.dbal.domain_connection');
        $params = $connection->getParams();
        $dbname = $this->multiDomian->getDatabase();

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
                throw new ConnectionException('Could not instantiate domain connection.');
            }
        }
    }
}
