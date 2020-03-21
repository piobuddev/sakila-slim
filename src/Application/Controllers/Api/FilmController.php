<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Film\Service\Request\AddFilmRequest;
use Sakila\Domain\Film\Service\Request\RemoveFilmRequest;
use Sakila\Domain\Film\Service\Request\ShowFilmRequest;
use Sakila\Domain\Film\Service\Request\ShowFilmsRequest;
use Sakila\Domain\Film\Service\Request\UpdateFilmRequest;

class FilmController extends AbstractController
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
     * @param int $filmId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $filmId): Response
    {
        $film = $this->commandBus->execute(new ShowFilmRequest($filmId));

        return $this->response($film);
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
        $films = $this->commandBus->execute(new ShowFilmsRequest($page, $pageSize));

        return $this->response($films);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $film = $this->commandBus->execute(new AddFilmRequest($data));

        return $this->response($film, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $filmId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $filmId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $film = $this->commandBus->execute(new UpdateFilmRequest($filmId, $data));

        return $this->response($film);
    }

    /**
     * @param int $filmId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $filmId): Response
    {
        $this->commandBus->execute(new RemoveFilmRequest($filmId));

        return $this->response();
    }
}
