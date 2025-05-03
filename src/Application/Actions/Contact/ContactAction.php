<?php

declare(strict_types=1);

namespace App\Application\Actions\Contact;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\Contact\ContactRepositoryInterface;
use App\Infrastructure\Service\EmailTransportInterface;
use App\Infrastructure\Persistence\Contact\ContactRepository ;

abstract class ContactAction extends Action
{
    protected ContactRepository $contactRepository;

    protected EmailTransportInterface $emailTransport;

    public function __construct(LoggerInterface $logger, ContactRepositoryInterface $contactRepository, EmailTransportInterface $emailTransport)
    {
        parent::__construct($logger);
        $this->contactRepository = $contactRepository;
        $this->emailTransport = $emailTransport;
    }
}
