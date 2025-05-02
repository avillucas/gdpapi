<?php

namespace userservice\infrastructure\repositories;

use Repository;
use App\Domain\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Domain\User\UserNotFoundException;
use App\Domain\User\UserRepositoryInterface;

class UserRepository extends Repository implements UserRepositoryInterface
{
    private EntityRepository $repository;

    /**
     * 
     * @param EntityManager $entityManager
     */
    public function __construct(EntityManager $entityManager)
    {
        parent::__construct($entityManager);
        $this->repository = $entityManager->getRepository('User'); // OR $this->entityManager->find('User', 1);
    }


    /**
     * Find all Users
     * 
     * @return User[]
     */
    public function findAll(): array
    {
        return $this->repository->findAll();
    }

    /**
     * Find one Users
     * @throws UserNotFoundException
     * @return User
     */
    public function findUserOfId(int $id): User
    {
        $user = $this->repository->find($id);
        if (!isset($user)) {
            throw new UserNotFoundException();
        }
        return $user;
    }

    /**
     *@inheritDoc
     */
    public function getUserByUsername(string $username): User
    {
        $user = $this->repository->findOneBy(['username' => $username]);
        if (!isset($user)) {
            throw new UserNotFoundException();
        }
        return $user;
    }
}
