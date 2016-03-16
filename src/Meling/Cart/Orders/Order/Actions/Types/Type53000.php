<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Информационная акция
 * Class Type53000
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
class Type53000 extends Type
{
    public function name()
    {
        if($this->action) {
            return $this->action->getField('name');
        }

        return null;
    }

    public function totalDiscount()
    {

    }

}
