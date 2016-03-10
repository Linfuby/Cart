<?php
namespace Meling\Cart\Actions\Types;

/**
 * Бонус-товар (ассортимент)
 * Class Type53014
 * @package Meling\Cart\Actions\Types
 */
class Type53014 extends Type
{
    /**
     * @return int
     */
    public function totalDiscount()
    {
        if($this->totalDiscount === null) {
            $this->totalDiscount = 0;
            $rewards             = $this->builder->cards()->get()->rewards();
            $rewardsUse          = 0;
            // Для каждой акции
            foreach($this->actions as $action) {
                foreach($this->builder->products()->asArray() as $product) {
                    if($rewards <= 0 || !$action->accessSpecial($product->option())) {
                        // Добавляем размер скидки по Акции
                        $this->totalAction += 0;
                        // Добавляем размер скидки по Карте
                        $this->totalCard += 0;
                        // Добавляем размер скидки на Товары
                        $this->totalDiscount += $product->priceTotal();
                        // Добавляем Накопленные баллы
                        $this->totalBonuses += 0;
                    }
                    // Устанавливаем максимальную скидку по Акции
                    $discount = $action->productDiscount($product->option()->id());
                    if($discount) {
                        $priceAction  = round($product->priceTotal() / $discount);
                        $priceAction  = $totalProducts = min($rewards, $priceAction);
                        $priceProduct = $product->priceTotal() - $priceAction;
                        if($priceProduct < 0) {
                            continue;
                        }
                        // Добавляем размер скидки по Акции
                        $this->totalAction += $priceAction;
                        // Добавляем размер скидки на Товары
                        $this->totalDiscount += $priceProduct;
                        // Обновляем финальную стоимость Товара
                        $product->priceFinal($priceProduct);
                        $rewardsUse += $priceAction;
                        $rewards -= $priceAction;
                    } else {
                        // Добавляем размер скидки по Акции
                        $this->totalAction += 0;
                        // Добавляем размер скидки по Карте
                        $this->totalCard += 0;
                        // Добавляем размер скидки на Товары
                        $this->totalDiscount += $product->priceTotal();
                        // Добавляем Накопленные баллы
                        $this->totalBonuses += 0;
                    }
                }
                break;
            }
        }

        return $this->totalDiscount;
    }

}
