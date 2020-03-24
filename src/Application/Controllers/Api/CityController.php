<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\City\Service\Request\AddCityRequest;
use Sakila\Domain\City\Service\Request\RemoveCityRequest;
use Sakila\Domain\City\Service\Request\ShowCityRequest;
use Sakila\Domain\City\Service\Request\ShowCitiesRequest;
use Sakila\Domain\City\Service\Request\UpdateCityRequest;

class CityController extends AbstractController
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
     * @param int $cityId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $cityId): Response
    {
        $city = $this->commandBus->execute(new ShowCityRequest($cityId));

        return $this->response($city);
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
        $cities = $this->commandBus->execute(new ShowCitiesRequest($page, $pageSize));

        return $this->response($cities);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $city = $this->commandBus->execute(new AddCityRequest($data));

        return $this->response($city, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $cityId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $cityId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $city = $this->commandBus->execute(new UpdateCityRequest($cityId, $data));

        return $this->response($city);
    }

    /**
     * @param int $cityId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $cityId): Response
    {
        $this->commandBus->execute(new RemoveCityRequest($cityId));

        return $this->response();
    }
}
