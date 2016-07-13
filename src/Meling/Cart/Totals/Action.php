<?php
namespace Meling\Cart\Totals;

class Action
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var \Meling\Cart\Actions\Action
     */
    protected $action;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    /**
     * @var int
     */
    private $total;

    /**
     * Action constructor.
     * @param \Meling\Cart\Products       $products
     * @param \Meling\Cart\Actions\Action $action
     * @param \Meling\Cart\Cards\Card     $card
     */
    public function __construct($products, $action, \Meling\Cart\Cards\Card $card)
    {
        $this->products = $products;
        $this->action   = $action;
        $this->card     = $card;
    }

    public function id()
    {
        return $this->action->id();
    }

    public function name()
    {
        return 'Скидка по акции:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    public function total($pointCheck = false)
    {
        if($pointCheck || $this->total === null) {
            $this->total = 0;
            $this->total = $this->action->calculate($this->card, $this->products, $pointCheck);
        }

        return $this->total;
    }

}
