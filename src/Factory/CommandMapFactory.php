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
namespace KiwiSuite\ApplicationConsole\Factory;

use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ServiceManager\Exception\ServiceNotCreatedException;
use KiwiSuite\ServiceManager\FactoryInterface;
use KiwiSuite\ServiceManager\ServiceManagerInterface;

class CommandMapFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $config = $container->get(ConsoleServiceManagerConfig::class);
        $commandMap = $config->getCommandMap();

        if (!\array_key_exists($requestedName, $commandMap)) {
            throw new ServiceNotCreatedException(\sprintf('Unable to create command %s. Name not found in CommandMap', $requestedName));
        }

        return $container->get(ConsoleSubManager::class)->get($commandMap[$requestedName]);
    }
}
