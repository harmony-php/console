<?php

namespace Harmony\Application\Console;

use Harmony\Application\Console\Command\Healthcheck;
use PHPUnit\Framework\TestCase;
use Psr\Log\NullLogger;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\StringInput;
use Symfony\Component\Console\Output\ConsoleOutput;

class ConsoleTest extends TestCase
{
    /**
     * @var Console
     */
    private $console;

    public function setUp()
    {
        $app = new Application('Harmony Test CLI Application');
        $app->setAutoExit(false);
        $app->setCatchExceptions(false);
        $app->add(new Healthcheck);

        $this->console = new Console(new NullLogger, $app);
    }

    public function test_known_command_executes_as_expected()
    {
        $this->assertEquals(0, $this->console->execute(new StringInput('healthcheck'), new ConsoleOutput));
    }

    public function test_invalid_command_returns_error_code()
    {
        $this->assertEquals(1, $this->console->execute(new StringInput(random_bytes(32)), new ConsoleOutput));
    }
}
