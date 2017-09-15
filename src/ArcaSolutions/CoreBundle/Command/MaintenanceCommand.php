<?php

namespace ArcaSolutions\CoreBundle\Command;


use ArcaSolutions\MultiDomainBundle\Command\AbstractMultiDomainCommand;
use ArcaSolutions\WebBundle\Entity\Setting;
use Doctrine\ORM\EntityManager;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

/**
 * Class MaintenanceCommand
 *
 * @package ArcaSolutions\CoreBundle\Command
 */
class MaintenanceCommand extends AbstractMultiDomainCommand
{
    /**
     * Configures the current command.
     */
    protected function configure()
    {
        $this
            ->setName('edirectory:maintenance')
            ->setDefinition([
                new InputOption('on', '', InputOption::VALUE_NONE, 'Set On'),
                new InputOption('off', '', InputOption::VALUE_NONE, 'Set Off'),
            ])
            ->setDescription('Turns on/off the maintenance mode.')
            ->setHelp(<<<EOF
The <info>%command.name%</info> turn on/off the maintenance mode

  <info>php %command.full_name% --all</info> (Execute in all domains)
EOF
            );

        parent::configure();
    }

    /**
     * Executes the current command.
     *
     * @param InputInterface $input
     * @param OutputInterface $output
     *
     * @return null|int null or 0 if everything went fine, or an error code
     */
    protected function execute(InputInterface $input, OutputInterface $output)
    {
        /* Style */
        $style = new SymfonyStyle($input, $output);

        /* MultiDomain */
        $multiDomain = $this->getMultiDomain($input);
        $this->outputHeader($style, $output);

        /* Gets value informed by user */
        $value = $input->getOption('on') ? 'on' : 'off';

        if ($multiDomain->getActiveHost()) {
            $this->getConnection();
            try {
                $this->saveMaintenance($value);
                $style->success("Maintenance Mode: ".strtoupper($value));
            } catch (\Exception $e) {
                $style->error("Could not execute: ".$this->getName());
            }
        } else {
            foreach ($multiDomain->getHostConfig() as $domain => $info) {
                $this->setDomain($domain);
                $this->getConnection();

                try {
                    $this->saveMaintenance($value);
                    $style->success($this->multiDomian->getOriginalActiveHost());
                } catch (\Exception $e) {
                    $style->error("Could not execute: ".$this->getName());
                    continue;
                }
            }
        }
    }

    /**
     * Save the new value in Maintenance Setting
     *
     * @param $value
     */
    private function saveMaintenance($value)
    {
        /* @var EntityManager $em */
        $em = $this->getContainer()->get("doctrine")->getManager();

        /* @var Setting $main */
        $main = $em->getRepository('WebBundle:Setting')->findOneByName('maintenance_mode');
        $main->setValue($value);

        $em->persist($main);
        $em->flush($main);
    }
}
