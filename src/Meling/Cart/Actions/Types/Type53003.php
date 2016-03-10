<?php
namespace Meling\Cart\Actions\Types;

/**
 * Подарки
 * Class Type53003
 * @package Meling\Cart\Actions\Types
 */
class Type53003 extends Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
        // Для каждого товара
        foreach($this->totals->products()->asArray() as $product) {
            // Устанавливаем минимальную скидку для Товара
            $discountProduct = 0;
            // Устанавливаем минимальную скидку по Акции
            $discountProductAction = 0;
            // Устанавливаем минимальную скидку по Карте
            $discountProductCard = 0;
            // Для каждой акции
            foreach($this->actions as $action) {
                // Устанавливаем минимальную скидку по текущей Акции
                $discountAction = 0;
                // Устанавливаем минимальную скидку по Карте
                $discountCard = 0;
                // Скидка на Товар в Акции
                if($discount = $product->option()->productDiscount($action->id())) {
                    // Проверка спец. цены
                    if(!$action->accessSpecial($product->option())) {
                        continue;
                    }
                    // Скидка есть, значит считаем её минимальной для Акции
                    $discountAction = $discount / $product->priceTotal() * 100;
                    // Учитывается ли скидка по карте
                    // Только для товаров без спец. цены
                    if($action->with_card && !$product->option()->special()) {
                        // Скидка есть, значит считаем её минимальной для Карты
                        $discountCard = $this->builder->cards()->get()->discount();
                    }
                }
                // Получаем Максимальную скидку на товар
                $discount = $discountAction + $discountCard;
                // Скидка должна быть в диапазоне от 0% до 100%
                $discount = $discount < 0 ? 0 : $discount;
                $discount = $discount > 100 ? 100 : $discount;
                // Если скидка по текущей Акции больше чем по предыдущей
                if($discountProduct < $discount) {
                    // Обновляем минимальную скидку на товар по Акции
                    $discountProductAction = $discountAction;
                    // Обновляем минимальную скидку на товар по Карте
                    $discountProductCard = $discountCard;
                    // Обновляем минимальную скидку на товар
                    $discountProduct = $discount;
                }
            }
            // Если нет скидки на товар по акциям
            // Если есть возможность применить скидку по Карте
            if(!$discountProductAction && $product->cardDiscount()) {
                // Обновляем минимальную скидку на товар по Карте
                $discountProductCard = $this->builder->cards()->get()->discount();
            }
            // Обновляем итоговые стоимости
            $this->updateTotal($product, $product->priceTotal(), $discountProductAction, $discountProductCard);
        }
    }

}
