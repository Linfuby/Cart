<?php
namespace Meling\Cart;

class Wrappers extends \PHPixie\ORM\Wrappers\Implementation
{
    protected $databaseEntities = array(
        'cart',
        'cartCertificate',
        'certificate',
        'customer',
        'option',
        'order',
        'orderCertificate',
        'orderProduct',
    );

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     * @return Wrappers\Entity
     */
    protected function entityWrapper($entity)
    {
        $class = '\Meling\Cart\Wrappers\\' . ucfirst($entity->modelName()) . '\Entity';
        if(class_exists($class)) {
            return new $class($entity);
        }

        return new Wrappers\Entity($entity);
    }

}
