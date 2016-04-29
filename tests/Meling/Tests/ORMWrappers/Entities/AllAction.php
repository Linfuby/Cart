<?php
namespace Meling\Tests\ORMWrappers\Entities;

/**
 * Class AllAction
 * @method \Meling\Tests\ORMWrappers\Entities\ActionType actionType()
 * @package Meling\Tests\ORMWrappers\Entities
 */
class AllAction extends \Meling\Tests\ORMWrappers\Entity
{
    /**
     * @param \Meling\Cart\Products\Product[] $products
     * @return int
     */
    public function calculate($products)
    {
        return $this->actionType()->calculate($this, $products);
    }

}
