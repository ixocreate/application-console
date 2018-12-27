<?php
/**
 * kiwi-suite/application-console (https://github.com/kiwi-suite/application-console)
 *
 * @package kiwi-suite/application-console
 * @see https://github.com/kiwi-suite/application-console
 * @copyright Copyright (c) 2010 - 2018 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace Ixocreate\ApplicationConsole\Console;

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
