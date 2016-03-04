<?php
namespace Meling\Cart\Actions\Types;

/**
 * Товар-бонус (%)
 * Class Type53010
 * @package Meling\Cart\Actions\Types
 */
class Type53010 extends Extension implements Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
        if($this->totalDiscount === null) {
            // Для каждого товара
            foreach($this->builder->products()->asArray() as $product) {
                // Устанавливаем минимальную скидку по Акции
                $discountProductAction = 0;
                // Для каждой акции
                foreach($this->actions as $action) {
                    $discountProductAction += $action->discount;
                }
                $this->updateTotal($product, $product->priceTotal(), 0, 0, round(
                    $product->priceFinal() / 100 * $discountProductAction, 0, PHP_ROUND_HALF_DOWN
                ));
            }
        }

        return $this->totalDiscount;
    }

}