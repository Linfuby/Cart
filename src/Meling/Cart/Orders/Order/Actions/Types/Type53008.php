<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Товар-бонус
 * Class Type53008
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53008 extends Type
{
    public function totalDiscount()
    {
        // Для каждого товара
        foreach($this->products->asArray() as $product) {
            // Устанавливаем минимальную скидку для Товара
            $discountProduct = 0;
            // Устанавливаем минимальную скидку по текущей Акции
            $discountAction = 0;
            // Скидка на Товар в Акции
            if($actionProduct = $product->actionDiscount($this->action->id())) {
                // Проверка спец. цены
                if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                    continue;
                }
                // Скидка есть, значит считаем её минимальной для Акции
                $discountAction = $actionProduct->getField('discount') / $product->priceTotal() * 100;
            }
            // Получаем Максимальную скидку на товар
            $discount = $this->roundDiscount($discountAction);
            // Если скидка по текущей Акции больше чем по предыдущей
            if($discountProduct < $discount) {
                $this->products->totals()->bonuses()->add($product->priceTotal(), $discountAction, false);
            }
        }
    }

}
