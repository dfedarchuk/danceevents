<?php

namespace ArcaSolutions\UpgradeBundle\Command;

use Symfony\Bundle\FrameworkBundle\Command\ContainerAwareCommand;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

class UpgradeCommand extends ContainerAwareCommand
{
    protected function configure()
    {
        $this
            ->setName('edirectory:upgrade')
            ->setDefinition([
                new InputOption('force', '', InputOption::VALUE_NONE, 'Execute even if user is root.'),
                new InputOption('no-query', '', InputOption::VALUE_NONE, 'Skips Queries.'),
                new InputOption('no-handler', '', InputOption::VALUE_NONE, 'Skips Handlers.'),
                new InputOption('keep-name', '', InputOption::VALUE_NONE, 'Skip folder renaming after upgrade is successful'),
            ])
            ->setDescription('Applies upgrade packages.')
            ->setHelp(<<<EOF
The <info>%command.name%</info> performs all upgrade instructions contained inside the version-numbered packages inside
the <info>Resources/upgrades</info> folder

  <info>php %command.full_name% --force</info> (Ignores root verification)
  <info>php %command.full_name% --no-query</info> (Skips execution of queries)
  <info>php %command.full_name% --no-handler</info> (Skips execution of handlers)
  <info>php %command.full_name% --keep-name</info> (Maintains folder name after upgrade is successful)
EOF
            );
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {

        if ($input->getOption('force') || 0 != posix_getuid()) {
            $output->writeln("<comment>Upgrade Started</comment>");

            $this->getContainer()->get("upgrade")->upgrade(
                $output,
                $input->getOption('keep-name'),
                $input->getOption('no-query'),
                $input->getOption('no-handler')
            );

            $output->writeln("<comment>Upgrade Finished</comment>");

        } else {
            $output->writeln(<<<HTML


<error> Command running as root user! </error>

          .-------,
        .'         '.
      .'  _ ___ _ __ '.
      |  (_' | / \|_) |
      |  ,_) | \_/|   |
      '.             .'
        '.         .'
          '-------'

This could potentially mess up permissions around the project.
If you are REALLY sure you want to run as root, use the <comment>--force</comment> parameter.


HTML
            );
        }

    }
}
