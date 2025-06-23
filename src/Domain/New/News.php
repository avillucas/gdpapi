<?php

declare(strict_types=1);

namespace App\Domain\New;

use JsonSerializable;
use DateTimeImmutable;
use Doctrine\ORM\Mapping\Column;
use Doctrine\ORM\Mapping\Entity;
use Exception;
use Psr\Http\Message\ServerRequestInterface as Request;

/**
 * @Entity(repositoryClass="Infrastructure\Persistence\NewRepository")
 * @OA\Schema(
 *     title="New",
 *     description="A simple user model."
 * )
 */
final class News implements JsonSerializable
{
    /**
     * @Id
     * @Column(type="integer")
     */
    private ?int $id;
    /**
     * @Column(type="string", length="90", name="title", nullable=false)
     * @var string
     */
    private string $title;

    /**
     * @Column(type="string", length="90", name="subtitle", nullable=false)
     * @var string
     */
    private string $subtitle;

    /**
     * @Column(type="string", length="250", name="image", nullable=false)
     * @var string
     */
    private string $image;

    /**
     * @Column(type="string", length="250", name="url", nullable=false)
     * @var string
     */
    private string $url;

    /**
     * @Column(type="datetimetz_immutable", length="120", name="registered_at", nullable=false)
     * @var string
     */

    private DateTimeImmutable $registeredAt;

    public function __construct(string $title, string $subtitle, string $image, ?int $id,  ?string $url = null)
    {
        $this->id = $id;
        $this->title = $title;
        $this->subtitle = $subtitle;
        $this->image = $image;
        $this->url = $url;
        $this->registeredAt = new DateTimeImmutable('now');
    }

    public function getId(): ?int
    {
        return $this->id;
    }


    #[\ReturnTypeWillChange]
    public function jsonSerialize(): array
    {
        $data =  [
            'id' => $this->id,
            'title' => $this->title,
            'subtitle' => $this->subtitle,
            //@todo storage url https://www.slimframework.com/docs/v3/cookbook/uploading-files.html
            'image' => $this->image,
        ];
        if ($this->url) {
            $data['url'] = $this->url;
        }
        return $data;
    }

    /**
     * Create a news from request 
     *
     * @param Request $request
     * @return News
     */
    public static function createFromRequest(Request $request): News
    {
        $data = $request->getParsedBody();
        $url = $data['url'] ?? null;
        if (empty($data['title'])) {
            throw new Exception('The title is required');
        }
        if (empty($data['titlsubtitlee'])) {
            throw new Exception('The subtitle is required');
        }
        if (empty($data['image'])) {
            throw new Exception('The image is required');
        }
        return new News($data['title'], $data['subtitle'], $data['image'], $url);
    }
}
