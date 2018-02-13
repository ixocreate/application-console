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
namespace KiwiSuite\ApplicationConsole\Bootstrap;

use KiwiSuite\Application\Bootstrap\BootstrapInterface;
use KiwiSuite\Application\ConfiguratorItem\ConfiguratorRegistry;
use KiwiSuite\Application\Service\ServiceRegistry;
use KiwiSuite\ApplicationConsole\ConfiguratorItem\ConsoleConfiguratorItem;
use KiwiSuite\ApplicationConsole\Console\ConsoleRunner;
use KiwiSuite\ApplicationConsole\Console\Factory\ConsoleRunnerFactory;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ApplicationConsole\Factory\ConsoleSubManagerFactory;
use KiwiSuite\ServiceManager\ServiceManager;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

final class ConsoleApplicationBootstrap implements BootstrapInterface
{

    /**
     * @param ConfiguratorRegistry $configuratorRegistry
     */
    public function configure(ConfiguratorRegistry $configuratorRegistry): void
    {
        /** @var ServiceManagerConfigurator $serviceManagerConfigurator */
        $serviceManagerConfigurator = $configuratorRegistry->getConfigurator('serviceManagerConfigurator');

        $serviceManagerConfigurator->addFactory(ConsoleRunner::class, ConsoleRunnerFactory::class);
        $serviceManagerConfigurator->addSubManager(ConsoleSubManager::class, ConsoleSubManagerFactory::class);
    }

    /**
     * @param ServiceRegistry $serviceRegistry
     */
    public function addServices(ServiceRegistry $serviceRegistry): void
    {
    }

    /**
     * @return array|null
     */
    public function getConfiguratorItems(): ?array
    {
        return [
            ConsoleConfiguratorItem::class,
        ];
    }

    /**
     * @return array|null
     */
    public function getDefaultConfig(): ?array
    {
        return null;
    }

    /**
     * @param ServiceManager $serviceManager
     */
    public function boot(ServiceManager $serviceManager): void
    {
    }
}
