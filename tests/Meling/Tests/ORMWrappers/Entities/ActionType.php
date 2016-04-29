<?php
namespace Meling\Tests\ORMWrappers\Entities;

/**
 * Class ActionType
 * @package Meling\Tests\ORMWrappers\Entities
 */
class ActionType extends \Meling\Tests\ORMWrappers\Entity
{
    /**
     * @param \Meling\Tests\ORMWrappers\Entities\AllAction $action
     * @param \Meling\Cart\Products\Product[]              $products
     * @return int
     */
    public function calculate($action, $products)
    {
        $total = 0;
        $class = __NAMESPACE__ . '\ActionType\Type' . $this->id();
        //echo $this->id();
        if(class_exists($class)) {
            /** @var ActionType\Type $type */
            $type  = new $class($action, $products);
            $total = $type->total();
        }

        return $total;
    }
}