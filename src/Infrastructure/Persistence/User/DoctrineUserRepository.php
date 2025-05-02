<?php

declare(strict_types=1);

namespace App\Infrastructure\Persistence\User;

use Exception;
use App\Domain\User\User;
use Doctrine\ORM\EntityManager;
use App\Domain\User\UserRepositoryInterface;

class DoctrineUserRepository implements UserRepositoryInterface
{
    private EntityManager $em;

    public function __construct(EntityManager $em, ?array $users = null)
    {
        $this->em = $em;
    }


    public function signUp(string $username, string $name, string $surname): User
    {
        $newUser = new User(null, $username, $name, $surname);

        $this->em->persist($newUser);
        $this->em->flush();

        return $newUser;
    }


    /**
     * {@inheritdoc}
     */
    public function findAll(): array
    {
        return $this->em->findAll();
    }

    /**
     * {@inheritdoc}
     */
    public function findUserOfId(int $id): User
    {
        $user  = $this->em->find($id);
        if (!$user) {
            throw new Exception('User does not exist');
        }
        return $user;
    }

    /**
     * {@inheritdoc}
     */
    public function getUserByUsername(string $username): array
    {
        $user  = $this->em->findByUsername($username);
        if (!$user) {
            throw new Exception('User does not exist');
        }
        return $user;
    }
}
