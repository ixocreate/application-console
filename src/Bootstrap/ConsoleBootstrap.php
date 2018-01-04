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
     * @param BootstrapRegistry $bootstrapRegistry
     */
    public function bootstrap(ApplicationConfig $applicationConfig, BootstrapRegistry $bootstrapRegistry): void
    {
        $serviceManagerConfigurator = new ServiceManagerConfigurator(ConsoleServiceManagerConfig::class);

        $bootstrapDirectories = [
            $applicationConfig->getBootstrapDirectory(),
        ];

        foreach ($applicationConfig->getBundles() as $bundle) {
            $bootstrapDirectories[] = $bundle->getBootstrapDirectory();
        }

        foreach ($bootstrapDirectories as $directory) {
            if (\file_exists($directory . $this->bootstrapFilename)) {
                IncludeHelper::include(
                    $directory . $this->bootstrapFilename,
                    ['serviceManagerConfigurator' => $serviceManagerConfigurator]
                );
            }
        }
        $bootstrapRegistry->addService(ConsoleServiceManagerConfig::class, $serviceManagerConfigurator->getServiceManagerConfig());
    }
}
