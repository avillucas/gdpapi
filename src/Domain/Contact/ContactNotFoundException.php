<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use App\Domain\DomainException\DomainRecordNotFoundException;

class ContactNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The contact you requested does not exist.';
}
