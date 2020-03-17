<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Actor\Service\Request\AddActorRequest;
use Sakila\Domain\Actor\Service\Request\RemoveActorRequest;
use Sakila\Domain\Actor\Service\Request\ShowActorRequest;
use Sakila\Domain\Actor\Service\Request\ShowActorsRequest;
use Sakila\Domain\Actor\Service\Request\UpdateActorRequest;

class ActorController extends AbstractController
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
     * @param int $actorId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $actorId): Response
    {
        throw new \Exception('test');
        $actor = $this->commandBus->execute(new ShowActorRequest($actorId));

        return $this->response($actor);
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
        $actors = $this->commandBus->execute(new ShowActorsRequest($page, $pageSize));

        return $this->response($actors);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $actor = $this->commandBus->execute(new AddActorRequest($data));

        return $this->response($actor, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $actorId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $actorId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $actor = $this->commandBus->execute(new UpdateActorRequest($actorId, $data));

        return $this->response($actor);
    }

    /**
     * @param int $actorId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $actorId): Response
    {
        $this->commandBus->execute(new RemoveActorRequest($actorId));

        return $this->response();
    }
}
