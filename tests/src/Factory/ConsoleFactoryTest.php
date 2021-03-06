<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace IxocreateTest\ApplicationConsoleFactory;

use Ixocreate\ApplicationConsole\ConsoleServiceManagerConfig;
use Ixocreate\ApplicationConsole\ConsoleSubManager;
use Ixocreate\ApplicationConsole\Factory\ConsoleFactory;
use Ixocreate\ApplicationConsole\Factory\ConsoleSubManagerFactory;
use Ixocreate\ServiceManager\Factory\AutowireFactory;
use Ixocreate\ServiceManager\ServiceManager;
use Ixocreate\ServiceManager\ServiceManagerConfig;
use Ixocreate\ServiceManager\ServiceManagerSetup;
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
