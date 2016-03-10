<?php
namespace Meling\Cart\Actions\Types;

/**
 * Ассортимент
 * Class Type53001
 * @package Meling\Cart\Actions\Types
 */
class Type53001 extends Type
{
    public function name()
    {
        return 'Ассортимент';
    }

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
            $discountAction = 0;
            // Устанавливаем минимальную скидку по Карте
            $discountCard = 0;
            // Для каждой акции
            foreach($product->actionProducts() as $actionProduct) {
                // Устанавливаем минимальную скидку по текущей Акции
                $discountAction = 0;
                // Устанавливаем минимальную скидку по Карте
                $discountCard = 0;
                // Скидка на Товар в Акции
                if($discount = $actionProduct->discount) {
                    // Проверка спец. цены
                    if(!$actionProduct->action()->accessSpecial($product->option()->special)) {
                        continue;
                    }
                    // Скидка есть, значит считаем её минимальной для Акции
                    $discountAction = $discount;
                    // Учитывается ли скидка по карте
                    // Только для товаров без спец. цены
                    if($actionProduct->action()->with_card && !$product->option()->special) {
                        // Скидка есть, значит считаем её минимальной для Карты
                        $discountCard = $this->card->discount();
                    }
                }
                // Получаем Максимальную скидку на товар
                $discount = $this->roundDiscount($discountAction, $discountCard);
                // Если скидка по текущей Акции больше чем по предыдущей
                if($discountProduct < $discount) {
                    $this->totals->action()->add($product->priceTotal(), $discountAction);
                    $this->totals->card()->add($product->priceTotal(), $discountCard);
                    $this->totals->total()->add($product->priceTotal(), $discount);
                }
            }
            // Если нет скидки на товар по акциям
            if(!$discountAction && !$discountCard) {
                // Если есть возможность применить скидку по Карте
                if(!$product->option()->special) {
                    // Обновляем минимальную скидку на товар по Карте
                    $discountCard = $this->card->discount();
                    $this->totals->card()->add($product->priceTotal(), $discountCard);
                }
            }
            $product->updatePriceFinal($discountAction, $discountCard);
        }
    }

}
