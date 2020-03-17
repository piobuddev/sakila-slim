<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;

// replace with file to your own project bootstrap
require_once __DIR__ . '/../vendor/autoload.php';

$connection = $connectionOptions = array(
    'driver'   => 'pdo_mysql',
    'host'     => 'mysql',
    'dbname'   => 'sakila_test',
    'user'     => 'test',
    'password' => 'test'
);

$driver = new \Doctrine\ORM\Mapping\Driver\SimplifiedXmlDriver([__DIR__ . '/../app/Mapping' => 'Sakila\Entity']);
$config = new \Doctrine\ORM\Configuration();
$config->setMetadataDriverImpl($driver);
$config->setProxyDir(__DIR__ . '/../app/Mapping/Proxies');
$config->setProxyNamespace('Proxies');

$em = \Doctrine\ORM\EntityManager::create($connection, $config);

return ConsoleRunner::createHelperSet($em);