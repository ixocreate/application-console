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
namespace IxocreateTest\ApplicationConsoleFactory;

use Ixocreate\ApplicationConsole\ConsoleServiceManagerConfig;
use Ixocreate\ApplicationConsole\ConsoleSubManager;
use Ixocreate\ApplicationConsole\Factory\ConsoleSubManagerFactory;
use Ixocreate\ServiceManager\ServiceManager;
use Ixocreate\ServiceManager\ServiceManagerConfig;
use Ixocreate\ServiceManager\ServiceManagerSetup;
use PHPUnit\Framework\TestCase;

class ConsoleSubManagerFactoryTest extends TestCase
{
    public function testCreate()
    {
        $container = new ServiceManager(
            new ServiceManagerConfig([]),
            new ServiceManagerSetup(),
            [
                ConsoleServiceManagerConfig::class => new ConsoleServiceManagerConfig([]),
            ]
        );

        $consoleSubManagerFactory = new ConsoleSubManagerFactory();
        $result = $consoleSubManagerFactory->__invoke($container, ConsoleSubManager::class);

        $this->assertInstanceOf(ConsoleSubManager::class, $result);
    }
}
