<?php

declare(strict_types=1);

use App\Application\Actions\Auth\LoginAction;
use App\Application\Actions\Auth\RegisterAction;
use Slim\App;
use Slim\Exception\HttpNotFoundException;
use App\Application\Actions\Swagger\InfoAction;
use App\Application\Actions\User\ViewUserAction;
use App\Application\Actions\User\ListUsersAction;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use App\Application\Actions\Contact\CreateContactAction;
use App\Application\Middleware\ContactValidatorMiddleware;
use App\Middlewares\jwtAuth;
use Slim\Interfaces\RouteCollectorProxyInterface as Group;

return function (App $app) {
    $app->options('/{routes:.*}', function (Request $request, Response $response) {
        // CORS Pre-Flight OPTIONS Request Handler
        return $response;
    });

    $app->add(function ($request, $handler) {
        $response = $handler->handle($request);
        return $response
            ->withHeader('Access-Control-Allow-Origin', '*')
            ->withHeader('Access-Control-Allow-Headers', 'X-Requested-With, Content-Type, Accept, Origin, Authorization')
            ->withHeader('Access-Control-Allow-Methods', 'GET, POST, PUT, DELETE, PATCH, OPTIONS');
    });

    $app->group('/api/v1/public', function (Group $group) {
        $group->post('/contact', CreateContactAction::class)->addMiddleware(new ContactValidatorMiddleware());
        $group->get('/swagger', InfoAction::class);
    });

    $app->group('/api/v1/admin', function (Group $group) {
        $group->group('/auth', callable: function (Group $group) {
            $group->post('/register', RegisterAction::class);
            $group->post('/login', LoginAction::class);
        });
        $group->group('/users', callable: function (Group $group) {
            $group->get('', ListUsersAction::class);
            $group->get('/{id}', ViewUserAction::class);
        });
    })->add(jwtAuth::class);;


    /**
     * Catch-all route to serve a 404 Not Found page if none of the routes match
     * NOTE: make sure this route is defined last
     */
    $app->map(['GET', 'POST', 'PUT', 'DELETE', 'PATCH'], '/{routes:.+}', function ($request, $response) {
        throw new HttpNotFoundException($request);
    });
};
