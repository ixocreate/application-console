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

use KiwiSuite\Application\ApplicationConfigurator;
use KiwiSuite\Application\ApplicationInterface;
use KiwiSuite\Application\Bootstrap;
use KiwiSuite\ApplicationConsole\Console\ConsoleRunner;

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
        $serviceManager = (new Bootstrap())->bootstrap($this->bootstrapDirectory, $this);
        $serviceManager->get(ConsoleRunner::class)->run();
    }

    public function configure(ApplicationConfigurator $applicationConfigurator): void
    {
        if (!isset($_SERVER['argv']) || !\is_array($_SERVER['argv'])) {
            return;
        }

        if (\array_search('-d', $_SERVER['argv'], true) !== false || \array_search('--development', $_SERVER['argv'], true) !== false) {
            $applicationConfigurator->setDevelopment(true);
            return;
        }

        //TODO make a proper short syntax check (for grouped input options)
    }
}
