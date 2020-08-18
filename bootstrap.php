<?php

require_once "vendor/autoload.php";

use App\Entities\PriceType;
use Doctrine\DBAL\Types\Type;
use Doctrine\ORM\Tools\Setup;
use Doctrine\ORM\EntityManager;

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

$paths     = [__DIR__ . "/app/Entities"];
$isDevMode = true;
$proxyDir  = null;
$cache     = null;

$config = Setup::createAnnotationMetadataConfiguration($paths, $isDevMode, $proxyDir, $cache, false);

$dbParams = [
    'url'      => 'mysql://mysql',
    'driver'   => 'pdo_mysql',
    'user'     => $_ENV['MYSQL_USER_NAME'],
    'password' => $_ENV['MYSQL_USER_PASS'],
    'dbname'   => $_ENV['MYSQL_BD_NAME'],
];

Type::addType(PriceType::NAME, PriceType::class);

return EntityManager::create($dbParams, $config);
