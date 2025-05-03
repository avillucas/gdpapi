<?php

declare(strict_types=1);

namespace App\Domain\Contact;

use JsonSerializable;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;


/** 
 * @OA\Schema ( 
 *   title="Contact", 
 *   description="A contact" 
 * ) 
 * @Entity(repositoryClass="infrastructure\persistence\UserRepository")
 */
final class Contact implements JsonSerializable
{
    /**
     * @Id
     * @Column(type="integer")
     * @OA\Property (type="integer", format="int64", readOnly=true, example=1) 
     */
    private ?int $id;
   
    /**
     * @Column(type="string", length="120")
     * @var string
     * @OA\Property (type="string", example="test@test.com.ar") 
     */
    private string $email;

    /**
     * @Column(type="string", length="120")
     * @var string
     * @OA\Property (type="string", example="John") 
     */
    private string $name;

    /**
     * @Column(type="string", length="2500")
     * @var string
    * @OA\Property (type="name", example="This is a test") 
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

    /**
     * Get the value of email
     *
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * Set the value of email
     *
     * @param string $email
     *
     * @return self
     */
    public function setEmail(string $email): self
    {
        $this->email = $email;
        return $this;
    }

    /**
     * Get the value of comments
     *
     * @return string
     */
    public function getComments(): string
    {
        return $this->comments;
    }

    /**
     * Set the value of comments
     *
     * @param string $comments
     *
     * @return self
     */
    public function setComments(string $comments): self
    {
        $this->comments = $comments;
        return $this;
    }

    /**
     * Get the value of name
     *
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the value of name
     *
     * @param string $name
     *
     * @return self
     */
    public function setName(string $name): self
    {
        $this->name = $name;
        return $this;
    }

    /**
     * Set the value of id
     *
     * @param ?int $id
     *
     * @return self
     */
    public function setId(?int $id): self {
        $this->id = $id;
        return $this;
    }
}
