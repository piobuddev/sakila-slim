<?php declare(strict_types=1);


namespace Sakila\Application\Handlers\Strategies;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Sakila\Application\Controllers\Api\AbstractController;
use Slim\Interfaces\InvocationStrategyInterface;

use function array_values;

class ApiResourceStrategy implements InvocationStrategyInterface
{
    /**
     * @param callable               $callable
     * @param ServerRequestInterface $request
     * @param ResponseInterface      $response
     * @param array                  $routeArguments
     *
     * @return ResponseInterface
     */
    public function __invoke(
        callable $callable,
        ServerRequestInterface $request,
        ResponseInterface $response,
        array $routeArguments
    ): ResponseInterface {
        if (is_array($callable) && isset($callable[0]) && $callable[0] instanceof AbstractController) {
            $callable[0]->setResponse($response);
        }

        $routeArguments = array_map(function ($value) {
            return is_numeric($value) ? intval($value) : $value;
        }, $routeArguments);

        array_push($routeArguments, $request);
        array_push($routeArguments, $response);

        return $callable(...array_values($routeArguments));
    }
}
