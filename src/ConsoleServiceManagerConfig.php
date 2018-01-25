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

use KiwiSuite\ApplicationConsole\Factory\CommandMapFactory;
use KiwiSuite\ServiceManager\ServiceManagerConfig;

final class ConsoleServiceManagerConfig extends ServiceManagerConfig
{
    /**
     * @var array
     */
    private $commandMap = [];

    public function __construct(
        array $commandMap = [],
        array $factories = [],
        array $subManagers = [],
        array $delegators = [],
        array $lazyServices = [],
        array $disabledSharing = [],
        array $initializers = []
    ) {
        $this->commandMap = $commandMap;
        foreach ($commandMap as $commandName => $id) {
            $factories[$commandName] = CommandMapFactory::class;
        }

        parent::__construct($factories, $disabledSharing, $delegators, $initializers, $lazyServices, $subManagers);
    }

    /**
     * @return array
     */
    public function getCommandMap()
    {
        return $this->commandMap;
    }

    public function serialize()
    {
        return \serialize([
            'commandMap' => $this->commandMap,
            'config' => $this->getInternalConfig(),
        ]);
    }

    public function unserialize($serialized)
    {
        $data = \unserialize($serialized);

        $this->commandMap = $data['commandMap'];
        $this->setInternalConfig($data['config']);
    }
}
