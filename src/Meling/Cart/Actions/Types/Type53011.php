<?php
namespace Meling\Cart\Actions\Types;

/**
 * Скидка от суммы
 * Class Type53011
 * @package Meling\Cart\Actions\Types
 */
class Type53011 extends Extension implements Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
        if($this->totalDiscount === null) {
            // Для каждого товара
            foreach($this->builder->products()->asArray() as $product) {
                // Устанавливаем минимальную скидку для Товара
                $discountProduct = 0;
                // Устанавливаем минимальную скидку по Акции
                $discountProductAction = 0;
                // Устанавливаем минимальную скидку по Карте
                $discountProductCard = 0;
                // Для каждой акции
                foreach($this->actions as $action) {
                    if($this->totalAmount() >= $action->count) {
                        // Устанавливаем минимальную скидку по текущей Акции
                        $discountAction = 0;
                        // Устанавливаем минимальную скидку по Карте
                        $discountCard = 0;
                        // Скидка на Товар в Акции
                        if($action->discount) {
                            // Проверка спец. цены
                            if(!$action->accessSpecial($product->option())) {
                                continue;
                            }
                            // Скидка есть, значит считаем её минимальной для Акции
                            $discountAction = (int)$action->discount;
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
                }
                // Обновляем итоговые стоимости
                $this->updateTotal($product, $product->priceTotal(), $discountProductAction, $discountProductCard);
            }
        }

        return $this->totalDiscount;
    }

}