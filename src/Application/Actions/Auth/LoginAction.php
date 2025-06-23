<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use Psr\Log\LoggerInterface;
use App\Application\Actions\Action;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Service\EmailTransportInterface;
use App\Infrastructure\Persistence\User\UserRepository;
use Psr\Http\Message\ResponseInterface  ;

abstract class LoginAction extends Action
{
    protected UserRepository $userRepository;

    protected EmailTransportInterface $emailTransport;

    public function __construct(LoggerInterface $logger, UserRepositoryInterface $userRepository, EmailTransportInterface $emailTransport)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
        $this->emailTransport = $emailTransport;
    }


        /**
     *   @OA\Get(
     *       tags={"auth"},
     *       path="/auth",
     *       operationId="login",
     *       @OA\Response(
     *        response="200",
     *        description="List all users",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/User")
     *        )
     *       )
     *   )
     */
    protected function action(): ResponseInterface
    {
        $users = $this->userRepository->findAll();

        $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }

}
