<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Address\Service\Request\AddAddressRequest;
use Sakila\Domain\Address\Service\Request\RemoveAddressRequest;
use Sakila\Domain\Address\Service\Request\ShowAddressRequest;
use Sakila\Domain\Address\Service\Request\ShowAddressesRequest;
use Sakila\Domain\Address\Service\Request\UpdateAddressRequest;

class AddressController extends AbstractController
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
     * @param int $addressId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $addressId): Response
    {
        $address = $this->commandBus->execute(new ShowAddressRequest($addressId));

        return $this->response($address);
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
        $addresses = $this->commandBus->execute(new ShowAddressesRequest($page, $pageSize));

        return $this->response($addresses);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $address = $this->commandBus->execute(new AddAddressRequest($data));

        return $this->response($address, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $addressId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $addressId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $address = $this->commandBus->execute(new UpdateAddressRequest($addressId, $data));

        return $this->response($address);
    }

    /**
     * @param int $addressId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $addressId): Response
    {
        $this->commandBus->execute(new RemoveAddressRequest($addressId));

        return $this->response();
    }
}
