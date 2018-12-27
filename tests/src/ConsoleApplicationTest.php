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
namespace IxocreateTest\ApplicationConsole;

use Ixocreate\Application\ApplicationConfigurator;
use Ixocreate\ApplicationConsole\Bootstrap\ConsoleBootstrap;
use Ixocreate\ApplicationConsole\ConsoleApplication;
use Ixocreate\ApplicationConsole\ConsoleSubManager;
use Ixocreate\Config\Bootstrap\ConfigBootstrap;
use Ixocreate\ServiceManager\ServiceManagerConfigurator;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Console\Application;

class ConsoleApplicationTest extends TestCase
{
    public function testConfigureApplicationConfig()
    {
        $consoleApplication = new ConsoleApplication("bootstrap");
        $applicationConfigurator = new ApplicationConfigurator("bootstrap");
        $consoleApplication->configureApplicationConfig($applicationConfigurator);

        $applicationConfig = $applicationConfigurator->getApplicationConfig();

        $this->assertInstanceOf(ConsoleBootstrap::class, $applicationConfig->getBootstrapQueue()[0]);
        $this->assertInstanceOf(ConfigBootstrap::class, $applicationConfig->getBootstrapQueue()[1]);
    }

    public function testConfigureServiceManager()
    {
        $consoleApplication = new ConsoleApplication("bootstrap");
        $serviceManagerConfigurator = new ServiceManagerConfigurator();
        $consoleApplication->configureServiceManager($serviceManagerConfigurator);

        $serviceManagerConfig = $serviceManagerConfigurator->getServiceManagerConfig();

        $this->assertArrayHasKey(Application::class, $serviceManagerConfig->getFactories());
        $this->assertArrayHasKey(ConsoleSubManager::class, $serviceManagerConfig->getSubManagers());
    }
}
