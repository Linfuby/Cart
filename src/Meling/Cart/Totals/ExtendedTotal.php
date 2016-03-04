<?php
namespace Meling\Cart\Totals;

abstract class ExtendedTotal
{
    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    protected $total;

    /**
     * Total constructor.
     * @param \Meling\Cart\Totals $totals
     */
    public function __construct($totals)
    {
        $this->totals = $totals;
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function products()
    {
        return $this->totals->products();
    }

    public abstract function name();

    public abstract function total();
}