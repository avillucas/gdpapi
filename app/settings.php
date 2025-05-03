<?php

declare(strict_types=1);

use Monolog\Logger;
use DI\ContainerBuilder;
use App\Application\Settings\Settings;
use App\Application\Settings\SettingsInterface;

return function (ContainerBuilder $containerBuilder) {

    // Global Settings Object
    $containerBuilder->addDefinitions([
        SettingsInterface::class => function () {
            return new Settings([
                'env' =>  $_ENV['APP_ENVIROMENT'] ??  'development',
                'displayErrorDetails' => true, // Should be set to false in production
                'logError'            => false,
                'logErrorDetails'     => false,
                'logger' => [
                    'name' => 'slim-app',
                    'path' => isset($_ENV['docker']) ? 'php://stdout' : __DIR__ . '/../logs/app.log',
                    'level' => Logger::DEBUG,
                ],
                'jwtsecret' => $_ENV['JWT_SECRET'] ?? 'asdasddasdasdasdasd',
                'doctrine' => [
                    // Enables or disables Doctrine metadata caching
                    // for either performance or convenience during development.
                    'dev_mode' => true,

                    // Path where Doctrine will cache the processed metadata
                    // when 'dev_mode' is false.
                    'cache_dir' => __DIR__ . '/var/doctrine',

                    // List of paths where Doctrine will search for metadata.
                    // Metadata can be either YML/XML files or PHP classes annotated
                    // with comments or PHP8 attributes.
                    'metadata_dirs' => [__DIR__ . '/src/Domain'],

                    // The parameters Doctrine needs to connect to your database.
                    // These parameters depend on the driver (for instance the 'pdo_sqlite' driver
                    // needs a 'path' parameter and doesn't use most of the ones shown in this example).
                    // Refer to the Doctrine documentation to see the full list
                    // of valid parameters: https://www.doctrine-project.org/projects/doctrine-dbal/en/current/reference/configuration.html
                    'connection' => [
                        'driver' => $_ENV['MYSQL_DRIVER'] ??  'pdo_mysql',
                        'host' => $_ENV['MYSQL_HOST'] ?? 'localhost',
                        'port' => $_ENV['MYSQL_PORT'] ??  3306,
                        'dbname' => $_ENV['MYSQL_DATABASE'] ??  'mydb',
                        'user' => $_ENV['MYSQL_USER'] ?? 'user',
                        'password' => $_ENV['MYSQL_PASSWORD'] ?? 'secret',
                        'charset' => $_ENV['MYSQL_CHARSET'] ?? 'utf-8'
                    ]
                ],
                'mailgun' => [
                    'domain' => $_ENV['MAILGUN_DOMAIN'] ?? 'sandbox9a1e358e2b6449f3bbccd2a8009d0b11.mailgun.org',
                    'secret' => $_ENV['MAILGUN_SECRET']  ?? '108f4ed0a73be6e58563c9457c4e3cf5-67bd41c2-94db36c3',
                ],
            ]);
        }
    ]);
};
