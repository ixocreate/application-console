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
namespace Ixocreate\ApplicationConsole\Factory;

use Ixocreate\ApplicationConsole\CommandMapping;
use Ixocreate\ApplicationConsole\ConsoleSubManager;
use Ixocreate\Contract\ServiceManager\FactoryInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Ixocreate\ServiceManager\Exception\ServiceNotCreatedException;

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
