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
namespace KiwiSuite\ApplicationConsole;

use KiwiSuite\Application\ApplicationConfigurator;
use KiwiSuite\Application\ApplicationInterface;
use KiwiSuite\Application\Bootstrap;
use KiwiSuite\ApplicationConsole\Bootstrap\ConsoleBootstrap;
use KiwiSuite\ApplicationConsole\Factory\ConsoleFactory;
use KiwiSuite\ApplicationConsole\Factory\ConsoleSubManagerFactory;
use KiwiSuite\Config\Bootstrap\ConfigBootstrap;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;
use Symfony\Component\Console\Application;

final class ConsoleApplication implements ApplicationInterface
{

    /**
     * @var string
     */
    private $bootstrapDirectory;

    /**
     * ConsoleApplication constructor.
     * @param string $bootstrapDirectory
     */
    public function __construct(string $bootstrapDirectory)
    {
        $this->bootstrapDirectory = $bootstrapDirectory;
    }

    /**
     * @throws \Exception
     * @codeCoverageIgnore
     */
    public function run(): void
    {
        $bootstrap = new Bootstrap();
        $serviceManager = $bootstrap->bootstrap($this->bootstrapDirectory, $this);
        $serviceManager->get(Application::class)->run();
    }

    /**
     * @param ApplicationConfigurator $applicationConfigurator
     * @return mixed
     */
    public function configureApplicationConfig(ApplicationConfigurator $applicationConfigurator)
    {
        $applicationConfigurator->addBootstrapItem(ConfigBootstrap::class, 50);
        $applicationConfigurator->addBootstrapItem(ConsoleBootstrap::class, 100);
    }

    /**
     * @param ServiceManagerConfigurator $serviceManagerConfigurator
     */
    public function configureServiceManager(ServiceManagerConfigurator $serviceManagerConfigurator): void
    {
        $serviceManagerConfigurator->addSubManager(ConsoleSubManager::class, ConsoleSubManagerFactory::class);
        $serviceManagerConfigurator->addFactory(Application::class, ConsoleFactory::class);
    }
}
