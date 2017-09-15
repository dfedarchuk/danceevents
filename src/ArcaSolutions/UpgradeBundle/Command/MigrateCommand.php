<?php

namespace ArcaSolutions\UpgradeBundle\Command;

use ArcaSolutions\CoreBundle\Entity\Domain;
use Doctrine\DBAL\Migrations\Migration;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Doctrine\DBAL\Migrations\Configuration\Configuration;
use Symfony\Component\Console\Question\ChoiceQuestion;


/**
 * Class MigrateCommand
 * @package ArcaSolutions\UpgradeBundle\Command
 */
class MigrateCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('edirectory:migrate')
            ->setDefinition([
                new InputOption(
                    'main',
                    'm',
                    InputOption::VALUE_NONE,
                    'Execute migrations for main database.'
                ),
                new InputOption(
                    'domain',
                    'd',
                    InputOption::VALUE_NONE,
                    'Execute migrations for one active domain database.'
                ),
                new InputOption(
                    'all-domains',
                    null,
                    InputOption::VALUE_NONE,
                    'Execute migrations for all active domains.'
                ),
                new InputOption(
                    'all',
                    null,
                    InputOption::VALUE_NONE,
                    'Execute migrations for all databases (main and domain).'
                ),
            ])
            ->setDescription('Executes migrations from selected database(s).')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command will attempt to execute migrations of main and/or domain databases

  <info>php %command.full_name% --main</info> (Execute migrations for main database)
  <info>php %command.full_name% --domain</info> (Execute migrations for one active domain database)
  <info>php %command.full_name% --all-domains</info> (Execute migrations for all active domains)
  <info>php %command.full_name% --all</info> (Execute migrations for all databases (main and domain))
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>Migrations Initiated</comment>");

        if (defined("DOMAIN_NOT_SELECTED") and DOMAIN_NOT_SELECTED) {
            $output->writeln("<error> You MUST provide a valid domain url using the --domain=demodirectory.com option</error>");
            exit();
        }

        $doctrine = $this->getContainer()->get("doctrine");
        $domainRepository = $doctrine->getRepository("CoreBundle:Domain", "main");

        $domainsToMigrate = null;

        /* Executes main migrations if the option chosen is "main" or "all" */
        if ($mainOption = $input->getOption('main') || $allOption = $input->getOption('all')) {
            $this->executeMainMigrations($output);
        }

        /* Executes domain migrations according to chosen option */
        if ($allDomainsOption = $input->getOption('all-domains') || $allOption = $input->getOption('all')) {
            /* get all domains active */
            $domainsToMigrate = $domainRepository->findBy(["status" => "A"]);
            if (!$domainsToMigrate) {
                $output->writeln("\n<error>Error: No domain active found!</error>");
            }

        } elseif ($domainOption = $input->getOption('domain')) {
            $domains = $domainRepository->findBy(["status" => "A"]);

            /* Only one domain is available. Let's use it, no questions asked */
            if (count($domains) == 1) {
                $domainsToMigrate = $domains;
                $output->writeln("Only one domain found ({$domains[0]->getUrl()}) . Using it");
            } else {
                /* More than one domain is available, let user decide */
                $output->writeln("This eDirectory has more than one domain: ");

                $options = [];

                /* Puts all available options human=readable into a string array, zero-indexed */
                for ($i = 0; $i < count($domains); $i++) {
                    /* @var $domains Domain[] */
                    $domainName = $domains[$i]->getName();
                    $domainUrl = $domains[$i]->getUrl();
                    $options[$i] = "{$domainName} ({$domainUrl})";
                }

                $question = new ChoiceQuestion(
                    "Which domain do you want execute the migrations? (Defaults to '{$options[0]}')",
                    $options,
                    $options[0]
                );

                $selectedDomain = $this->getHelper('question')->ask($input, $output, $question);

                $selectedIndex = array_search($selectedDomain, $options);

                if ($selectedIndex !== false and array_key_exists($selectedIndex, $domains)) {
                    $domainsToMigrate[] = $domains[$selectedIndex];
                } else {
                    /* Sanity check. This is unlikely to happen */
                    $output->writeln("\n<error>Error: Domain not found!</error>");
                }
            }
        }
        if ($domainsToMigrate) {
            foreach ($domainsToMigrate as $domain) {
                $this->executeDomainMigrations($domain, $input, $output);
            }
        }
        $output->writeln("<comment>Migrations Finished.</comment>\n\n");
    }

    private function executeMainMigrations(OutputInterface $output)
    {
        /* Main Migration */
        $mainDbConnection = $this->getContainer()->get("doctrine.dbal.main_connection");

        $mainConfig = new Configuration($mainDbConnection);
        $mainConfig->setMigrationsTableName('migration_versions');
        $mainConfig->setMigrationsNamespace("Application\\Migrations");
        $mainConfig->setMigrationsDirectory(__DIR__ . "/../../../../app/DoctrineMigrations/Main");

        $migration = new Migration($mainConfig);
        try {
            $migration->migrate();
            $output->writeln("<comment>Main migration executed successfully.</comment>\n\n");
        } catch (\Exception $e) {
            $output->writeln("<error>Error to execute Main migration.</error>\n");
            $output->writeln("<error>\"Error message: " . $e->getMessage() . "</error>\n");
        }

    }

    private function executeDomainMigrations(Domain $domain,InputInterface $input, OutputInterface $output)
    {
        if ($domain) {
            $output->writeln("\n<info>Migrating domain '".$domain->getName()."':</info>");

            /* Sets domain as active domain */
            $this->getContainer()->get("upgrade")->setDomain($domain);

            /* Domain Migration */
            $domainDbConnection = $this->getContainer()->get("database_connection");

            $domainConfig = new Configuration($domainDbConnection);
            $domainConfig->setMigrationsTableName('migration_versions');
            $domainConfig->setMigrationsNamespace("Application\\Migrations");
            $domainConfig->setMigrationsDirectory(__DIR__."/../../../../app/DoctrineMigrations/Domain");

            $migration = new Migration($domainConfig);

            try {
                $migration->migrate();
                $output->writeln("<comment>Domain (".$domain->getName().") migration executed successfully.</comment>\n\n");
            } catch (\Exception $e) {
                $output->writeln("<error>Error to execute Domain ". $domain->getName() ."  migration.</error>\n");
                $output->writeln("<error>\"Error message: " . $e->getMessage() . "</error>\n");
            }
        }
    }
}
