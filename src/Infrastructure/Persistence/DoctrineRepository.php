<?php

use Doctrine\ORM\EntityManager;

class DoctrineRepository
{
    protected EntityManager $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
