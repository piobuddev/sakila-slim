<?php declare(strict_types=1);


namespace Sakila\Application\Controllers\Api;

use Fig\Http\Message\StatusCodeInterface;
use Psr\Http\Message\ResponseInterface as Response;
use Psr\Http\Message\ServerRequestInterface as Request;
use Sakila\Command\Bus\CommandBus;
use Sakila\Domain\Language\Service\Request\AddLanguageRequest;
use Sakila\Domain\Language\Service\Request\RemoveLanguageRequest;
use Sakila\Domain\Language\Service\Request\ShowLanguageRequest;
use Sakila\Domain\Language\Service\Request\ShowLanguagesRequest;
use Sakila\Domain\Language\Service\Request\UpdateLanguageRequest;

class LanguageController extends AbstractController
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
     * @param int $languageId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function show(int $languageId): Response
    {
        $language = $this->commandBus->execute(new ShowLanguageRequest($languageId));

        return $this->response($language);
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
        $languages = $this->commandBus->execute(new ShowLanguagesRequest($page, $pageSize));

        return $this->response($languages);
    }

    /**
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function store(Request $request): Response
    {
        $data  = (array)$request->getParsedBody();
        $language = $this->commandBus->execute(new AddLanguageRequest($data));

        return $this->response($language, StatusCodeInterface::STATUS_CREATED);
    }

    /**
     * @param int                                      $languageId
     * @param \Psr\Http\Message\ServerRequestInterface $request
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function update(int $languageId, Request $request): Response
    {
        $data = json_decode((string)$request->getBody(), true);
        $language = $this->commandBus->execute(new UpdateLanguageRequest($languageId, $data));

        return $this->response($language);
    }

    /**
     * @param int $languageId
     *
     * @return \Psr\Http\Message\ResponseInterface
     */
    public function destroy(int $languageId): Response
    {
        $this->commandBus->execute(new RemoveLanguageRequest($languageId));

        return $this->response();
    }
}
