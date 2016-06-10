<?php
namespace Meling\Cart\Totals;

class Card
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

    private   $total;

    /**
     * Card constructor.
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
            if(!$this->action || $this->action->useCard()) {
                if($this->card->discount()) {
                    foreach($this->products as $product) {
                        if($product instanceof \Meling\Cart\Products\Option) {
                            if($product->option()->specialSuccess(0)) {
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
