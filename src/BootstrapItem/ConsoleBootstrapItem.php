<?php
namespace KiwiSuite\ApplicationConsole\BootstrapItem;

use KiwiSuite\ApplicationConsole\ConsoleConfigurator;
use KiwiSuite\Contract\Application\BootstrapItemInterface;
use KiwiSuite\Contract\Application\ConfiguratorInterface;

final class ConsoleBootstrapItem implements BootstrapItemInterface
{

    /**
     * @return mixed
     */
    public function getConfigurator(): ConfiguratorInterface
    {
        return new ConsoleConfigurator();
    }

    /**
     * @return string
     */
    public function getVariableName(): string
    {
        return 'console';
    }

    /**
     * @return string
     */
    public function getFileName(): string
    {
        return 'console.php';
    }
}
