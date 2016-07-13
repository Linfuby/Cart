<?php
namespace Parishop\ORMWrappers\ActionType;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                name
 ***********************************************************************************************************************
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $actions
 * @method \Parishop\ORMWrappers\Action\Entity[] actions()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * @param \Parishop\ORMWrappers\Action\Entity $action
     * @param \Meling\Cart\Cards\Card             $card
     * @param \Meling\Cart\Products\Product[]     $products
     * @param bool                                $pointCheck
     * @return int
     */
    public function calculate($action, $card, $products, $pointCheck = false)
    {
        var_dump(1);
        $total      = 0;
        $productIds = array();
        foreach($products as $product) {
            if(!$pointCheck || ($pointCheck && $product->point())) {
                if($product instanceof \Meling\Cart\Products\Product\Option) {
                    if($product->option()->specialSuccess($action->price_flag)) {
                        $productIds[(string)$product->id()] = $product->id();
                    }
                }
            }
        }
        switch($this->id()) {
            case 53001:
            case 53003:
                sort($productIds);
                $allowActionsProducts = $this->builder->components()->orm()->query('allowactionproduct');
                $allowActionsProducts->where('actionId', $action->id());
                $allowActionsProducts->where('optionId', 'in', $productIds);
                $options = $allowActionsProducts->find()->asArray(false, 'optionId');
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $options)) {
                                $discount        = $options[(string)$product->id()]->discount;
                                $discountProduct = round($product->priceTotal() / 100 * $discount);
                                $product->priceFinal($discountProduct);
                                $total += $discountProduct;
                            }
                        }
                    }
                }
                break;
            case 53004:
            case 53006:
            case 53007:
                $discount = $action->discount;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $discountProduct = round($product->priceTotal() / 100 * $discount);
                                $product->priceFinal($discountProduct);
                                $total += $discountProduct;
                            }
                        }
                    }
                }
                break;
            case 53008:
                $amount = 0;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $amount += $product->priceTotal();
                            }
                        }
                    }
                }
                if($amount >= $action->count) {
                    $card->bonuses = $action->discount;
                }
                break;
            case 53009:
                $amount = 0;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $amount += $product->priceTotal();
                            }
                        }
                    }
                }
                if($amount > 0) {
                    $rewardsMax = round($amount / 100 * $action->discount);
                    $rewardsMin = round($card->rewards());
                    $rewards    = min($rewardsMin, $rewardsMax);
                    $discount   = (1 - ($amount - $rewards) / $amount) * 100;
                    foreach($products as $product) {
                        if(!$pointCheck || ($pointCheck && $product->point())) {
                            if($product instanceof \Meling\Cart\Products\Product\Option) {
                                if(array_key_exists($product->id(), $productIds)) {
                                    $discountProduct = round($product->priceTotal() / 100 * $discount);
                                    $product->priceFinal($discountProduct);
                                    $total += $discountProduct;
                                    $card->bonuses -= $discountProduct;
                                }
                            }
                        }
                    }
                }
                break;
            case 53010:
                $amount = 0;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $amount += $product->priceFinal();
                            }
                        }
                    }
                }
                $card->bonuses = round($amount / 100 * $action->discount);
                break;
            case 53011:
                $amount = 0;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $amount += $product->priceTotal();
                            }
                        }
                    }
                }
                if($amount >= $action->count) {
                    $discount = $action->discount;
                    foreach($products as $product) {
                        if(!$pointCheck || ($pointCheck && $product->point())) {
                            if($product instanceof \Meling\Cart\Products\Product\Option) {
                                if(array_key_exists($product->id(), $productIds)) {
                                    $discountProduct = round($product->priceTotal() / 100 * $discount);
                                    $product->priceFinal($discountProduct);
                                    $total += $discountProduct;
                                }
                            }
                        }
                    }
                }
                break;
            case 53014:
                $amount = 0;
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $productIds)) {
                                $amount += $product->priceTotal();
                            }
                        }
                    }
                }
                if($amount > 0) {
                    sort($productIds);
                    $rewardsMax           = round($amount / 100 * $action->discount);
                    $rewardsMin           = round($card->rewards());
                    $rewards              = min($rewardsMin, $rewardsMax);
                    $discount             = (1 - ($amount - $rewards) / $amount) * 100;
                    $allowActionsProducts = $this->builder->components()->orm()->query('allowactionproduct');
                    $allowActionsProducts->where('actionId', $action->id());
                    $allowActionsProducts->where('optionId', 'in', $productIds);
                    $options = $allowActionsProducts->find()->asArray(false, 'optionId');
                    foreach($products as $product) {
                        if(!$pointCheck || ($pointCheck && $product->point())) {
                            if($product instanceof \Meling\Cart\Products\Product\Option) {
                                if(array_key_exists($product->id(), $options)) {
                                    $discountProduct = round($product->priceTotal() / 100 * $discount);
                                    $product->priceFinal($discountProduct);
                                    $total += $discountProduct;
                                    $card->bonuses -= $discountProduct;
                                }
                            }
                        }
                    }
                }
                break;
            case 53017:
                sort($productIds);
                $allowActionsProducts = $this->builder->components()->orm()->query('allowactionproduct');
                $allowActionsProducts->where('actionId', $action->id());
                $allowActionsProducts->where('optionId', 'in', $productIds);
                $options = $allowActionsProducts->find()->asArray(false, 'optionId');
                /** @var \Meling\Cart\Products\Product\Option[] $vTAs */
                $vTAs = array();
                foreach($products as $product) {
                    if(!$pointCheck || ($pointCheck && $product->point())) {
                        if($product instanceof \Meling\Cart\Products\Product\Option) {
                            if(array_key_exists($product->id(), $options)) {
                                $vTAs[] = $product;
                            }
                        }
                    }
                }
                // Получаем общее количество товаров
                $vDCCount = 0;
                foreach($vTAs as $product) {
                    $vDCCount += $product->quantity();
                }
                // Проверяем хватает ли товаров для расчета
                $vLotSize = $action->count;
                if($vLotSize && $vLotSize < $vDCCount) {
                    // Тип Акции (Один|Каждый)
                    $vDummyInt = (int)$action->mode;
                    $vEach     = abs($vDummyInt) > 1;
                    // Сортировка товаров
                    $vDir  = $vDummyInt < 0 ? -1 : 1;
                    $vMode = $vDummyInt < 0 ? 'productsAsc' : 'productsDesc';
                    usort($vTAs, array(get_class($this), $vMode));
                    $vDummyInt = floor($vDCCount / $vLotSize);
                    $vCount    = $vEach ? $vDummyInt : 1;
                    $discount  = $action->discount;
                    $vDummyInt = $vDir > 0 ? $vLotSize : 1;
                    // Проверяем каждый товар
                    foreach($vTAs as $product) {
                        for($i = 0; $i < $product->quantity(); $i++) {
                            // Если нужно добавить скидку
                            if($vDummyInt == $vLotSize) {
                                $discountProduct = round($product->priceTotal() / 100 * $discount);
                                $product->priceFinal($discountProduct);
                                $total += $discountProduct;
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
                break;
        }

        return $total;
    }

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
}
