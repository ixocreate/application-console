<?php

namespace KiwiSuite\ApplicationConsole\Factory;

use KiwiSuite\Contract\ServiceManager\InitializerInterface;
use KiwiSuite\Contract\ServiceManager\ServiceManagerInterface;
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
