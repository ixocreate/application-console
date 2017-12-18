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
/** @var \KiwiSuite\ServiceManager\ServiceManagerConfigurator $serviceManagerConfigurator */
$serviceManagerConfigurator->addFactory(\Symfony\Component\Console\Command\HelpCommand::class);
