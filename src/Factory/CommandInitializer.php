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
namespace KiwiSuite\ApplicationConsole\Factory;

use KiwiSuite\ApplicationConsole\Console\ConsoleRunner;
use KiwiSuite\Contract\ServiceManager\InitializerInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use Symfony\Component\Console\Command\Command;

class CommandInitializer implements InitializerInterface
{
    public function __invoke(ServiceManagerInterface $container, $instance): void
    {
        if ($instance instanceof Command) {
            $instance->setApplication($container->get(ConsoleRunner::class));
        }
    }
}
