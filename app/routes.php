<?php declare(strict_types=1);

use Sakila\Application\Controllers\Api\ActorController;
use Sakila\Application\Handlers\Strategies\ApiResourceStrategy;
use Slim\App;
use Slim\Routing\RouteCollectorProxy;

return function (App $app) {

    $app->addBodyParsingMiddleware();
    $app->group(
        '/api',
        function (RouteCollectorProxy $group) {

            $group->getRouteCollector()->setDefaultInvocationStrategy(new ApiResourceStrategy());

            $group->group(
                '/actors',
                function (RouteCollectorProxy $group) {
                    $group->get('', ActorController::class . ':index');
                    $group->post('', ActorController::class . ':store');
                    $group->get('/{actorId:[0-9]+}', ActorController::class . ':show');
                    $group->put('/{actorId:[0-9]+}', ActorController::class . ':update');
                    $group->delete('/{actorId:[0-9]+}', ActorController::class . ':destroy');
                }
            );
        }
    );
};
