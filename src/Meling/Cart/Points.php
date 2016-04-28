<?php
namespace Meling\Cart;

class Points
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    protected $points = array();

    /**
     * Points constructor.
     * @param \Meling\Cart $cart
     */
    public function __construct(\Meling\Cart $cart)
    {
        $this->cart = $cart;
    }

    /**
     * @param $id
     * @return Points\Point
     */
    public function get($id)
    {
        if(!array_key_exists($id, $this->points)) {
            $shop              = $this->cart->orm()->query('shop')->in($id)->findOne();
            $this->points[$id] = $this->buildPoint($id, $shop);
        }

        return $this->points[$id];
    }

    /**
     * @param mixed                                                   $id
     * @param \PHPixie\ORM\Models\Type\Database\Implementation\Entity $shop
     * @return Points\Point
     */
    protected function buildPoint($id, $shop)
    {
        return new Points\Point($id, $shop, $this->cart->deliveries());
    }

}
