<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Бонус-товар
 * Class Type53009
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53009 extends Type
{
    public function totalDiscount()
    {
        // Итоговая стоимость товаров по Акции
        $totalAmount = 0;
        // Для каждого товара
        foreach($this->products->asArray() as $product) {
            // Проверка спец. цены
            if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                continue;
            }
            // Добавляем общую стоимость Товара
            $totalAmount += $product->priceTotal();
        }
        if($totalAmount > 0) {
            // Устанавливаем максимальную скидку по Акции
            $maxTotalAction = $totalAmount / 100 * $this->action->getField('discount');
            $minTotalAction = $totalProducts = min($maxTotalAction, $this->card->rewards());
            $discountAction = (1 - ($totalAmount - $minTotalAction) / $totalAmount);
            if($discountAction < 0) {
                $discountAction = 0;
            }
        } else {
            $minTotalAction = 0;
            $discountAction = 0;
        }
        $minTotalAction -= $discountAction;
        // Если остался остаток бонусов
        if($minTotalAction > 0) {
            foreach($this->products->asArray() as $product) {
                // Проверка спец. цены
                if(!$this->accessSpecial($product->option()->getField('special', 0))) {
                    continue;
                }
                $discountAction += $minTotalAction;
                $this->products->totals()->action()->add($product->priceTotal(), $discountAction, false);
            }
        }
    }

}
