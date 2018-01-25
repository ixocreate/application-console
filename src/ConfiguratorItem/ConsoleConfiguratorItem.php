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
use KiwiSuite\Application\Exception\InvalidArgumentException;
use KiwiSuite\ApplicationConsole\Command\CommandInterface;
use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuite\ServiceManager\ServiceManagerConfig;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

final class ConsoleConfiguratorItem implements ConfiguratorItemInterface
{
    /**
     * @return mixed
     */
    public function getConfigurator()
    {
        return new ServiceManagerConfigurator(ServiceManagerConfig::class);
    }

    /**
     * @return string
     */
    public function getConfiguratorName(): string
    {
        return 'consoleServiceManagerConfigurator';
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
        $config = $configurator->getServiceManagerConfig();

        $factories = $configurator->getFactories();

        $commandMap = [];
        foreach ($factories as $id => $factory) {
            if (!\is_subclass_of($id, CommandInterface::class, true)) {
                throw new InvalidArgumentException(\sprintf("'%s' doesn't implement '%s'", $id, CommandInterface::class));
            }
            $commandName = \forward_static_call([$id, 'getCommandName']);
            $commandMap[$commandName] = $id;
        }

        return new ConsoleServiceManagerConfig(
            $commandMap,
            $config->getFactories(),
            $config->getSubManagers(),
            $config->getDelegators(),
            $config->getLazyServices(),
            $config->getDisabledSharing(),
            $config->getInitializers()
        );
    }
}
