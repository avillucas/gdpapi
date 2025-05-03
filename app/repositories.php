<?php

declare(strict_types=1);

use DI\ContainerBuilder;
use Doctrine\ORM\EntityManager;
use Psr\Container\ContainerInterface;
use App\Domain\User\UserRepositoryInterface;
use App\Application\Settings\SettingsInterface;
use App\Domain\Contact\ContactRepositoryInterface;
use App\Infrastructure\Service\MailgunEmailTransport;
use App\Infrastructure\Persistence\User\UserRepository;
use App\Infrastructure\Service\EmailTransportInterface;
use App\Infrastructure\Persistence\Contact\ContactRepository;

return function (ContainerBuilder $containerBuilder) {

  $containerBuilder->addDefinitions([
    EmailTransportInterface::class => function (ContainerInterface $c) {
      $settings = $c->get(SettingsInterface::class);
      $mailgunSettings = $settings->get('mailgun');
      return new MailgunEmailTransport($mailgunSettings['domain'], $mailgunSettings['secret'], $mailgunSettings['from']);
    },
    UserRepositoryInterface::class => function (ContainerInterface $container) {
      return $container->get(EntityManager::class)->getRepository(UserRepository::class);
    },
    ContactRepositoryInterface::class => function (ContainerInterface $container) {
      return $container->get(EntityManager::class)->getRepository(ContactRepository::class);
    },
  ]);
};
