<?php declare(strict_types=1);

namespace Sakila\Infrastructure\Persistence\Database\Doctrine\Query;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\QueryBuilder;
use Sakila\Repository\Database\Query\BuilderInterface;
use Sakila\Utils\StringUtil;

class Builder implements BuilderInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private Connection $connection;

    /**
     * @var \Doctrine\ORM\QueryBuilder
     */
    private QueryBuilder $query;

    /**
     * @var \Doctrine\ORM\EntityManagerInterface
     */
    private EntityManagerInterface $entityManager;

    /**
     * @param \Doctrine\ORM\EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->connection    = $entityManager->getConnection();
        $this->query         = $entityManager->createQueryBuilder();
        $this->entityManager = $entityManager;
    }

    /**
     * @param array<string> $columns
     *
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function select(array $columns = null): BuilderInterface
    {
        $columns = $columns ?: null;

        $this->query->select($columns);

        return $this;
    }

    /**
     * @param string $table
     *
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function from(string $table): BuilderInterface
    {
        $repository = sprintf('Sakila:%s', ucfirst($table));
        $select     = $this->query->getDQLPart('select');
        $alias      = substr($table, 0, 1);
        if (empty($select)) {
            $this->query->select($alias);
        }

        $this->query->from($repository, $alias);

        return $this;
    }

    /**
     * @param array $where
     *
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function where(array $where): BuilderInterface
    {
        if (!empty($where)) {
            $binding = [];
            $alias   = $this->getRootAlias();
            $i       = 0;
            foreach ($where as $column => $value) {
                $aliasColumn = sprintf('%s.%s', $alias, StringUtil::toCamelCase((string)$column));
                $binding[]   = $this->query->expr()->eq($aliasColumn, sprintf('?%s', $i));
                $this->query->setParameter($i++, $value);
            }

            $this->query->where($this->query->expr()->andX(...$binding));
        }

        return $this;
    }

    /**
     * @param array $order
     *
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function order(array $order): BuilderInterface
    {
        list($column, $dir) = array_pad($order, 2, 'asc');
        $aliasColumn = sprintf('%s.%s', $this->getRootAlias(), $column);

        $this->query->orderBy($aliasColumn, $dir);

        return $this;
    }

    /**
     * @param int $limit
     *
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function limit(int $limit): BuilderInterface
    {
        $this->query->setFirstResult(0)->setMaxResults($limit);

        return $this;
    }

    /**
     * @return array
     */
    public function get(): array
    {
        return $this->query->getQuery()->getResult();
    }

    /**
     * @param int|null $page
     * @param int      $pageSize
     *
     * @return array
     */
    public function paginate(?int $page, int $pageSize): array
    {
        $page = $page ?: 1;

        $this->query
            ->setFirstResult(($page - 1) * $pageSize)
            ->setMaxResults($pageSize);

        return $this->query->getQuery()->getResult();
    }

    /**
     * @return string
     */
    private function getRootAlias(): string
    {
        $aliases = $this->query->getRootAliases();
        $alias   = array_pop($aliases);

        return $alias ?: '';
    }
}
