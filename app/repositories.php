<?php
declare(strict_types=1);

use DI\ContainerBuilder;
use Psr\Container\ContainerInterface;
use App\Application\Settings\SettingsInterface;
use App\Infrastructure\Service\EmailTransportInterface;

return function (ContainerBuilder $containerBuilder) {

  $containerBuilder->addDefinitions([
    EmailTransportInterface::class => function (ContainerInterface $c) {
      $settings = $c->get(SettingsInterface::class);
      $mailgunSettings = $settings->get('mailgun');
      return new MailgunEmailTransport($mailgunSettings['domain'], $mailgunSettings['secret']);
    },
  ]);
};
