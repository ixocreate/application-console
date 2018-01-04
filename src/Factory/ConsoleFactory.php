<?php
/**
 * kiwi-suite/application-console (https://github.com/kiwi-suite/application-console)
 *
 * @package kiwi-suite/application-console
 * @see https://github.com/kiwi-suite/application-console
 * @copyright Copyright (c) 2010 - 2017 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\ApplicationConsole\Factory;

use KiwiSuite\ApplicationConsole\ConsoleSubManager;
use KiwiSuite\ServiceManager\FactoryInterface;
use KiwiSuite\ServiceManager\ServiceManagerInterface;
use Symfony\Component\Console\Application;

final class ConsoleFactory implements FactoryInterface
{

    /**
     * @param ServiceManagerInterface $container
     * @param $requestedName
     * @param array|null $options
     * @throws \Psr\Container\ContainerExceptionInterface
     * @throws \Psr\Container\NotFoundExceptionInterface
     * @return Application|mixed
     */
    public function __invoke(ServiceManagerInterface $container, $requestedName, array $options = null)
    {
        /** @var ConsoleSubManager $consoleSubManager */
        $consoleSubManager = $container->get(ConsoleSubManager::class);

        $application =new Application("fruit");
        foreach (\array_keys($consoleSubManager->getServiceManagerConfig()->getFactories()) as $service) {
            $application->add($consoleSubManager->get($service));
        }

        return $application;
    }
}
