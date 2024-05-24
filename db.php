<?php

require_once 'vendor/autoload.php';

use App\Utils\Database;
use Doctrine\ORM\Tools\SchemaTool;
use Doctrine\ORM\Tools\ToolsException;

$db = new Database();
$entityManager = $db->getEntityManager();
$schemaTool = new SchemaTool($entityManager);

// Coleta os metadados das entidades User e Order
$classes = [
    $entityManager->getClassMetadata('App\Models\User'),
    $entityManager->getClassMetadata('App\Models\Order'),
];

try {
    // Tenta criar o esquema do banco de dados
    $schemaTool->createSchema($classes);
    echo "Database schema created successfully.\n";
} catch (ToolsException $e) {
    echo "Error creating database schema: " . $e->getMessage() . "\n";
}
