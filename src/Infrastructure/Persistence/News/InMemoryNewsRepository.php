<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use App\Domain\New\News;
use App\Domain\New\NewsNotFoundException;
use App\Domain\News\NewsRepositoryInterface;

class InMemoryUserRepository implements NewsRepositoryInterface
{
    /**
     * @var News[]
     */
    private array $news;

    /**
     * @param News[]|null $news
     */
    public function __construct(?array $news = null)
    {
        $this->news = $news ?? [
            1 => new News('bill.gates', 'Bill', 'Gates', 1),
            2 => new News('steve.jobs', 'Steve', 'Jobs', 2, 'https://test.com.ar'),
            3 => new News('mark.zuckerberg', 'Mark', 'Zuckerberg', 3, 'https://test.com.ar'),
            4 => new News('evan.spiegel', 'Evan', 'Spiegel', 4),
            5 => new News('jack.dorsey', 'Jack', 'Dorsey', 5, 'https://test.com.ar'),
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return array_values($this->news);
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): News
    {
        if (!isset($this->news[$id])) {
            throw new NewsNotFoundException();
        }

        return $this->news[$id];
    }
}
