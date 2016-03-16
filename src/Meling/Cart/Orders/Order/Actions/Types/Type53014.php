<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Бонус-товар (ассортимент)
 * Class Type53014
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53014 extends Type
{
    public function totalDiscount()
    {
        $rewards    = $this->card->rewards();
        $rewardsUse = 0;
        foreach($this->products->asArray() as $product) {
            // Проверка спец. цены
            if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                continue;
            }
            // Устанавливаем максимальную скидку по Акции
            if($actionProduct = $product->actionDiscount($this->action->id())) {
                $discountAction = round($product->priceTotal() / $actionProduct->getField('discount'));
                $discountAction = $totalProducts = min($rewards, $discountAction);
                $priceProduct   = $product->priceTotal() - $discountAction;
                if($priceProduct < 0) {
                    continue;
                }
                $this->products->totals()->action()->add($product->priceTotal(), $discountAction, false);
                $rewardsUse += $discountAction;
                $rewards -= $discountAction;
            }
        }
    }

}
