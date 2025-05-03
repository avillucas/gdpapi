<?php

namespace userservice\infrastructure\repositories;

use DoctrineRepository;
use App\Domain\User\User;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Domain\Contact\UserNotFoundException;
use App\Domain\Contact\ContactRepositoryInterface;

class ContactRepository extends DoctrineRepository implements ContactRepositoryInterface
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
     * @throws ContactNotFoundException
     * @return User
     */
    public function findUserOfId(int $id): User
    {
        $user = $this->repository->find($id);
        if (!isset($user)) {
            throw new ContactNotFoundException();
        }
        return $user;
    }

    /**
     *@inheritDoc
     */
    public function save(Contact $contact): bool
    {
       return $this->repository->save($contact);
    }
}
