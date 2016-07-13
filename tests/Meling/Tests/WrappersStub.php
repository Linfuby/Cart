<?php
namespace Meling\Tests;

class WrappersStub extends \PHPixie\ORM\Wrappers\Implementation
{
    protected $databaseEntities = array(
        'address',
        'action',
        'actionType',
        'certificate',
        'city',
        'customer',
        'option',
        'order',
    );

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     * @return mixed
     */
    protected function entityWrapper($entity)
    {
        $class = 'Parishop\ORMWrappers\\' . ucfirst($entity->modelName()) . '\Entity';
        if(class_exists($class)) {
            return new $class($entity, null);
        }

        return $entity;
    }
}
