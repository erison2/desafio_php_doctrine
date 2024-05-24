<?php

namespace App\Utils;

use Doctrine\ORM\ORMSetup;
use Doctrine\ORM\EntityManager;

class Database
{
    private $entityManager;

    public function __construct()
    {
        $paths = [__DIR__ . '/../Models'];
        $isDevMode = true;

        $dbParams = [
            'url' => 'mysql://root:root@db/pedido_app',
        ];

        $config = ORMSetup::createAnnotationMetadataConfiguration($paths, $isDevMode);

        $this->entityManager = EntityManager::create($dbParams, $config);
    }

    public function getEntityManager()
    {
        return $this->entityManager;
    }
}
