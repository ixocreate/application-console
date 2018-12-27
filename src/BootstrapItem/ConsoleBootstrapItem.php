<?php
/**
 * @link https://github.com/ixocreate
 * @copyright IXOCREATE GmbH
 * @license MIT License
 */

declare(strict_types=1);

namespace Ixocreate\ApplicationConsole\BootstrapItem;

use Ixocreate\ApplicationConsole\ConsoleConfigurator;
use Ixocreate\Contract\Application\BootstrapItemInterface;
use Ixocreate\Contract\Application\ConfiguratorInterface;

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
