<?php 
namespace App\Infrastructure\Service;

use App\Domain\Contact\Contact;

interface EmailTransportInterface{
    public function sendContactEmail(Contact $contact):void;
}