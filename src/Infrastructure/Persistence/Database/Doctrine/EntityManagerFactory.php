<?php declare(strict_types=1);


namespace Sakila\Infrastructure\Persistence\Database\Doctrine;

use Doctrine\ORM\Configuration;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver;

class EntityManagerFactory
{
    private const MAPPING_PATH      = APP_PATH . '/src/Infrastructure/Persistence/Database/Doctrine/Mapping';
    private const PROXY_PATH        = APP_PATH . '/src/Infrastructure/Persistence/Database/Doctrine/Mapping/Proxies';
    private const ENTITY_NAMESPACE  = 'Sakila\Domain\Entity';
    private const ENTITY_ALIAS      = 'Sakila';
    private const PROXY_NAMESPACE   = 'Proxies';

    /**
     * @param array $connection
     *
     * @return \Doctrine\ORM\EntityManagerInterface
     * @throws \Doctrine\ORM\ORMException
     */
    public function create(array $connection): EntityManagerInterface
    {
        $driver = new SimplifiedXmlDriver([self::MAPPING_PATH => self::ENTITY_NAMESPACE]);
        $config = new Configuration();
        $config->setMetadataDriverImpl($driver);
        $config->setProxyDir(self::PROXY_PATH);
        $config->setProxyNamespace(self::PROXY_NAMESPACE);
        $config->addEntityNamespace(self::ENTITY_ALIAS, self::ENTITY_NAMESPACE);

        return EntityManager::create($connection, $config);
    }
}
