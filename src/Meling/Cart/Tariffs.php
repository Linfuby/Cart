<?php
namespace Meling\Cart;

/**
 * Тарифы способа доставки
 * Class Tariffs
 * @package Meling\Cart
 */
class Tariffs
{
    /**
     * @var Deliveries\Delivery
     */
    protected $delivery;

    /**
     * @var Wrappers\Entity
     */
    protected $city;

    /**
     * @var \Meling\Cart
     */
    protected $cart;

    /**
     * @var Tariffs\Tariff[]
     */
    protected $tariffs;

    /**
     * Tariffs constructor.
     * @param \Meling\Cart                 $cart
     * @param Deliveries\Delivery          $delivery
     * @param \Meling\Cart\Wrappers\Entity $city
     */
    public function __construct(\Meling\Cart $cart, Deliveries\Delivery $delivery, $city)
    {
        $this->cart     = $cart;
        $this->delivery = $delivery;
        $this->city     = $city;
    }

    public function asArray()
    {
        $this->requireTariffs();

        return $this->tariffs;
    }

    public function get($id, $shopTariff = null)
    {
        if(!array_key_exists($id, $this->tariffs)) {
            $this->tariffs[$id] = $this->buildTariff($id, $shopTariff);
        }

        return $this->tariffs[$id];
    }

    protected function buildTariff($id, $shopTariff = null)
    {
        if($shopTariff === null) {
            $shopTariff = $this->cart->orm()->query('shopTariff')->in($id)->findOne();
        }

        return new Tariffs\Tariff($id, $shopTariff, $this->city);
    }

    private function requireTariffs()
    {
        if($this->tariffs !== null) {
            return;
        }
        $this->tariffs = array();
        foreach($this->delivery->point()->shopTariffs() as $shopTariff) {
            $this->tariffs[$shopTariff->id()] = $this->get($shopTariff->id(), $shopTariff);
        }
    }

}
