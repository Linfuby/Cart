<?php
namespace Meling;

/**
 * Class Cart
 * @package Meling
 */
class Cart
{
    /**
     * @var array
     */
    protected $instances = array();

    /**
     * @var Cart\Customer
     */
    private $customer;

    /**
     * @var Cart\Provider
     */
    private $provider;

    /**
     * @param Cart\Customer $customer
     * @param Cart\Provider $provider
     */
    public function __construct(Cart\Customer $customer, Cart\Provider $provider)
    {
        $this->customer = $customer;
        $this->provider = $provider;
    }

    public function orders()
    {
        return $this->instance('orders');
    }

    protected function buildOrders()
    {
        return new Cart\Orders($this->customer, $this->provider);
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
