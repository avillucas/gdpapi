<?php

declare(strict_types=1);

namespace App\Application\Utils;

use Psr\Http\Message\ResponseInterface;

final class JsonRenderer
{
    public function json(ResponseInterface $res, $data = null, int $options = 0): ResponseInterface
    {
        $res = $res->withHeader("Content-Type", "application/json");
        $res->getBody()->write((string)json_encode($data, $options));

        return $res;
    }
}
