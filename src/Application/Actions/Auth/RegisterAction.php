<?php

declare(strict_types=1);

namespace App\Application\Actions\Auth;

use App\Application\Actions\Action;
use App\Domain\User\UserRepositoryInterface;
use App\Infrastructure\Persistence\User\UserRepository;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;

abstract class RegisterAction extends Action
{
    protected UserRepository $userRepository;

    public function __construct(LoggerInterface $logger, UserRepositoryInterface $userRepository)
    {
        parent::__construct($logger);
        $this->userRepository = $userRepository;
    }
  

    /**
     *   @OA\Get(
     *       tags={"register"},
     *       path="/auth/register",
     *       @OA\Response(
     *        response="200",
     *        description="Register a user return a jwt",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/User")
     *        )
     *       )
     *   )
     */
    protected function action(): Response
    {
        $params = $this->request->getBody();
        //$users = $this->userRepository->findAll();

     //   $this->logger->info("Users list was viewed.");

        return $this->respondWithData($users);
    }

}
