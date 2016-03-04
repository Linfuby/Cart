<?php
namespace Meling\Cart\Actions\Types;

/**
 * Товар-бонус
 * Class Type53008
 * @package Meling\Cart\Actions\Types
 */
class Type53008 extends Extension implements Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
        if($this->totalDiscount === null) {
            $this->totalDiscount = 0;
            $totalAmount         = $this->totalAmount();
            // Для каждого товара
            foreach($this->actions as $action) {
                foreach($this->builder->products()->asArray() as $key => $product) {
                    $this->updateTotal($product, $product->priceTotal());
                }
                $this->updateBonuses($action->discount);
            }
        }

        return $this->totalDiscount;
    }

}