<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Товар-бонус (%)
 * Class Type53010
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53010 extends Type
{
    public function totalDiscount()
    {
        // Для каждого товара
        foreach($this->products->asArray() as $product) {
            // Устанавливаем минимальную скидку для Товара
            $discountProduct = 0;
            // Устанавливаем минимальную скидку по Карте
            $discountCard = 0;
            // Скидка на Товар в Акции
            if($discountAction = $this->action->getField('discount')) {
                // Проверка спец. цены
                if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                    continue;
                }
            }
            // Получаем Максимальную скидку на товар
            $discount = $this->roundDiscount($discountAction, $discountCard);
            // Если скидка по текущей Акции больше чем по предыдущей
            if($discountProduct < $discount) {
                $this->products->totals()->bonuses()->add($product->priceTotal(), $discountAction);
            }
        }
    }

}
