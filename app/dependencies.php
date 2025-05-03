<?php

declare(strict_types=1);

use Monolog\Logger;
use DI\ContainerBuilder;
use Doctrine\ORM\ORMSetup;
use Psr\Log\LoggerInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\DBAL\DriverManager;
use Monolog\Handler\StreamHandler;
use Monolog\Processor\UidProcessor;
use Psr\Container\ContainerInterface;
use App\Application\Settings\SettingsInterface;
use Symfony\Component\Cache\Adapter\ArrayAdapter;
use Symfony\Component\Cache\Adapter\FilesystemAdapter;


return function (ContainerBuilder $containerBuilder) {
    $containerBuilder->addDefinitions([
        LoggerInterface::class => function (ContainerInterface $c) {
            $settings = $c->get(SettingsInterface::class);

            $loggerSettings = $settings->get('logger');
            $logger = new Logger($loggerSettings['name']);

            $processor = new UidProcessor();
            $logger->pushProcessor($processor);

            $handler = new StreamHandler($loggerSettings['path'], $loggerSettings['level']);
            $logger->pushHandler($handler);

            return $logger;
        },
        EntityManager::class => static function (ContainerInterface $c): EntityManager {

            $settings = $c->get(SettingsInterface::class);
            $doctrine = $settings->get('doctrine');

            // Use the ArrayAdapter or the FilesystemAdapter depending on the value of the 'dev_mode' setting
            // You can substitute the FilesystemAdapter for any other cache you prefer from the symfony/cache library
            $cache = $doctrine['dev_mode'] ?
                new ArrayAdapter() :
                new FilesystemAdapter(directory: $doctrine['cache_dir']);

            $config = ORMSetup::createAttributeMetadataConfiguration(
                $doctrine['metadata_dirs'],
                $doctrine['dev_mode'],
                null,
                $cache
            );

            $connection = DriverManager::getConnection($doctrine['connection']);

            return new EntityManager($connection, $config);
        },
    ]);
};
