<?php

use Doctrine\ORM\EntityManager;

class Repository
{
    protected EntityManager $entityManager;
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
}
