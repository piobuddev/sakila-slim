<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBusInterface;
use Sakila\Domain\Staff\Service\Request\AddStaffRequest;
use Sakila\Domain\Staff\Service\Request\RemoveStaffRequest;
use Sakila\Domain\Staff\Service\Request\ShowStaffRequest;
use Sakila\Domain\Staff\Service\Request\ShowStaffMemberRequest;
use Sakila\Domain\Staff\Service\Request\UpdateStaffRequest;

class StaffController extends AbstractController
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
     * @param int $staffId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $staffId): Response
    {
        $staff = $this->commandBus->execute(new ShowStaffMemberRequest($staffId));

        return $this->response($staff);
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
        $staves = $this->commandBus->execute(new ShowStaffRequest($page, $pageSize));

        return $this->response($staves);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $staff = $this->commandBus->execute(new AddStaffRequest($data));

        return $this->response($staff, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $staffId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $staffId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $staff = $this->commandBus->execute(new UpdateStaffRequest($staffId, $data));

        return $this->response($staff);
    }

    /**
     * @param int $staffId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $staffId): Response
    {
        $this->commandBus->execute(new RemoveStaffRequest($staffId));

        return $this->response();
    }
}
