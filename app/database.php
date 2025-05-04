<?php

declare(strict_types=1);

return [
    'driver' => $_ENV['MYSQL_DRIVER'] ??  'pdo_mysql',
    'host' => $_ENV['MYSQL_HOST'] ?? 'mariadb',
    'port' => $_ENV['MYSQL_PORT'] ??  3306,
    'dbname' => $_ENV['MYSQL_DATABASE'] ??  'gdp',
    'user' => $_ENV['MYSQL_USER'] ?? 'gdp',
    'password' => $_ENV['MYSQL_PASSWORD'] ?? 'gdp',
    'charset' => $_ENV['MYSQL_CHARSET'] ?? 'utf8',
    'collation' => $_ENV['MYSQL_COLLECTION'] ?? 'utf8_general_ci',
    'engine' =>$_ENV['MYSQL_ENGINE'] ?? 'InnoDB',
];
