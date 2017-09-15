<?php

namespace ArcaSolutions\ElasticsearchBundle\Command;

use ArcaSolutions\CoreBundle\Entity\Domain;
use ArcaSolutions\CoreBundle\Search\CategoryConfiguration;
use ArcaSolutions\ElasticsearchBundle\Services\Synchronization\Synchronization;
use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Helper\ProgressBar;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Question\ChoiceQuestion;

class SynchronizeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('edirectory:synchronize')
            ->setDefinition([
                new InputOption(
                    'recreate-index',
                    'r',
                    InputOption::VALUE_NONE,
                    'Recreates the entire index from scratch.
                    If this option is not provided, the index will not be rebuilt unless missing.'
                ),
                new InputOption(
                    'force-domain',
                    'f',
                    InputOption::VALUE_REQUIRED,
                    'Defines which domain will be synchronized.
                    Use either the domain url (ie: demodirectory.com)
                    or the domain id (ie: 1)

                    If this option is not provided, you will be prompted'
                ),
                new InputOption(
                    'bulk-size',
                    'b',
                    InputOption::VALUE_REQUIRED,
                    'Defines how many items will be updated in a cycle.
                    Defaults to '.Synchronization::BULK_THRESHOLD
                ),
                new InputOption(
                    'module',
                    'm',
                    InputOption::VALUE_OPTIONAL | InputOption::VALUE_IS_ARRAY,
                    'Defines which modules will be synchronized. Available options are:

                    - article
                    - blog
                    - classified
                    - deal
                    - event
                    - listing
                    - articleCategory
                    - blogCategory
                    - classifiedCategory
                    - eventCategory
                    - listingCategory
                    - badge
                    - location

                    If this option is not provided, all modules will be synchronized',
                    []
                ),
                new InputOption(
                    'all-domains',
                    'a',
                    InputOption::VALUE_NONE,
                    'Execute the synchronize for all domains.'
                ),
            ])
            ->setDescription('Synchronizes MySQL and Elasticsearch.')
            ->setHelp(<<<EOF
The <info>%command.name%</info> command will attempt to synchronize all modules, categories, locations and badges, pulling data from the MySQL database into elasticsearch

  <info>php %command.full_name% --recreate-index</info> (Forces index deletion and recreation)
  <info>php %command.full_name% --force-domain=1</info> (Forces a specific domain (By it's id) and prevents domain prompt)
  <info>php %command.full_name% --force-domain=demodirectory.com</info> (Forces a specific domain (By it's URL) and prevents domain prompt)
  <info>php %command.full_name% --bulk-size=250</info> (Forces a specific amount of items per synchronization cycle)
  <info>php %command.full_name% --module=listing</info> (If provided, only selected module (listing) will be syncronized)
  <info>php %command.full_name% --module=listing --module=location</info> (If provided, only selected modules (listing and locations) will be syncronized)
  <info>php %command.full_name% --all-domains</info> (Synchronize all domains)
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln("<comment>Synchronization Initiated</comment>");

        if (defined("DOMAIN_NOT_SELECTED") and DOMAIN_NOT_SELECTED) {
            $output->writeln("<error> You MUST provide a valid domain url using the --domain=demodirectory.com option</error>");
            exit();
        }

        $doctrine = $this->getContainer()->get("doctrine");
        $domainRepository = $doctrine->getRepository("CoreBundle:Domain", "main");

        /* @var Domain[] $domains */
        $domainsToSynchronize = null;

        /* @var Domain $domain */
        $domain = null;

        /* Checks if user has provided a specific domain through command options */
        if ($forcedDomain = $input->getOption('force-domain')) {
            if (is_numeric($forcedDomain)) {
                /* User has provided an ID */
                $domain = $domainRepository->find($forcedDomain);
            } else {
                /* User has provided an URL */
                $domain = $domainRepository->findOneBy(["url" => $forcedDomain]);
            }
            $domainsToSynchronize[] = $domain;
            if (!$domain) {
                $output->writeln("<error>The domain provided did not match any available domain.</error>");
            }
        } elseif ($allDomainsOption = $input->getOption('all-domains')) {
            /* get all domains active to synchronize */
            $domainsToSynchronize = $domainRepository->findBy(["status" => "A"]);
            if (!$domainsToSynchronize) {
                $output->writeln("\n<error>Error: No domain active found!</error>");
            }
        } elseif ($domains = $domainRepository->findBy(["status" => "A"])) {
            /* Only one domain is available. Let's use it, no questions asked */
            if (count($domains) == 1) {
                $domainsToSynchronize = $domains;
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
                    "Which domain do you want to Synchronize? (Defaults to '{$options[0]}')",
                    $options,
                    $options[0]
                );

                $selectedDomain = $this->getHelper('question')->ask($input, $output, $question);

                $selectedIndex = array_search($selectedDomain, $options);

                if ($selectedIndex !== false and array_key_exists($selectedIndex, $domains)) {
                    $domainsToSynchronize[] = $domains[$selectedIndex];
                } else {
                    /* Sanity check. This is unlikely to happen */
                    $output->writeln("\n<error>Error: Domain not found!</error>");
                }
            }
        }
        if ($domainsToSynchronize) {
            foreach ($domainsToSynchronize as $domain) {
                $this->synchronizeDomain($domain, $input, $output);
            }
        }
        $output->writeln("<comment>Synchronization Finished.</comment>\n\n");
    }

    /**
     * Synchronizes one domain
     *
     * @param Domain $domain
     * @param InputInterface $input
     * @param OutputInterface $output
     */
    private function synchronizeDomain(Domain $domain, InputInterface $input, OutputInterface $output)
    {
        if ($domain) {
            $output->writeln("\n<info>Synchronizing domain '".$domain->getName()."':</info>");

            /* Sets domain as active domain */
            $this->getContainer()->get("upgrade")->setDomain($domain);

            $searchEngine = $this->getContainer()->get("search.engine");

            /* Recreates index if option is set */
            if ($input->getOption('recreate-index')) {
                $this->getContainer()->get("elasticsearch.synchronization")->createIndex();

                $output->writeln("\n<info>Recreating Index...</info>");
                $progressBar = new ProgressBar($output, 10);
                $progressBar->start();

                for ($i = 0; $i < 10; $i++) {
                    sleep(1);
                    $progressBar->advance(1);
                }

                $progressBar->finish();
                $output->writeln("\n<info>Index Recreated.</info>");
            }

            $availableModules = [
                "article"            => 1,
                "blog"               => 1 << 1,
                "classified"         => 1 << 2,
                "deal"               => 1 << 3,
                "event"              => 1 << 4,
                "listing"            => 1 << 5,
                "articleCategory"    => 1 << 6,
                "blogCategory"       => 1 << 7,
                "classifiedCategory" => 1 << 8,
                "eventCategory"      => 1 << 9,
                "listingCategory"    => 1 << 10,
                "badge"              => 1 << 11,
                "location"           => 1 << 12,
            ];

            $moduleFlags = 0;

            if ($selectedModules = $input->getOption('module')) {
                while ($module = array_pop($selectedModules)) {
                    if (array_key_exists($module, $availableModules)) {
                        $moduleFlags |= $availableModules[$module];
                    }
                }
            }

            $output->writeln("\n<comment>############### Modules ###############</comment>");

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["article"]) {
                $output->writeln("\n<info>========= Article =========</info>");
                $this->synchronize($output, "article.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["blog"]) {
                $output->writeln("\n<info>========= Blog =========</info>");
                $this->synchronize($output, "blog.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["classified"]) {
                $output->writeln("\n<info>========= Classified =========</info>");
                $this->synchronize($output, "classified.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["deal"]) {
                $output->writeln("\n<info>========= Deal =========</info>");
                $this->synchronize($output, "deal.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["event"]) {
                $output->writeln("\n<info>========= Event =========</info>");
                $this->synchronize($output, "event.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["listing"]) {
                $output->writeln("\n<info>========= Listing =========</info>");
                $this->synchronize($output, "listing.synchronization");
            }

            $output->writeln("\n<comment>############### Categories ###############</comment>");

            $categoryFlags = $availableModules["articleCategory"] | $availableModules["blogCategory"] | $availableModules["classifiedCategory"] | $availableModules["eventCategory"] | $availableModules["listingCategory"];

            if ($moduleFlags === 0 or $moduleFlags & $categoryFlags) {
                $searchEngine->clearType(CategoryConfiguration::$elasticType);
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["articleCategory"]) {
                $output->writeln("\n<info>========= Article Category =========</info>");
                $this->synchronize($output, "article.category.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["blogCategory"]) {
                $output->writeln("\n<info>========= Blog Category =========</info>");
                $this->synchronize($output, "blog.category.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["classifiedCategory"]) {
                $output->writeln("\n<info>========= Classified Category =========</info>");
                $this->synchronize($output, "classified.category.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["eventCategory"]) {
                $output->writeln("\n<info>========= Event Category =========</info>");
                $this->synchronize($output, "event.category.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["listingCategory"]) {
                $output->writeln("\n<info>========= Listing Category =========</info>");
                $this->synchronize($output, "listing.category.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["badge"]) {
                $output->writeln("\n<comment>############### Badges ###############</comment>\n");
                $this->synchronize($output, "badge.synchronization");
            }

            if ($moduleFlags === 0 or $moduleFlags & $availableModules["location"]) {
                $output->writeln("\n<comment>############### Locations ###############</comment>\n");
                $this->synchronize($output, "location.synchronization");
            }

            if ($index = $searchEngine->getElasticaIndex() and $response = $index->flush()) {
                if ($response->getError()) {
                    $output->writeln("\n<error>Elasticsearch flush failed! Is the server dead?</error>");
                } else {
                    $output->writeln("\nFlushing all bulk actions for the selected index....\n");
                }
            }
        }
    }

    /**
     * @param OutputInterface $output
     * @param $synchronizable
     */
    protected function synchronize(OutputInterface $output, $synchronizable)
    {
        $start = microtime(true);
        $this->getContainer()->get($synchronizable)->generateAll($output);
        $this->getContainer()->get("elasticsearch.synchronization")->synchronize();
        $duration = "\n\nOperation took ".(microtime(true) - $start)." seconds.";
        $output->writeln($duration);
    }
}
