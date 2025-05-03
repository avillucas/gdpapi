<?php

declare(strict_types=1);

namespace App\Utils;

use Slim\Psr7\Response;
use Yiisoft\Validator\Validator;
use App\Utils\ValidatorException;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Yiisoft\Validator\RulesProviderInterface  as Ruler;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

abstract class RequestValidator implements Middleware,  Ruler
{

    /**
     * {@inheritdoc}
     */
    abstract public function getRules(): iterable;

    /**
     * {@inheritdoc}
     */
    public function process(Request $request, RequestHandler $handler): Response
    {

        $data = $request->getQueryParams();
        $result = (new Validator())->validate($data, $this);
        if (!$result->isValid()) {
            throw  ValidatorException::fromResult($request, $result);
        }

        return $handler->handle($request);
    }
}
