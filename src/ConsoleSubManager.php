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
namespace Ixocreate\ApplicationConsole;

use Ixocreate\ApplicationConsole\Factory\CommandMapFactory;
use Ixocreate\ServiceManager\SubManager\SubManager;
use Symfony\Component\Console\CommandLoader\CommandLoaderInterface;

final class ConsoleSubManager extends SubManager implements CommandLoaderInterface
{
    /**
     * @return array|string[]
     */
    public function getNames(): array
    {
        $names = [];
        foreach ($this->getServiceManagerConfig()->getFactories() as $name => $factory) {
            if ($factory === CommandMapFactory::class) {
                $names[] = $name;
            }
        }
        return $names;
    }
}
