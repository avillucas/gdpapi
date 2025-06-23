<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\News;

use App\Domain\New\News;
use App\Domain\New\NewsNotFoundException;
use App\Domain\News\NewsRepositoryInterface;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Infrastructure\Persistence\DoctrineRepository;

class NewsRepository extends DoctrineRepository implements NewsRepositoryInterface
{
    private EntityRepository $repository;


    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $entityManager->getRepository('News');
    }


    /**
     * @inheritDoc 
     **/
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * @inheritDoc 
     **/
    public function findUserOfId(int $id): News
    {
        $news = $this->repository->find($id);
        if (!isset($news)) {
            throw new NewsNotFoundException();
        }
        return $news;
    }

    /**
     * @inheritDoc 
     **/
    public function delete(int $id): void
    {
        $this->repository->delete($id);
    }

    /**
     * @inheritDoc 
     **/
    public function add(News $news): void
    {
        $this->repository->add($news);
    }

    /**
     * @inheritDoc 
     **/
    public function update(News $news): void
    {
        $this->repository->update($news);
    }
}
