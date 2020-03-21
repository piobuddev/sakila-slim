<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Rental\Service\Request\AddRentalRequest;
use Sakila\Domain\Rental\Service\Request\RemoveRentalRequest;
use Sakila\Domain\Rental\Service\Request\ShowRentalRequest;
use Sakila\Domain\Rental\Service\Request\ShowRentalsRequest;
use Sakila\Domain\Rental\Service\Request\UpdateRentalRequest;

class RentalController extends AbstractController
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
     * @param int $rentalId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $rentalId): Response
    {
        $rental = $this->commandBus->execute(new ShowRentalRequest($rentalId));

        return $this->response($rental);
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
        $rentals = $this->commandBus->execute(new ShowRentalsRequest($page, $pageSize));

        return $this->response($rentals);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $rental = $this->commandBus->execute(new AddRentalRequest($data));

        return $this->response($rental, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $rentalId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $rentalId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $rental = $this->commandBus->execute(new UpdateRentalRequest($rentalId, $data));

        return $this->response($rental);
    }

    /**
     * @param int $rentalId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $rentalId): Response
    {
        $this->commandBus->execute(new RemoveRentalRequest($rentalId));

        return $this->response();
    }
}
