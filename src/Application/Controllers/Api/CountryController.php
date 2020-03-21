<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Country\Service\Request\AddCountryRequest;
use Sakila\Domain\Country\Service\Request\RemoveCountryRequest;
use Sakila\Domain\Country\Service\Request\ShowCountryRequest;
use Sakila\Domain\Country\Service\Request\ShowCountriesRequest;
use Sakila\Domain\Country\Service\Request\UpdateCountryRequest;

class CountryController extends AbstractController
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
     * @param int $countryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $countryId): Response
    {
        $country = $this->commandBus->execute(new ShowCountryRequest($countryId));

        return $this->response($country);
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
        $countries = $this->commandBus->execute(new ShowCountriesRequest($page, $pageSize));

        return $this->response($countries);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $country = $this->commandBus->execute(new AddCountryRequest($data));

        return $this->response($country, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $countryId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $countryId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $country = $this->commandBus->execute(new UpdateCountryRequest($countryId, $data));

        return $this->response($country);
    }

    /**
     * @param int $countryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $countryId): Response
    {
        $this->commandBus->execute(new RemoveCountryRequest($countryId));

        return $this->response();
    }
}
