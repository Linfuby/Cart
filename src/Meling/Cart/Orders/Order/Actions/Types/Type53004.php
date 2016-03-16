<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Скидка
 * Class Type53004
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53004 extends Type
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
                // Учитывается ли скидка по карте
                // Только для товаров без спец. цены
                if($this->action->getField('with_card', 0) && !$product->option()->getField('special')) {
                    // Скидка есть, значит считаем её минимальной для Карты
                    $discountCard = $this->card->discount();
                }
            }
            // Получаем Максимальную скидку на товар
            $discount = $this->roundDiscount($discountAction, $discountCard);
            // Если скидка по текущей Акции больше чем по предыдущей
            if($discountProduct < $discount) {
                $this->products->totals()->action()->add($product->priceTotal(), $discountAction);
                $this->products->totals()->card()->add($product->priceTotal(), $discountCard);
            }
        }
    }

}
