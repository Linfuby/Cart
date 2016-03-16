<?php
namespace Meling\Cart\Orders\Order\Shops;

/**
 * Class Shop
 * @method string id()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\PHPixie\ORM\Drivers\Driver\PDO\Entity[] deliveries()
 * @package Meling\Cart\Orders\Order\Shops
 */
class Shop
{
    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $entity;

    /**
     * Shop constructor.
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     */
    public function __construct($entity)
    {
        $this->entity = $entity;
    }

    function __call($name, $arguments)
    {
        return $this->entity->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->entity->{$name};
    }

}
