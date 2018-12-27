<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\ApplicationConsole\Factory;

use Ixocreate\ApplicationConsole\Console\ConsoleRunner;
use Ixocreate\Contract\ServiceManager\InitializerInterface;
use Ixocreate\Contract\ServiceManager\ServiceManagerInterface;
use Symfony\Component\Console\Command\Command;

class CommandInitializer implements InitializerInterface
{
    public function __invoke(ServiceManagerInterface $container, $instance): void
    {
        if ($instance instanceof Command) {
            $instance->setApplication($container->get(ConsoleRunner::class));
        }
    }
}
