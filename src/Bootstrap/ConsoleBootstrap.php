<?php
/**
 * kiwi-suite/application (https://github.com/kiwi-suite/application-console)
 *
 * @package kiwi-suite/application-console
 * @see https://github.com/kiwi-suite/application-console
 * @copyright Copyright (c) 2010 - 2017 kiwi suite GmbH
 * @license MIT License
 */

declare(strict_types=1);
namespace KiwiSuite\ApplicationConsole\Bootstrap;

use KiwiSuite\Application\ApplicationConfig;
use KiwiSuite\Application\Bootstrap\BootstrapInterface;
use KiwiSuite\Application\Bootstrap\BootstrapRegistry;
use KiwiSuite\Application\IncludeHelper;
use KiwiSuite\ApplicationConsole\ConsoleServiceManagerConfig;
use KiwiSuite\ServiceManager\ServiceManagerConfigurator;

final class ConsoleBootstrap implements BootstrapInterface
{
    /**
     * @var string
     */
    private $bootstrapFilename = 'console.php';

    /**
     * @param ServiceManagerConfigurator $serviceManagerConfigurator
     * @codeCoverageIgnore
     */
    public function configureServiceManager(ServiceManagerConfigurator $serviceManagerConfigurator): void
    {
    }

    /**
     * @param ApplicationConfig $applicationConfig
     * @param BootstrapRegistry $bootstrapCollection
     */
    public function bootstrap(ApplicationConfig $applicationConfig, BootstrapRegistry $bootstrapCollection): void
    {
        $serviceManagerConfigurator = new ServiceManagerConfigurator(ConsoleServiceManagerConfig::class);

        $bootstrapDirectories = [
            $applicationConfig->getBootstrapDirectory(),
        ];

        foreach ($bootstrapCollection->getModules() as $module) {
            $bootstrapDirectories[] = $module->getBootstrapDirectory();
        }

        foreach ($bootstrapDirectories as $directory) {
            if (\file_exists($directory . $this->bootstrapFilename)) {
                IncludeHelper::include(
                    $directory . $this->bootstrapFilename,
                    ['serviceManagerConfigurator' => $serviceManagerConfigurator]
                );
            }
        }
        $bootstrapCollection->addService(ConsoleServiceManagerConfig::class, $serviceManagerConfigurator->getServiceManagerConfig());
    }
}
