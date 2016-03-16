<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Лоты/New
 * Class Type53017
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53017 extends Type
{
    /**
     * @param \Meling\Cart\Orders\Order\Products\Product $a
     * @param \Meling\Cart\Orders\Order\Products\Product $b
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
     * @param \Meling\Cart\Orders\Order\Products\Product $a
     * @param \Meling\Cart\Orders\Order\Products\Product $b
     * @return int
     */
    public function productsDesc($a, $b)
    {
        if($a->price() == $b->price()) {
            return 0;
        }

        return ($a->price() > $b->price()) ? -1 : 1;
    }

    public function totalDiscount()
    {
        /**
         * @var \Meling\Cart\Orders\Order\Products\Product[] $vTAs
         */
        $vTAs = array();
        foreach($this->products->asArray() as $product) {
            // Скидка на Товар в Акции
            if($this->action->actionProducts()->asArray()) {
                if($actionProduct = $product->actionDiscount($this->action->id())) {
                    // Проверка спец. цены
                    if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                        continue;
                    }
                    $vTAs[] = $product;
                }
            } else {
                $vTAs[] = $product;
            }
        }
        // Получаем общее количество товаров
        $vDCCount = 0;
        foreach($vTAs as $product) {
            $vDCCount += $product->quantity();
        }
        // Проверяем хватает ли товаров для расчета
        $vLotSize = $this->action->getRequiredField('count');
        if($vLotSize && $vLotSize < $vDCCount) {

            // Тип Акции (Один|Каждый)
            $vDummyInt = (int)$this->action->getField('mode');
            $vEach     = abs($vDummyInt) > 1;
            // Сортировка товаров
            $vDir  = $vDummyInt < 0 ? -1 : 1;
            $vMode = $vDummyInt < 0 ? 'productsAsc' : 'productsDesc';
            usort($vTAs, array(get_class($this), $vMode));
            $vDummyInt      = floor($vDCCount / $vLotSize);
            $vCount         = $vEach ? $vDummyInt : 1;
            $discountAction = $this->action->getField('discount');
            $vDummyInt      = $vDir > 0 ? $vLotSize : 1;
            // Проверяем каждый товар
            foreach($vTAs as $product) {
                for($i = 0; $i < $product->quantity(); $i++) {
                    // Если нужно добавить скидку
                    if($vDummyInt == $vLotSize) {
                        $this->products->totals()->action()->add($product->price(), $discountAction);
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

}
