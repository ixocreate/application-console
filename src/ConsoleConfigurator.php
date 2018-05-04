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

use KiwiSuite\ApplicationConsole\Factory\CommandInitializer;
use KiwiSuite\ApplicationConsole\Factory\CommandMapFactory;
use KiwiSuite\Contract\Application\ConfiguratorInterface;
use KiwiSuite\Contract\Application\ServiceRegistryInterface;
use KiwiSuite\Contract\Command\CommandInterface;
use KiwiSuite\Entity\Exception\InvalidArgumentException;
use KiwiSuite\ServiceManager\Factory\AutowireFactory;
use KiwiSuite\ServiceManager\SubManager\SubManagerConfigurator;

final class ConsoleConfigurator implements ConfiguratorInterface
{
    /**
     * @var SubManagerConfigurator
     */
    private $subManagerConfigurator;

    /**
     * MiddlewareConfigurator constructor.
     */
    public function __construct()
    {
        $this->subManagerConfigurator = new SubManagerConfigurator(ConsoleSubManager::class, CommandInterface::class);
        $this->subManagerConfigurator->addInitializer(CommandInitializer::class);
    }

    /**
     * @param string $directory
     * @param bool $recursive
     */
    public function addDirectory(string $directory, bool $recursive = true): void
    {
        $this->subManagerConfigurator->addDirectory($directory, $recursive);
    }

    /**
     * @param string $action
     * @param string $factory
     */
    public function addCommand(string $action, string $factory = AutowireFactory::class): void
    {
        $this->subManagerConfigurator->addFactory($action, $factory);
    }

    /**
     * @param ServiceRegistryInterface $serviceRegistry
     * @return void
     */
    public function registerService(ServiceRegistryInterface $serviceRegistry): void
    {
        $factories = $this->subManagerConfigurator->getServiceManagerConfig()->getFactories();

        $commandMap = [];
        foreach ($factories as $id => $factory) {
            if (!\is_subclass_of($id, CommandInterface::class, true)) {
                throw new InvalidArgumentException(\sprintf("'%s' doesn't implement '%s'", $id, CommandInterface::class));
            }
            $commandName = \forward_static_call([$id, 'getCommandName']);
            $commandMap[$commandName] = $id;

            $this->addCommand($commandName, CommandMapFactory::class);
        }

        $serviceRegistry->add(CommandMapping::class, new CommandMapping($commandMap));
        $this->subManagerConfigurator->registerService($serviceRegistry);
    }
}
