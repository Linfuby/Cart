<?php
namespace Meling\Cart\Totals;

class Bonuses
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\AllAction[]
     */
    protected $actions;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * Bonuses constructor.
     * @param \Meling\Tests\ORMWrappers\Entities\AllAction[] $actions
     * @param \Meling\Cart\Products\Product[]                $products
     */
    public function __construct(array $actions, array $products)
    {
        $this->actions  = $actions;
        $this->products = $products;
    }

    public function name()
    {
        return 'Начислено бонусов';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
            foreach($this->actions as $action) {
                $this->total += $action->calculate($this->products);
            }
        }

        return $this->total;
    }

}
