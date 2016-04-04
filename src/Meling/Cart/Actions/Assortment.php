<?php
namespace Meling\Cart\Actions;

class Assortment extends Action
{
    public function calculate()
    {
        foreach($this->actions->products()->asArray() as $product) {
            if($product->actionProducts($this->actions->asArray())) {

            }
        }
    }

}
