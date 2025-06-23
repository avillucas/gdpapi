<?php

namespace App\Middlewares;

use Exception;
use App\Application\Utils\JsonRenderer;
use App\Infrastructure\Service\JWTService;
use App\Infrastructure\Service\JWTServiceInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;


final class jwtAuth
{
    const TOKEN_PAYLOAD = 'token';
    private JsonRenderer $renderer;
    private Response $response;
    private JWTService $jwtservice;

    public function __construct(JsonRenderer $renderer, Response $response, JWTServiceInterface $jwtservice)
    {
        $this->renderer = $renderer;
        $this->response = $response;
        $this->jwtservice = $jwtservice;
    }

    /**
     * Get Sent token
     *
     * @throws Exception
     * @return string
     */
    protected function parseHeader(Request $request): string
    {
        if (!$request->hasHeader("Authorization")) {
            throw new Exception("Header not set", 401);
        }
        $header = $request->getHeader("Authorization");
        if (empty($header)) {
            throw new Exception("Header not set", 401);
        }
        $bearer = trim($header[0]);
        preg_match("/Bearer\s(\S+)/", $bearer, $matches);
        if (!isset($matches) || !isset($matches[1]) || empty($matches[1])) {
            throw new Exception("Header not set", 401);
        }
        return $matches[1];
    }


    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        try {
            $token = $this->parseHeader($request);
            $decode = $this->jwtservice->decodeToken($token);
          $request = $request->withAttribute(self::TOKEN_DECODE, $decode);

        } catch (Exception $exception) {
            return $this->renderer->json($this->response, [
                "Error" => [
                    "Message" => $exception->getMessage()
                ]
            ])->withHeader("Content-Type", "application/json")
                ->withStatus($exception->getCode());
        }
        return $handler->handle($request);
    }
}
