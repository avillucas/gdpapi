<?php

declare(strict_types=1);

namespace App\Domain\New;

use App\Domain\DomainException\DomainRecordNotFoundException;

class NewsNotFoundException extends DomainRecordNotFoundException
{
    public $message = 'The news you requested does not exist.';
}
