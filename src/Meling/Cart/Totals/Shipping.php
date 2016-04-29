<?php
namespace Meling\Cart\Orders\Order\Totals;

class Shipping implements Totals
{
    /**
     * @var \Meling\Cart\Orders\Order\Points\Point
     */
    protected $point;

    private   $amount;

    /**
     * @var \Meling\Cart\Orders
     */
    private $orders;

    private $total;

    /**
     * Shipping constructor.
     * @param \Meling\Cart\Orders\Order\Points\Point $point
     * @param \Meling\Cart\Orders                    $orders
     */
    public function __construct($point = null, $orders = null)
    {
        $this->point  = $point;
        $this->orders = $orders;
    }

    public function name()
    {
        return 'Доставка:';
    }

    public function set($total)
    {
        $this->total = $total;
    }

    /**
     * @param mixed $amount
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    }

    public function total()
    {
        if($this->total === null) {
            if($this->amount !== null && $this->amount >= 10000) {
                return 0;
            } elseif($this->orders) {
                $this->total = 0;
                foreach($this->orders->asArray() as $order) {
                    $this->total += $order->totals()->shipping()->total();
                }
            } else {
                $this->total = $this->point->get()->cost();
            }
        }

        return $this->total;
    }

}
