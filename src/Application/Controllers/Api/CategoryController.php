<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Category\Service\Request\AddCategoryRequest;
use Sakila\Domain\Category\Service\Request\RemoveCategoryRequest;
use Sakila\Domain\Category\Service\Request\ShowCategoryRequest;
use Sakila\Domain\Category\Service\Request\ShowCategoriesRequest;
use Sakila\Domain\Category\Service\Request\UpdateCategoryRequest;

class CategoryController extends AbstractController
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
     * @param int $categoryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $categoryId): Response
    {
        $category = $this->commandBus->execute(new ShowCategoryRequest($categoryId));

        return $this->response($category);
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
        $categories = $this->commandBus->execute(new ShowCategoriesRequest($page, $pageSize));

        return $this->response($categories);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $category = $this->commandBus->execute(new AddCategoryRequest($data));

        return $this->response($category, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $categoryId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $categoryId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $category = $this->commandBus->execute(new UpdateCategoryRequest($categoryId, $data));

        return $this->response($category);
    }

    /**
     * @param int $categoryId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $categoryId): Response
    {
        $this->commandBus->execute(new RemoveCategoryRequest($categoryId));

        return $this->response();
    }
}
