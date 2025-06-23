<?php

declare(strict_types=1);

namespace App\Application\Actions\User;

use App\Domain\New\News;
use Psr\Http\Message\ResponseInterface as Response;

class UpdateNewAction extends NewsAction
{
    /**
     *   @OA\Get(
     *       tags={"news"},
     *       path="/news",
     *       operationId="updateNews",
     *       @OA\Response(
     *        response="200",
     *        description="Update a new",
     *        @OA\JsonContent(
     *            type="array",
     *            @OA\Items(ref="#/components/schemas/News")
     *        )
     *       )
     *   )
     */
    protected function action(): Response
    {
        $newId = (int) $this->resolveArg('id');
        $news = $this->newsRepository->findUserOfId($newId);
        $this->newsRepository->update($news);
        $this->logger->info("News list was update.");

        return $this->respondWithData($news);
    }
}
