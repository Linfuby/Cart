<?php
namespace Meling\Tests\ORMWrappers\Entities\ActionType;

class Type53001 extends Type
{
    public function total()
    {
        $total = 0;
        foreach($this->products as $product) {
        }

        return $total;
    }

}