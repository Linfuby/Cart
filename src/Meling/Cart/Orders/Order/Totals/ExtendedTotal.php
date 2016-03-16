<?php
namespace Meling\Cart\Orders\Order\Totals;

abstract class ExtendedTotal
{
    /**
     * @var \Meling\Cart\Orders\Order\Totals
     */
    protected $totals;

    protected $total;

    /**
     * Total constructor.
     * @param \Meling\Cart\Orders\Order\Totals $totals
     */
    public function __construct($totals)
    {
        $this->totals = $totals;
    }

    /**
     * @return \Meling\Cart\Orders\Order\Products
     */
    public function products()
    {
        return $this->totals->products();
    }

    public abstract function name();

    public abstract function total();

}
