<?php 
declare(strict_types=1);

use DI\ContainerBuilder;

require __DIR__ . '/vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();


// Set up settings
$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);


//if (false) { // Should be set to true in production
//	$containerBuilder->enableCompilation(__DIR__ . '/../var/cache');
//}

// Set up dependencies
$dependencies = require __DIR__ . '/app/dependencies.php';
$dependencies($containerBuilder);

// Set up repositories
$repositories = require __DIR__ . '/app/repositories.php';
$repositories($containerBuilder);


// Build PHP-DI Container instance
$container = $containerBuilder->build();
return $container;