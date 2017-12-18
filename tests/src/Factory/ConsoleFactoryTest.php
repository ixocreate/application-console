<?php
/**
 * kiwi-suite/application (https://github.com/kiwi-suite/application-console)
 *
 * @package kiwi-suite/application-console
 * @see https://github.com/kiwi-suite/application-console
 * @copyright Copyright (c) 2010 - 2017 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuiteTest\ApplicationConsoleFactory;

use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ApplicationConsole\Factory\ConsoleFactory;
use KiwiSuite\ApplicationConsole\Factory\ConsoleSubManagerFactory;
use KiwiSuite\ServiceManager\Factory\AutowireFactory;
use KiwiSuite\ServiceManager\ServiceManager;
use KiwiSuite\ServiceManager\ServiceManagerConfig;
use KiwiSuite\ServiceManager\ServiceManagerSetup;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\HelpCommand;

class ConsoleFactoryTest extends TestCase
{
    public function testCreate()
    {
        $container = new ServiceManager(
            new ServiceManagerConfig([
                'subManagers' => [
                    ConsoleSubManager::class    => ConsoleSubManagerFactory::class,
                ],
            ]),
            new ServiceManagerSetup(),
            [
                ConsoleServiceManagerConfig::class => new ConsoleServiceManagerConfig([
                    'factories' => [
                        HelpCommand::class => AutowireFactory::class,
                    ],
                ]),
            ]
        );

        $consoleFactory = new ConsoleFactory();
        $result = $consoleFactory->__invoke($container, ConsoleFactory::class);

        $this->assertInstanceOf(Application::class, $result);
    }
}
