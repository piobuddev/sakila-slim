<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Payment\Service\Request\AddPaymentRequest;
use Sakila\Domain\Payment\Service\Request\RemovePaymentRequest;
use Sakila\Domain\Payment\Service\Request\ShowPaymentRequest;
use Sakila\Domain\Payment\Service\Request\ShowPaymentsRequest;
use Sakila\Domain\Payment\Service\Request\UpdatePaymentRequest;

class PaymentController extends AbstractController
{
    /**
     * @var \Sakila\Command\Bus\CommandBusInterface
     */
    private CommandBusInterface $commandBus;

    /**
     * @param \Sakila\Command\Bus\CommandBusInterface $commandBus
     */
    public function __construct(CommandBusInterface $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param int $paymentId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $paymentId): Response
    {
        $payment = $this->commandBus->execute(new ShowPaymentRequest($paymentId));

        return $this->response($payment);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function index(Request $request): Response
    {
        $queryParams = $request->getQueryParams();
        $page = (int)($queryParams['page'] ?? self::DEFAULT_PAGE);
        $pageSize = (int)($queryParams['page_size'] ?? self::DEFAULT_PAGE_SIZE);
        $payments = $this->commandBus->execute(new ShowPaymentsRequest($page, $pageSize));

        return $this->response($payments);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $payment = $this->commandBus->execute(new AddPaymentRequest($data));

        return $this->response($payment, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $paymentId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $paymentId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $payment = $this->commandBus->execute(new UpdatePaymentRequest($paymentId, $data));

        return $this->response($payment);
    }

    /**
     * @param int $paymentId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $paymentId): Response
    {
        $this->commandBus->execute(new RemovePaymentRequest($paymentId));

        return $this->response();
    }
}
