<?php
namespace Meling\Cart\Totals;

class Total
{
    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var \Meling\Cart\Actions
     */
    protected $actionsAfter;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    /**
     * @var int
     */
    protected $total;

    /**
     * Total constructor.
     * @param \Meling\Cart\Totals     $totals
     * @param \Meling\Cart\Products   $products
     * @param \Meling\Cart\Actions    $actionsAfter
     * @param \Meling\Cart\Cards\Card $card
     */
    public function __construct($totals, $products, $actionsAfter, $card)
    {
        $this->totals       = $totals;
        $this->products     = $products;
        $this->actionsAfter = $actionsAfter;
        $this->card         = $card;
    }

    public function name()
    {
        return 'Итого:';
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = ($this->totals->amount()->total() + $this->totals->shipping()->total()) - ($this->totals->action()->total() + $this->totals->card()->total());
            foreach($this->actionsAfter->asArray() as $action) {
                $this->total -= $action->calculate($this->card, $this->products);
            }
        }

        return $this->total;
    }

}
