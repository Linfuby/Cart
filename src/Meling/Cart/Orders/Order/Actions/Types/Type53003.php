<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Подарки
 * Class Type53003
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53003 extends Type
{
    public function totalDiscount()
    {
        // Для каждого товара
        foreach($this->products->asArray() as $product) {
            // Устанавливаем минимальную скидку для Товара
            $discountProduct = 0;
            // Устанавливаем минимальную скидку по текущей Акции
            $discountAction = 0;
            // Устанавливаем минимальную скидку по Карте
            $discountCard = 0;
            // Скидка на Товар в Акции
            if($actionProduct = $product->actionDiscount($this->action->id())) {
                // Проверка спец. цены
                if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                    continue;
                }
                // Скидка есть, значит считаем её минимальной для Акции
                $discountAction = $actionProduct->getField('discount') / $product->priceTotal() * 100;
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
            // Если нет скидки на товар по акциям
            if(!$discountAction && !$discountCard) {
                // Если есть возможность применить скидку по Карте
                if(!$product->option()->getField('special')) {
                    // Обновляем минимальную скидку на товар по Карте
                    $discountCard = $this->card->discount();
                    $this->products->totals()->card()->add($product->priceTotal(), $discountCard);
                }
            }
        }
    }

}
