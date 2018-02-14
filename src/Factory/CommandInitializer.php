<?php

namespace KiwiSuite\ApplicationConsole\Factory;

use KiwiSuite\ServiceManager\InitializerInterface;
use KiwiSuite\ServiceManager\ServiceManagerInterface;
use Symfony\Component\Console\Application;
use Symfony\Component\Console\Command\Command;

class CommandInitializer implements InitializerInterface
{
    public function __invoke(ServiceManagerInterface $container, $instance): void
    {
        if ($instance instanceof Command) {
            $instance->setApplication($container->get(Application::class));
        }
    }
}
