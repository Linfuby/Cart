<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Скидка от суммы
 * Class Type53011
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53011 extends Type53004
{
    public function totalDiscount()
    {
        if($this->action->getField('count') >= $this->products->totals()->amount()->total()) {
            parent::totalDiscount();
        }
    }

}
