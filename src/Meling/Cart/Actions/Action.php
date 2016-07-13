<?php
namespace Meling\Cart\Actions;

/**
 * Class Action
 * @package Meling\Cart\Cards
 */
class Action implements Implementation
{
    /**
     * @var \Parishop\ORMWrappers\Action\Entity
     */
    protected $action;

    /**
     * Action constructor.
     * @param \Parishop\ORMWrappers\Action\Entity $action
     */
    public function __construct($action = null)
    {
        $this->action = $action;
    }

    /**
     * @param                       $card
     * @param \Meling\Cart\Products $products
     * @param bool                  $pointCheck
     * @return int
     */
    public function calculate($card, $products, $pointCheck = false)
    {
        if($this->action) {
            return $this->action->actionType()->calculate($this->action, $card, $products->asArray(), $pointCheck);
        } else {
            $total = 0;
            foreach($products->asArray() as $product) {
                if($product instanceof \Meling\Cart\Products\Product\Option) {
                    if($action = $product->action()) {
                        $total += $action->actionType()->calculate($action, $card, array($product), $pointCheck);
                    }
                }
            }

            return $total;
        }
    }

    public function id()
    {
        return $this->action ? $this->action->id() : null;
    }

    public function name()
    {
        return $this->action ? $this->action->getField('name') : null;
    }

    public function useCard()
    {
        return (bool)($this->action ? $this->action->getField('with_card', true) : true);
    }

    public function useSpecial()
    {
        return (bool)($this->action ? $this->action->getField('price_flag', false) : false);
    }

}
