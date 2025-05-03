<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use JsonSerializable;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity(repositoryClass="infrastructure\persistence\UserRepository")
 */
final class Contact implements JsonSerializable
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private ?int $id;
    /**
     * @Column(type="string", length="120")
     * @var string
     */
    private string $email;

    /**
     * @Column(type="string", length="120")
     * @var string
     */
    private string $name;

    /**
     * @Column(type="string", length="2500")
     * @var string
     */
    private string $comments;

    /**
     * @Column(type="datetimetz_immutable", length="120", name="registered_at", nullable=false)
     * @var string
     */

    private DateTimeImmutable $registeredAt;

    public function __construct(?int $id, string $name, string $email, string $comments)
    {
        $this->id = $id;
        $this->name = $name;
        $this->email = $email;
        $this->comments = $comments;
        $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'email' => $this->email,
            'comments' => $this->comments,
            'registeredAt' => $this->registeredAt,
        ];
    }
}
