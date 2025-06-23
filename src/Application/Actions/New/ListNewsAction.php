<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use Psr\Http\Message\ResponseInterface as Response;

class ListNewsAction extends NewsAction
{
    /**
     *   @OA\Get(
     *       tags={"news"},
     *       path="/news",
     *       operationId="getNews",
     *       @OA\Response(
     *        response="200",
     *        description="List all news",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/News")
     *        )
     *       )
     *   )
     */
    protected function action(): Response
    {
        $users = $this->newsRepository->findAll();

        $this->logger->info("News list was viewed.");

        return $this->respondWithData($users);
    }
}
