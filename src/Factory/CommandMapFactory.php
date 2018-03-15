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

use KiwiSuite\ApplicationConsole\CommandMapping;
use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\Contract\ServiceManager\FactoryInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
use KiwiSuite\ServiceManager\Exception\ServiceNotCreatedException;

class CommandMapFactory implements FactoryInterface
{
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        $commandMap = $container->get(CommandMapping::class)->getMapping();

        if (!\array_key_exists($requestedName, $commandMap)) {
            throw new ServiceNotCreatedException(\sprintf('Unable to create command %s. Name not found in CommandMap', $requestedName));
        }

        return $container->get(ConsoleSubManager::class)->get($commandMap[$requestedName]);
    }
}
