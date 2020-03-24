<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Inventory\Service\Request\AddInventoryRequest;
use Sakila\Domain\Inventory\Service\Request\RemoveInventoryRequest;
use Sakila\Domain\Inventory\Service\Request\ShowInventoryRequest;
use Sakila\Domain\Inventory\Service\Request\ShowInventoriesRequest;
use Sakila\Domain\Inventory\Service\Request\UpdateInventoryRequest;

class InventoryController extends AbstractController
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
     * @param int $inventoryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $inventoryId): Response
    {
        $inventory = $this->commandBus->execute(new ShowInventoryRequest($inventoryId));

        return $this->response($inventory);
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
        $inventories = $this->commandBus->execute(new ShowInventoriesRequest($page, $pageSize));

        return $this->response($inventories);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $inventory = $this->commandBus->execute(new AddInventoryRequest($data));

        return $this->response($inventory, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $inventoryId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $inventoryId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $inventory = $this->commandBus->execute(new UpdateInventoryRequest($inventoryId, $data));

        return $this->response($inventory);
    }

    /**
     * @param int $inventoryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $inventoryId): Response
    {
        $this->commandBus->execute(new RemoveInventoryRequest($inventoryId));

        return $this->response();
    }
}
