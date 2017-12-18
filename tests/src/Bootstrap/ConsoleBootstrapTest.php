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
namespace KiwiSuiteTest\ApplicationConsole\Bootstrap;

use KiwiSuite\Application\ApplicationConfig;
use KiwiSuite\Application\Bootstrap\BootstrapRegistry;
use KiwiSuite\ApplicationConsole\Bootstrap\ConsoleBootstrap;
use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuiteMisc\ApplicationConsole\ModuleTest;
use PHPUnit\Framework\TestCase;

class ConsoleBootstrapTest extends TestCase
{
    /**
     * @var ApplicationConfig
     */
    private $applicationConfig;

    public function setUp()
    {
        $this->applicationConfig = new ApplicationConfig(
            true,
            null,
            __DIR__ . '/../../bootstrap',
            null,
            null,
            null,
            [ModuleTest::class]
        );
    }

    public function testBootstrap()
    {
        $bootstrapRegistry = new BootstrapRegistry($this->applicationConfig->getModules());

        $consoleBootstrap = new ConsoleBootstrap();
        $consoleBootstrap->bootstrap($this->applicationConfig, $bootstrapRegistry);

        $this->assertTrue($bootstrapRegistry->hasService(ConsoleServiceManagerConfig::class));
    }
}
