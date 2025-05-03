<?php


declare(strict_types=1);

namespace App\Infrastructure\Persistence\Contact;


use App\Domain\User\User;
use App\Domain\Contact\Contact;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityRepository;
use App\Domain\Contact\ContactNotFoundException;
use App\Domain\Contact\ContactRepositoryInterface;
use App\Infrastructure\Persistence\DoctrineRepository;

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
     * @return Contact
     */
    public function find(int $id): Contact
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
    public function save(Contact $contact): Contact
    {
        $this->repository->persist($contact);
        $this->repository->flush();
        return $contact;
    }
}
