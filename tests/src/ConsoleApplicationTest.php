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
namespace KiwiSuiteTest\ApplicationConsole;

use KiwiSuite\Application\ApplicationConfigurator;
use KiwiSuite\ApplicationConsole\Bootstrap\ConsoleBootstrap;
use KiwiSuite\ApplicationConsole\ConsoleApplication;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\Config\Bootstrap\ConfigBootstrap;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
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
