<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use userservice\infrastructure\repositories\UserRepository;

abstract class UserAction extends Action
{
    protected UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, UserRepository $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }
}
