<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ResponseInterface as Response;

class AbstractController
{
    protected const DEFAULT_PAGE = 1;
    protected const DEFAULT_PAGE_SIZE = 15;

    /**
     * @var \Psr\Http\Message\ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @param \Psr\Http\Message\ResponseInterface $response
     */
    public function setResponse(ResponseInterface $response): void
    {
        $this->response = $response;
    }

    /**
     * @param mixed $data
     * @param int   $code
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    protected function response($data = null, $code = StatusCodeInterface::STATUS_OK): Response
    {
        $data = (string)json_encode($data, JSON_PRETTY_PRINT);
        $this->response->getBody()->write($data);

        return $this->response
            ->withHeader('Content-Type', 'application/json')
            ->withStatus($code);
    }
}
