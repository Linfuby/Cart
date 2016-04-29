<?php
namespace Meling\Cart\Orders\Order\Totals;

class Action implements Totals
{
    /**
     * @var \Meling\Cart\Orders\Order\Products
     */
    protected $products;

    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    /**
     * @var \Meling\Cart\Orders\Order\Totals
     */
    protected $totals;

    /**
     * @var int
     */
    private $total;

    /**
     * Action constructor.
     * @param \Meling\Cart\Orders\Order\Totals             $totals
     * @param \Meling\Cart\Orders\Order\Products\Product[] $products
     * @param \Meling\Cart\Actions\Action                  $action
     */
    public function __construct(
        \Meling\Cart\Orders\Order\Totals $totals,
        $products,
        \Meling\Cart\Actions\Action $action)
    {
        $this->totals   = $totals;
        $this->products = $products;
        $this->action   = $action;
    }

    public function add($priceTotal, $discountAction, $percent = true)
    {
        if($percent) {
            $this->total += round($priceTotal / 100 * $discountAction);
        } else {
            $this->total += $discountAction;
        }
    }

    public function id()
    {
        return $this->action ? $this->action->id() : null;
    }

    public function name()
    {
        return 'Скидка по акции:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    public function total()
    {
        if($this->total === null) {
            $this->action->type()->total();
            if($this->total === null) {
                $this->total = 0;
            }
        }

        return $this->total;
    }

}
