<?php

namespace Harmony\Application\Console\Command;

use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class Healthcheck extends Command
{
    protected function configure()
    {
        $this->setName("healthcheck")
            ->setDescription("Check whether the console is available");
    }

    protected function execute(InputInterface $input, OutputInterface $output)
    {
        $output->writeln('<info>Success!</info>');
    }
}
