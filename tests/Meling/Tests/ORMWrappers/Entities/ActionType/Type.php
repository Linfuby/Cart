<?php
namespace Meling\Tests\ORMWrappers\Entities\ActionType;

abstract class Type
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\AllAction
     */
    protected $action;

    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * Type53000 constructor.
     * @param \Meling\Tests\ORMWrappers\Entities\AllAction $action
     * @param \Meling\Cart\Products\Product[]              $products
     */
    public function __construct(\Meling\Tests\ORMWrappers\Entities\AllAction $action, array $products)
    {
        $this->action   = $action;
        $this->products = $products;
    }

    public abstract function total();

}