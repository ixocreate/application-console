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
namespace KiwiSuite\ApplicationConsole\ConfiguratorItem;

use KiwiSuite\Application\ConfiguratorItem\ConfiguratorItemInterface;
use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

final class ConsoleConfiguratorItem implements ConfiguratorItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator()
    {
        return new ServiceManagerConfigurator(ConsoleServiceManagerConfig::class);
    }

    /**
     * @return string
     */
    public function getConfiguratorName(): string
    {
        return 'serviceManagerConfigurator';
    }

    /**
     * @return string
     */
    public function getConfiguratorFileName(): string
    {
        return 'console.php';
    }

    /**
     * @param ServiceManagerConfigurator $configurator
     * @return \Serializable
     */
    public function getService($configurator): \Serializable
    {
        return $configurator->getServiceManagerConfig();
    }
}
