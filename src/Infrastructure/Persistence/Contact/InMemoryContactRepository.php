<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\Contact;

use App\Domain\Contact\Contact;
use App\Domain\Contact\ContactNotFoundException;
use App\Domain\Contact\ContactRepositoryInterface;

class InMemoryContactRepository implements ContactRepositoryInterface
{
    /**
     * @var Contact[]
     */
    private array $contacts;

    /**
     * @param Contact[]|null $contacts
     */
    public function __construct(?array $contacts = null)
    {
        $this->contacts = $contacts ?? [
            1 => new Contact(1, 'bill.gates@test.com', 'Bill', 'Test from Gates'),
            2 => new Contact(2, 'steve.jobs@test.com', 'Steve', 'Test from Jobs'),
            3 => new Contact(3, 'mark.zuckerberg@test.com', 'Mark', 'Test from Zuckerberg'),
            4 => new Contact(4, 'evan.spiegel@test.com', 'Evan', 'Test from Spiegel'),
            5 => new Contact(5, 'jack.dorsey@test.com', 'Jack', 'Test from Dorsey'),
        ];
    }

   
    /**
     * Find all contacts
     * 
     * @return Contact[]
     */
    public function findAll(): array
    {
        return array_values($this->contacts);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): Contact
    {
        if (!isset($this->contacts[$id])) {
            throw new ContactNotFoundException();
        }

        return $this->contacts[$id];
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByFromEmail(string $fromEmail): Contact
    {
        foreach ($this->contacts as $contact) {
            if ($fromEmail ==  $contact->getEmail()) {
                return $contact;
            }
        }
        throw new ContactNotFoundException();
    }
}
