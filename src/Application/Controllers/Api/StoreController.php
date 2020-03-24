<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Store\Service\Request\AddStoreRequest;
use Sakila\Domain\Store\Service\Request\RemoveStoreRequest;
use Sakila\Domain\Store\Service\Request\ShowStoreRequest;
use Sakila\Domain\Store\Service\Request\ShowStoresRequest;
use Sakila\Domain\Store\Service\Request\UpdateStoreRequest;

class StoreController extends AbstractController
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
     * @param int $storeId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $storeId): Response
    {
        $store = $this->commandBus->execute(new ShowStoreRequest($storeId));

        return $this->response($store);
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
        $stores = $this->commandBus->execute(new ShowStoresRequest($page, $pageSize));

        return $this->response($stores);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $store = $this->commandBus->execute(new AddStoreRequest($data));

        return $this->response($store, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $storeId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $storeId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $store = $this->commandBus->execute(new UpdateStoreRequest($storeId, $data));

        return $this->response($store);
    }

    /**
     * @param int $storeId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $storeId): Response
    {
        $this->commandBus->execute(new RemoveStoreRequest($storeId));

        return $this->response();
    }
}
