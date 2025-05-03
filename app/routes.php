<?php

declare(strict_types=1);

use Slim\App;
use App\Controllers\AuthAction;
use Tuupola\Middleware\JwtAuthentication;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->group('/api/v1/public', function (Group $group) {
        $group->post('contact', ContactAction::class);
    });

    $app->group('/api/v1/admin', function (Group $group) {
        $group->group('/users', callable: function (Group $group) {
            $group->get('', ListUsersAction::class);
            $group->get('/{id}', ViewUserAction::class);
        });
    });
};
