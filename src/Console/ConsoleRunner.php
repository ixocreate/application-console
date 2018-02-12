<?php
namespace KiwiSuite\ApplicationConsole\Console;

use Symfony\Component\Console\Application;
use Symfony\Component\Console\Input\InputOption;

final class ConsoleRunner extends Application
{
    protected function getDefaultInputDefinition()
    {
        $inputDefinition = parent::getDefaultInputDefinition();

        $inputDefinition->addOption(
            new InputOption('--development', '-d', InputOption::VALUE_NONE, 'Runs command in development mode')
        );

        return $inputDefinition;
    }
}
