<?php
namespace Meling\Cart\Orders\Order\Totals;

class Total implements Totals
{
    /**
     * @var \Meling\Cart\Orders\Order\Totals
     */
    protected $totals;

    /**
     * @var int
     */
    private $total;

    /**
     * Total constructor.
     * @param \Meling\Cart\Orders\Order\Totals $totals
     */
    public function __construct($totals)
    {
        $this->totals = $totals;
    }

    public function name()
    {
        return 'Итого:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = $this->totals->amount()->total() + $this->totals->shipping()->total() - ($this->totals->action()->total() + $this->totals->card()->total());
        }

        return $this->total;
    }

}
