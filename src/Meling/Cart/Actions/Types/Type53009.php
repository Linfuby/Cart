<?php
namespace Meling\Cart\Actions\Types;

/**
 * Бонус-товар
 * Class Type53009
 * @package Meling\Cart\Actions\Types
 */
class Type53009 extends Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
            $this->totalDiscount = 0;
            // Для каждой акции
            foreach($this->actions as $action) {
                // Итоговая стоимость товаров по Акции
                $totalAmount = 0;
                // Для каждого товара
                foreach($this->builder->products()->asArray() as $product) {
                    // Только для товаров без спец. цены
                    if($action->price_flag == 0 && $product->option()->special()) {
                        continue;
                    }
                    // Только для товаров со спец. ценой
                    if($action->price_flag == 2 && !$product->option()->special()) {
                        continue;
                    }
                    // Добавляем общую стоимость Товара
                    $totalAmount += $product->priceTotal();
                }
                if($totalAmount > 0) {
                    // Устанавливаем максимальную скидку по Акции
                    $maxTotalAction = $totalAmount / 100 * $action->discount;
                    $minTotalAction = $totalProducts = min($maxTotalAction, $this->builder->cards()->get()->rewards());
                    $discountAction = (1 - ($totalAmount - $minTotalAction) / $totalAmount);
                    if($discountAction < 0) {
                        $discountAction = 0;
                    }
                } else {
                    $minTotalAction = 0;
                    $discountAction = 0;
                }
                foreach($this->builder->products()->asArray() as $product) {
                    $discount = $discountAction * 100;
                    // Проверка спец. цены
                    if(!$action->accessSpecial($product->option())) {
                        $this->updateTotal($product, $product->priceTotal());
                        continue;
                    }
                    $this->updateTotal($product, $product->priceTotal(), $discount);
                }
                $minTotalAction -= $this->totalAction;
                // Если остался остаток бонусов
                if($minTotalAction > 0) {
                    foreach($this->builder->products()->asArray() as $product) {
                        // Только для товаров без спец. цены
                        if($action->price_flag == 0 && $product->option()->special()) {
                            continue;
                        }
                        // Только для товаров со спец. ценой
                        if($action->price_flag == 2 && !$product->option()->special()) {
                            continue;
                        }
                        $this->totalAction += $minTotalAction;
                        $product->priceFinal($product->priceFinal() + $minTotalAction);
                        break;
                    }
                }
                break;
            }
    }

}
