<?php

declare(strict_types=1);

use App\Middlewares\jwtAuth;
use Slim\App;

return function (App $app) {
    $app->add(jwtAuth::class);
};
