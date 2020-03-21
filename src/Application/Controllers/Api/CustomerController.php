<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Customer\Service\Request\AddCustomerRequest;
use Sakila\Domain\Customer\Service\Request\RemoveCustomerRequest;
use Sakila\Domain\Customer\Service\Request\ShowCustomerRequest;
use Sakila\Domain\Customer\Service\Request\ShowCustomersRequest;
use Sakila\Domain\Customer\Service\Request\UpdateCustomerRequest;

class CustomerController extends AbstractController
{
    /**
     * @var \Sakila\Command\Bus\CommandBus
     */
    private CommandBus $commandBus;

    /**
     * @param \Sakila\Command\Bus\CommandBus $commandBus
     */
    public function __construct(CommandBus $commandBus)
    {
        $this->commandBus = $commandBus;
    }

    /**
     * @param int $customerId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $customerId): Response
    {
        $customer = $this->commandBus->execute(new ShowCustomerRequest($customerId));

        return $this->response($customer);
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
        $customers = $this->commandBus->execute(new ShowCustomersRequest($page, $pageSize));

        return $this->response($customers);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $customer = $this->commandBus->execute(new AddCustomerRequest($data));

        return $this->response($customer, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $customerId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $customerId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $customer = $this->commandBus->execute(new UpdateCustomerRequest($customerId, $data));

        return $this->response($customer);
    }

    /**
     * @param int $customerId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $customerId): Response
    {
        $this->commandBus->execute(new RemoveCustomerRequest($customerId));

        return $this->response();
    }
}
