<?php
namespace Meling\Cart\Totals;

class Action
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * @var \Parishop\ORMWrappers\Action\Entity
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
     * @param \Meling\Cart\Products\Product[]     $products
     * @param \Parishop\ORMWrappers\Action\Entity $action
     * @param \Meling\Cart\Cards\Card             $card
     */
    public function __construct(array $products, $action, \Meling\Cart\Cards\Card $card)
    {
        $this->products = $products;
        $this->action   = $action;
        $this->card     = $card;
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
            $this->total = 0;
            if($this->action) {
                $this->total = $this->action->actionType()->calculate($this->action, $this->card, $this->products);
            }
        }

        return $this->total;
    }

}
