<?php declare(strict_types=1);


namespace Sakila\Application\Handlers;

use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Application\ResponseEmitter\ResponseEmitter;
use Slim\Exception\HttpInternalServerErrorException;

class ShutdownHandler
{
    /**
     * @var Request
     */
    private Request $request;

    /**
     * @var HttpErrorHandler
     */
    private HttpErrorHandler $errorHandler;

    /**
     * @var bool
     */
    private bool $displayErrorDetails;

    /**
     * @param Request          $request
     * @param HttpErrorHandler $errorHandler
     * @param bool             $displayErrorDetails
     */
    public function __construct(
        Request $request,
        HttpErrorHandler $errorHandler,
        bool $displayErrorDetails
    ) {
        $this->request             = $request;
        $this->errorHandler        = $errorHandler;
        $this->displayErrorDetails = $displayErrorDetails;
    }

    public function __invoke(): void
    {
        $error = error_get_last();
        if ($error) {
            $errorFile    = $error['file'];
            $errorLine    = $error['line'];
            $errorMessage = $error['message'];
            $errorType    = $error['type'];
            $message      = 'An error while processing your request. Please try again later.';

            if ($this->displayErrorDetails) {
                switch ($errorType) {
                    case E_USER_ERROR:
                        $message = "FATAL ERROR: {$errorMessage}. ";
                        $message .= " on line {$errorLine} in file {$errorFile}.";
                        break;

                    case E_USER_WARNING:
                        $message = "WARNING: {$errorMessage}";
                        break;

                    case E_USER_NOTICE:
                        $message = "NOTICE: {$errorMessage}";
                        break;

                    default:
                        $message = "ERROR: {$errorMessage}";
                        $message .= " on line {$errorLine} in file {$errorFile}.";
                        break;
                }
            }

            $exception = new HttpInternalServerErrorException($this->request, $message);
            $response  = $this->errorHandler->__invoke(
                $this->request,
                $exception,
                $this->displayErrorDetails,
                false,
                false
            );

            $responseEmitter = new ResponseEmitter();
            $responseEmitter->emit($response);
        }
    }
}
