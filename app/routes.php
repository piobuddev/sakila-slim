<?php declare(strict_types=1);

use Sakila\Application\Controllers\Api\ActorController;
use Sakila\Application\Controllers\Api\AddressController;
use Sakila\Application\Controllers\Api\CategoryController;
use Sakila\Application\Controllers\Api\CityController;
use Sakila\Application\Controllers\Api\CountryController;
use Sakila\Application\Controllers\Api\CustomerController;
use Sakila\Application\Controllers\Api\FilmController;
use Sakila\Application\Controllers\Api\InventoryController;
use Sakila\Application\Controllers\Api\LanguageController;
use Sakila\Application\Controllers\Api\PaymentController;
use Sakila\Application\Controllers\Api\RentalController;
use Sakila\Application\Controllers\Api\StaffController;
use Sakila\Application\Controllers\Api\StoreController;
use Sakila\Application\Handlers\Strategies\ApiResourceStrategy;
use Sakila\Application\Middleware\FractalMiddleware;
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

            $group->group(
                '/addresses',
                function (RouteCollectorProxy $group) {
                    $group->get('', AddressController::class . ':index');
                    $group->post('', AddressController::class . ':store');
                    $group->get('/{addressId:[0-9]+}', AddressController::class . ':show');
                    $group->put('/{addressId:[0-9]+}', AddressController::class . ':update');
                    $group->delete('/{addressId:[0-9]+}', AddressController::class . ':destroy');
                }
            );

            $group->group(
                '/categories',
                function (RouteCollectorProxy $group) {
                    $group->get('', CategoryController::class . ':index');
                    $group->post('', CategoryController::class . ':store');
                    $group->get('/{categoryId:[0-9]+}', CategoryController::class . ':show');
                    $group->put('/{categoryId:[0-9]+}', CategoryController::class . ':update');
                    $group->delete('/{categoryId:[0-9]+}', CategoryController::class . ':destroy');
                }
            );

            $group->group(
                '/cities',
                function (RouteCollectorProxy $group) {
                    $group->get('', CityController::class . ':index');
                    $group->post('', CityController::class . ':store');
                    $group->get('/{cityId:[0-9]+}', CityController::class . ':show');
                    $group->put('/{cityId:[0-9]+}', CityController::class . ':update');
                    $group->delete('/{cityId:[0-9]+}', CityController::class . ':destroy');
                }
            );

            $group->group(
                '/countries',
                function (RouteCollectorProxy $group) {
                    $group->get('', CountryController::class . ':index');
                    $group->post('', CountryController::class . ':store');
                    $group->get('/{countryId:[0-9]+}', CountryController::class . ':show');
                    $group->put('/{countryId:[0-9]+}', CountryController::class . ':update');
                    $group->delete('/{countryId:[0-9]+}', CountryController::class . ':destroy');
                }
            );

            $group->group(
                '/customers',
                function (RouteCollectorProxy $group) {
                    $group->get('', CustomerController::class . ':index');
                    $group->post('', CustomerController::class . ':store');
                    $group->get('/{customerId:[0-9]+}', CustomerController::class . ':show');
                    $group->put('/{customerId:[0-9]+}', CustomerController::class . ':update');
                    $group->delete('/{customerId:[0-9]+}', CustomerController::class . ':destroy');
                }
            );

            $group->group(
                '/films',
                function (RouteCollectorProxy $group) {
                    $group->get('', FilmController::class . ':index');
                    $group->post('', FilmController::class . ':store');
                    $group->get('/{filmId:[0-9]+}', FilmController::class . ':show');
                    $group->put('/{filmId:[0-9]+}', FilmController::class . ':update');
                    $group->delete('/{filmId:[0-9]+}', FilmController::class . ':destroy');
                }
            );

            $group->group(
                '/inventory',
                function (RouteCollectorProxy $group) {
                    $group->get('', InventoryController::class . ':index');
                    $group->post('', InventoryController::class . ':store');
                    $group->get('/{inventoryId:[0-9]+}', InventoryController::class . ':show');
                    $group->put('/{inventoryId:[0-9]+}', InventoryController::class . ':update');
                    $group->delete('/{inventoryId:[0-9]+}', InventoryController::class . ':destroy');
                }
            );

            $group->group(
                '/languages',
                function (RouteCollectorProxy $group) {
                    $group->get('', LanguageController::class . ':index');
                    $group->post('', LanguageController::class . ':store');
                    $group->get('/{languageId:[0-9]+}', LanguageController::class . ':show');
                    $group->put('/{languageId:[0-9]+}', LanguageController::class . ':update');
                    $group->delete('/{languageId:[0-9]+}', LanguageController::class . ':destroy');
                }
            );

            $group->group(
                '/payments',
                function (RouteCollectorProxy $group) {
                    $group->get('', PaymentController::class . ':index');
                    $group->post('', PaymentController::class . ':store');
                    $group->get('/{paymentId:[0-9]+}', PaymentController::class . ':show');
                    $group->put('/{paymentId:[0-9]+}', PaymentController::class . ':update');
                    $group->delete('/{paymentId:[0-9]+}', PaymentController::class . ':destroy');
                }
            );

            $group->group(
                '/rentals',
                function (RouteCollectorProxy $group) {
                    $group->get('', RentalController::class . ':index');
                    $group->post('', RentalController::class . ':store');
                    $group->get('/{rentalId:[0-9]+}', RentalController::class . ':show');
                    $group->put('/{rentalId:[0-9]+}', RentalController::class . ':update');
                    $group->delete('/{rentalId:[0-9]+}', RentalController::class . ':destroy');
                }
            );

            $group->group(
                '/staff',
                function (RouteCollectorProxy $group) {
                    $group->get('', StaffController::class . ':index');
                    $group->post('', StaffController::class . ':store');
                    $group->get('/{staffId:[0-9]+}', StaffController::class . ':show');
                    $group->put('/{staffId:[0-9]+}', StaffController::class . ':update');
                    $group->delete('/{staffId:[0-9]+}', StaffController::class . ':destroy');
                }
            );

            $group->group(
                '/stores',
                function (RouteCollectorProxy $group) {
                    $group->get('', StoreController::class . ':index');
                    $group->post('', StoreController::class . ':store');
                    $group->get('/{storeId:[0-9]+}', StoreController::class . ':show');
                    $group->put('/{storeId:[0-9]+}', StoreController::class . ':update');
                    $group->delete('/{storeId:[0-9]+}', StoreController::class . ':destroy');
                }
            );
        }
    )->addMiddleware($app->getContainer()->get(FractalMiddleware::class));
};
