<?php

declare(strict_types=1);

namespace App\Domain\Contact;

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
    public function findUserOfId(int $id): Contact;

    /**
     * @param string $fromEmail 
     * @return Contact
     */
    public function getUserByFromEmail(string $fromEmail): Contact;
}
