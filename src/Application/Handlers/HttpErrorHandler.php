<?php declare(strict_types=1);


namespace Sakila\Application\Handlers;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseFactoryInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Log\LoggerInterface;
use Slim\Handlers\ErrorHandler as SlimErrorHandler;
use Slim\Interfaces\CallableResolverInterface;

class HttpErrorHandler extends SlimErrorHandler
{
    /**
     * @var \Psr\Log\LoggerInterface
     */
    private LoggerInterface $logger;

    /**
     * @param \Slim\Interfaces\CallableResolverInterface $callableResolver
     * @param \Psr\Http\Message\ResponseFactoryInterface $responseFactory
     * @param \Psr\Log\LoggerInterface                   $logger
     */
    public function __construct(
        CallableResolverInterface $callableResolver,
        ResponseFactoryInterface $responseFactory,
        LoggerInterface $logger
    ){
        $this->logger = $logger;

        parent::__construct($callableResolver, $responseFactory);
    }

    /**
     * @inheritdoc
     */
    protected function respond(): Response
    {
        $exception = $this->exception;

        $this->logger->error($exception->getMessage() . PHP_EOL . $exception->getTraceAsString());

        $statusCode = StatusCodeInterface::STATUS_INTERNAL_SERVER_ERROR;
        $payload    = [
            'error' => [
                'code'    => $statusCode,
                'message' => $exception->getMessage(),
            ],
        ];;
        $encodedPayload = (string)json_encode($payload, JSON_PRETTY_PRINT);

        $response = $this->responseFactory->createResponse($statusCode);
        $response->getBody()->write($encodedPayload);

        return $response->withHeader('Content-Type', 'application/json');
    }
}
