<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Ассортимент
 * Class Type53001
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53001 extends Type
{
    public function name()
    {
        if($this->action) {
            return 'Ассортимент';
        }

        return null;
    }

    public function totalDiscount()
    {
        // Для каждого товара
        foreach($this->products->asArray() as $product) {
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
                // Проверка спец. цены
                // Только для товаров без спец. цены
                if($actionProduct->action()->getField('price_flag') == 0 && $product->option()->getField('special')) {
                    continue;
                }
                // Только для товаров со спец. ценой
                if($actionProduct->action()->getField('price_flag') == 2 && !$product->option()->getField('special')) {
                    continue;
                }
                // Скидка есть, значит считаем её минимальной для Акции
                $discountAction = $actionProduct->getField('discount');

                // Учитывается ли скидка по карте
                // Только для товаров без спец. цены
                if($actionProduct->action()->with_card && !$product->option()->getField('special')) {
                    // Скидка есть, значит считаем её минимальной для Карты
                    $discountCard = $this->card->discount();
                }
                // Получаем Максимальную скидку на товар
                $discount = $this->roundDiscount($discountAction, $discountCard);
                // Если скидка по текущей Акции больше чем по предыдущей
                if($discountProduct < $discount) {
                    $this->products->totals()->action()->add($product->priceTotal(), $discountAction);
                    $this->products->totals()->card()->add($product->priceTotal(), $discountCard);
                }
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
