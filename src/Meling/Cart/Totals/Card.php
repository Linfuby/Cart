<?php
namespace Meling\Cart\Totals;

class Card extends ExtendedTotal
{
    public function name()
    {
        return 'Скидка по Клубной карте:';
    }
    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}