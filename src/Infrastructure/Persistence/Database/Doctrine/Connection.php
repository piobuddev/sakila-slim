<?php declare(strict_types=1);

namespace Sakila\Infrastructure\Persistence\Database\Doctrine;

use Doctrine\DBAL\Driver\Statement;
use Doctrine\DBAL\Query\QueryBuilder;
use Doctrine\ORM\EntityManagerInterface;
use Sakila\Exceptions\UnexpectedValueException;
use Sakila\Infrastructure\Persistence\Database\Doctrine\Query\Builder;
use Sakila\Repository\Database\ConnectionInterface;
use Sakila\Repository\Database\Query\BuilderInterface;

class Connection implements ConnectionInterface
{
    /**
     * @var \Doctrine\DBAL\Connection
     */
    private \Doctrine\DBAL\Connection $connection;

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
        $this->entityManager = $entityManager;
    }

    /**
     * @return \Sakila\Repository\Database\Query\BuilderInterface
     */
    public function query(): BuilderInterface
    {
        return new Builder($this->entityManager);
    }

    /**
     * @param string $table
     * @param array  $data
     *
     * @return bool
     */
    public function insert(string $table, array $data): bool
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $queryBuilder->insert($table);
        $i = 0;
        foreach ($data as $column => $value) {
            $queryBuilder->setValue($column, '?');
            $queryBuilder->setParameter($i++, $value);
        }

        return (bool)$queryBuilder->execute();
    }

    /**
     * @param string $table
     * @param array  $values
     * @param array  $where
     *
     * @return int
     */
    public function update(string $table, array $values, array $where): int
    {
        $queryBuilder = $this->connection->createQueryBuilder();
        $query        = $queryBuilder->update($table);
        $i            = 0;

        foreach ($values as $column => $value) {
            $query->set($column, '?');
            $query->setParameter($i++, $value);
        }

        $this->where($where, $query, $i);

        return $query->execute();
    }

    /**
     * @param string $table
     * @param array  $where
     *
     * @return bool
     */
    public function delete(string $table, array $where): bool
    {
        $query = $this->connection->createQueryBuilder()->delete($table);

        $this->where($where, $query);

        return (bool)$query->execute();
    }

    /**
     * @return int
     */
    public function lastInsertedId(): int
    {
        return (int)$this->connection->lastInsertId();
    }

    /**
     * @param string $table
     *
     * @return int
     * @throws \Sakila\Exceptions\UnexpectedValueException
     */
    public function count(string $table): int
    {
        $query     = $this->connection->createQueryBuilder()->select('*')->from($table);
        $statement = $query->execute();
        if (!$statement instanceof Statement) {
            throw new UnexpectedValueException();
        }

        return $statement->rowCount();
    }

    /**
     * @param array                             $where
     * @param \Doctrine\DBAL\Query\QueryBuilder $query
     * @param int                               $index
     *
     * @return void
     */
    private function where(array $where, QueryBuilder &$query, int $index = 0): void
    {
        if (!empty($where)) {
            $binding = [];
            foreach ($where as $column => $value) {
                $binding[] = $query->expr()->eq($column, '?');
                $query->setParameter($index++, $value);
            }
            $query->where($query->expr()->andX(...$binding));
        }
    }

    /**
     * @param \Closure $callback
     *
     * @return mixed
     * @throws \Exception
     * @throws \Throwable
     */
    public function transaction(\Closure $callback)
    {
        return $this->connection->transactional($callback);
    }
}
