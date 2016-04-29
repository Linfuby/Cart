<?php
namespace Meling\Cart\Orders\Order\Totals;

class Card implements Totals
{
    private $total;

    public function add($priceTotal, $discountAction)
    {
        $this->total += round($priceTotal / 100 * $discountAction);
    }

    public function name()
    {
        return 'Скидка по Клубной карте:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
        }

        return $this->total;
    }

}
