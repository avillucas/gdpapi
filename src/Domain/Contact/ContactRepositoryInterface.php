<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use Exception;

interface ContactRepositoryInterface
{
    /**
     * @return Contact[]
     */
    public function findAll(): array;

    /**
     * @param int $id
     * @return Contact
     * @throws ContactNotFoundException
     */
    public function find(int $id): Contact;
    
    /**
     * @param Contact $contact
     * @return Contact
     * @throws Exception
     */
    public function save(Contact $contact): Contact;
}