<?php

namespace App\Infrastructure\Service;


interface JWTServiceInterface
{
    /**
     * Retrieve  a token
     *
     * @return string
     */
    public function getToken(): string;
}
