<?php declare(strict_types=1);


namespace Sakila\Application\Middleware;

use League\Fractal\Manager;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Psr\Http\Server\MiddlewareInterface as Middleware;
use Psr\Http\Server\RequestHandlerInterface as RequestHandler;

class FractalMiddleware implements Middleware
{
    /**
     * @var \League\Fractal\Manager
     */
    private Manager $manager;

    /**
     * @param \League\Fractal\Manager $manager
     */
    public function __construct(Manager $manager)
    {
        $this->manager = $manager;
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     * @param \Psr\Http\Server\RequestHandlerInterface $handler
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function process(Request $request, RequestHandler $handler): Response
    {
        $query = $request->getQueryParams();
        if (isset($query['include'])) {
            $this->manager->parseIncludes($query['include']);
        };

        return $handler->handle($request);
    }
}
