<?php

declare(strict_types=1);

namespace App\Domain\User;

use JsonSerializable;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;

/**
 * @Entity(repositoryClass="Infrastructure\Persistence\UserRepository")
 * @OA\Schema(
 *     title="User",
 *     description="A simple user model."
 * )
 */
final class User implements JsonSerializable
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
    private string $username;

    /**
     * @Column(type="string", length="120")
     * @var string
     */
    private string $firstName;

    /**
     * @Column(type="string", length="120")
     * @var string
     */
    private string $lastName;

    /**
     * @Column(type="datetimetz_immutable", length="120", name="registered_at", nullable=false)
     * @var string
     */

    private DateTimeImmutable $registeredAt;

    public function __construct(?int $id, string $username, string $firstName, string $lastName)
    {
        $this->id = $id;
        $this->username = strtolower($username);
        $this->firstName = ucfirst($firstName);
        $this->lastName = ucfirst($lastName);
        $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'username' => $this->username,
            'firstName' => $this->firstName,
            'lastName' => $this->lastName,
        ];
    }
}
