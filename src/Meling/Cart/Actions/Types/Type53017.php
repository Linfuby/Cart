<?php
namespace Meling\Cart\Actions\Types;

/**
 * Лоты/New
 * Class Type53017
 * @package Meling\Cart\Actions\Types
 */
class Type53017 extends Extension implements Type
{
    /**
     * @param \Meling\Cart\Products\Product $a
     * @param \Meling\Cart\Products\Product $b
     * @return int
     */
    public function productsAsc($a, $b)
    {
        if($a->price() == $b->price()) {
            return 0;
        }

        return ($a->price() < $b->price()) ? -1 : 1;
    }

    /**
     * @param \Meling\Cart\Products\Product $a
     * @param \Meling\Cart\Products\Product $b
     * @return int
     */
    public function productsDesc($a, $b)
    {
        if($a->price() == $b->price()) {
            return 0;
        }

        return ($a->price() > $b->price()) ? -1 : 1;
    }

    /**
     * @return int
     */
    public function totalDiscount()
    {
        if($this->totalDiscount === null) {
            // Для каждой акции
            foreach($this->actions as $action) {
                // Получаем товары которые могут участвовать в акции
                $vTAs = $this->builder->products()->asAction($action);
                // Если Акция имеет фильтр по товарам
                if($action->products()->asArray()) {
                    $products = array();
                    foreach($vTAs as $product) {
                        if($action->productDiscount($product->option()->id())) {
                            $products[$product->id()] = $product;
                        }
                    }
                    // Иначе все товары корзины
                } else {
                    $products = $vTAs;
                }
                // Получаем общее количество товаров
                $vDCCount = 0;
                foreach($products as $product) {
                    $vDCCount += $product->quantity();
                }
                // Проверяем хватает ли товаров для расчета
                $vLotSize = $action->count;
                if($vLotSize > $vDCCount) {
                    continue;
                }
                // Тип Акции (Один|Каждый)
                $vDummyInt = (int)$action->mode;
                $vEach     = abs($vDummyInt) > 1;
                // Сортировка товаров
                $vDir  = $vDummyInt < 0 ? -1 : 1;
                $vMode = $vDummyInt < 0 ? 'productsAsc' : 'productsDesc';
                usort($products, array(get_class(), $vMode));
                $vDummyInt             = floor($vDCCount / $vLotSize);
                $vCount                = $vEach ? $vDummyInt : 1;
                $discountProductAction = $action->discount;
                $vDummyInt             = $vDir > 0 ? $vLotSize : 1;
                // Проверяем каждый товар
                foreach($products as $product) {
                    for($i = 0; $i < $product->quantity(); $i++) {
                        // Если нужно добавить скидку
                        if($vDummyInt == $vLotSize) {
                            $this->updateTotal($product, $product->price(), $discountProductAction);
                            // Иначе просто обновляем стоимость
                        } else {
                            $this->updateTotal($product, $product->price());
                        }
                        // Если количество уже набрано, делаем заплатку, чтобы обновились итоговые стоимости товаров
                        if(count($vTAs) == $vCount) {
                            $vDummyInt = 'breakDiscount';
                            continue;
                        }
                        if($vDir > 0) {
                            $vDummyInt--;
                        }
                        if($vDir < 0) {
                            $vDummyInt++;
                        }
                        if($vDir > 0) {
                            if($vDummyInt == 0) {
                                $vDummyInt = $vLotSize;
                            }
                        }
                        if($vDir < 0) {
                            if($vDummyInt > $vLotSize) {
                                $vDummyInt = 1;
                            }
                        }
                    }
                }
            }
        }

        return $this->totalDiscount;
    }
}