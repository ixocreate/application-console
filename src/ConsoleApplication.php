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

use KiwiSuite\Application\ApplicationInterface;
use KiwiSuite\Application\Bootstrap;
use Symfony\Component\Console\Application;

final class ConsoleApplication implements ApplicationInterface
{

    /**
     * @var string
     */
    private $bootstrapDirectory;

    /**
     * ConsoleApplication constructor.
     * @param string $bootstrapDirectory
     */
    public function __construct(string $bootstrapDirectory)
    {
        $this->bootstrapDirectory = $bootstrapDirectory;
    }

    /**
     * @throws \Exception
     * @codeCoverageIgnore
     */
    public function run(): void
    {
        $bootstrap = new Bootstrap();
        $serviceManager = $bootstrap->bootstrap($this->bootstrapDirectory, $this);
        $serviceManager->get(Application::class)->run();
    }
}
