<?php

declare(strict_types=1);

namespace App\Application\Actions\Swagger;

use OpenApi\Generator;
use OpenApi\Serializer;
use App\Application\Actions\Action;
use Psr\Http\Message\ResponseInterface as Response;

class InfoAction extends Action
{
    /**
     * @OA\Get(
     *     path="/api/v1/public/swagger",
     *     tags={"documentation"},
     *     summary="OpenAPI JSON File that describes the API",
     *     @OA\Response(response="200", description="OpenAPI Description File"),
     * )
     */
    protected function action(): Response
    {
      //@todo avanzar
        $openapi = Generator::scan([__DIR__ . '/../../../../nodist/swagger/openapi.json']);
        $this->response->getBody()->write($openapi->toJson());
        return $this->response->withHeader('Content-Type', 'application/json');
    }
}
