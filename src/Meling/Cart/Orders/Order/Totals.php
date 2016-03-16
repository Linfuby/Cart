<?php
namespace Meling\Cart\Orders\Order;

/**
 * Class Totals
 * @method Totals\ExtendedTotal get($id)
 * @method Totals\ExtendedTotal[] asArray()
 * @package Meling\Cart
 */
class Totals
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var array
     */
    protected $instances = array();

    /**
     * Products constructor.
     * @param Products $products
     */
    public function __construct(Products $products)
    {
        $this->products = $products;
    }

    /**
     * @return Totals\Action
     * @throws \Exception
     */
    public function action()
    {
        return $this->instance('action');
    }

    /**
     * @return Totals\Amount
     * @throws \Exception
     */
    public function amount()
    {
        return $this->instance('amount');
    }

    /**
     * @return Totals\Bonuses
     * @throws \Exception
     */
    public function bonuses()
    {
        return $this->instance('bonuses');
    }

    /**
     * @return Totals\Card
     * @throws \Exception
     */
    public function card()
    {
        return $this->instance('card');
    }

    /**
     * @return Products
     */
    public function products()
    {
        return $this->products;
    }

    /**
     * @return Totals\Shipping
     * @throws \Exception
     */
    public function shipping()
    {
        return $this->instance('shipping');
    }

    /**
     * @return Totals\Total
     * @throws \Exception
     */
    public function total()
    {
        return $this->instance('total');
    }

    protected function buildAction()
    {
        return new Totals\Action($this);
    }

    protected function buildAmount()
    {
        return new Totals\Amount($this);
    }

    protected function buildBonuses()
    {
        return new Totals\Bonuses($this);
    }

    protected function buildCard()
    {
        return new Totals\Card($this);
    }

    protected function buildShipping()
    {
        return new Totals\Shipping($this);
    }

    protected function buildTotal()
    {
        return new Totals\Total($this);
    }

    protected function instance($name)
    {
        if(!array_key_exists($name, $this->instances)) {
            $method                 = 'build' . ucfirst($name);
            $this->instances[$name] = $this->$method();
        }

        return $this->instances[$name];
    }

}
