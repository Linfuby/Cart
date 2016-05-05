<?php
namespace Meling\Cart\Totals;

class Card
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $products;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $action;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    private   $total;

    /**
     * Card constructor.
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

    public function name()
    {
        return 'Скидка по Клубной карте:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
            if(!$this->action || $this->action->with_card) {
                if($this->card->discount()) {
                    foreach($this->products as $product) {
                        if($product->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
                            if($product->entity()->specialSuccess(0)) {
                                $discount = round($product->priceFinal() / 100 * $this->card->discount());
                                $this->total += $discount;
                                $product->priceFinal($discount);
                            }
                        }
                    }

                }
            }
        }

        return $this->total;
    }

}
