<?php
namespace Meling\Tests;

/**
 * Class ORMWrappers
 * @package Meling\Tests
 */
class ORMWrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    public function databaseEntities()
    {
        return array(
            'customer',
            'cartCertificate',
        );
    }

    public function databaseQueries()
    {
        return $this->databaseEntities();
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Query $query
     * @return \PHPixie\ORM\Wrappers\Type\Database\Query
     */
    public function databaseQueryWrapper($query)
    {
        $class = '\Meling\Tests\ORMWrappers\Queries\\' . ucfirst($query->modelName());
        if(class_exists($class)) {
            return new $class($query);
        }

        return new ORMWrappers\Query($query);
    }

    public function databaseRepositories()
    {
        return $this->databaseEntities();
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Repository $repository
     * @return \PHPixie\ORM\Wrappers\Type\Database\Repository
     */
    public function databaseRepositoryWrapper($repository)
    {
        $class = '\Meling\Tests\ORMWrappers\Repositories\\' . ucfirst($repository->modelName());
        if(class_exists($class)) {
            return new $class($repository);
        }

        return new ORMWrappers\Repository($repository);
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected function entityWrapper($entity)
    {
        $class = '\Meling\Tests\ORMWrappers\Entities\\' . ucfirst($entity->modelName());
        if(class_exists($class)) {
            return new $class($entity);
        }

        return new ORMWrappers\Entity($entity);
    }

}
