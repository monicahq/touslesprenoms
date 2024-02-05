<?php

namespace App\Console\Commands;

use Illuminate\Console\Command as CommandBase;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @codeCoverageIgnore
 */
abstract class Command extends CommandBase
{
    protected function artisan(string $message, string $command, array $options = []): void
    {
        $this->info($message);
        $this->getOutput()->getOutput()->getVerbosity() >= OutputInterface::VERBOSITY_VERBOSE
            ? $this->call($command, $options)
            : $this->callSilent($command, $options);
    }
}
