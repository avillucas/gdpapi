#!/usr/bin/env php
<?php


use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Doctrine\ORM\Tools\Console\EntityManagerProvider\SingleManagerProvider;

/** @var ContainerInterface $container */
$container = require_once __DIR__ . '../public/index.php';

ConsoleRunner::run(new SingleManagerProvider($container->get(EntityManager::class)));
