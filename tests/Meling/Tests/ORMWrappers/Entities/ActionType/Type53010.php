<?php
namespace Meling\Tests\ORMWrappers\Entities\ActionType;

class Type53010 extends Type
{
    public function total()
    {
        $total    = 0;
        $discount = $this->action->getRequiredField('discount');
        foreach($this->products as $product) {
            if($product->entity()->priceFlag((int)$this->action->getRequiredField('price_flag'))) {
                $total += round($product->priceFinal() / 100 * $discount);
            }
        }

        return $total;
    }

}