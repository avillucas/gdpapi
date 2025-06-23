<?php

declare(strict_types=1);

namespace App\Application\Actions\New;

use App\Application\Actions\User\NewsAction;
use Psr\Http\Message\ResponseInterface as Response;

class ViewNewsAction extends NewsAction
{
    /**
     * @OA\Get(
     *   tags={"news"},
     *   path="/news/{id}",
     *   operationId="getUser",
     *   @OA\Parameter(
     *          name="id",
     *          in="path",
     *          required=true,
     *          description="News id",
     *          @OA\Schema(
     *              type="integer"
     *          )
     *   ),
     *   @OA\Response(
     *     response=200,
     *     description="A single new",
     *     @OA\JsonContent(ref="#/components/schemas/New")
     *   )
     * )
     */
    protected function action(): Response
    {
        $newId = (int) $this->resolveArg('id');
        $new = $this->newsRepository->findUserOfId($newId);

        $this->logger->info(sprintf('News of id %d was viewed.', $newId));

        return $this->respondWithData($new);
    }
}
