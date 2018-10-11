<?php

namespace Harmony\Application\Console;

use Psr\Log\LoggerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

final class Console
{
    private $logger;
    private $cli;

    public function __construct(LoggerInterface $logger, Application $cli)
    {
        $this->logger = $logger;
        $this->cli = $cli;
    }

    public function execute(InputInterface $input, OutputInterface $output): int
    {
        try {
            return $this->cli->run($input, $output);
        } catch (\Throwable $e) {
            $message = get_class($e) . " during '{$input->getFirstArgument()}' with message: {$e->getMessage()}";

            $output->writeln("<error> ERROR </error> $message");

            $this->logger->error(
                $message,
                ['exception' => $e]
            );

            return 1;
        }
    }
}
