<?php
namespace Meling;

use Meling\Cart\Points;

/**
 * Class Cart
 * @package Meling
 */
class Cart
{
    /** @var array */
    protected $instances = array();

    /** @var Cart\Providers\Provider */
    protected $provider;

    /**
     * @param Cart\Providers\Provider $provider
     */
    public function __construct(Cart\Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return Cart\Actions
     */
    public function actions()
    {
        return $this->provider->actions();
    }

    /**
     * @return Cart\Actions
     */
    public function actionsAfter()
    {
        return $this->provider->actionsAfter();
    }

    /**
     * @return Cart\Addresses
     */
    public function addresses()
    {
        return $this->provider->addresses();
    }

    /**
     * @return Cart\Cards
     */
    public function cards()
    {
        return $this->provider->cards();
    }

    /**
     * @return Cart\Customer
     * @deprecated
     */
    public function customer()
    {
        return $this->instance('customer');
    }

    /**
     * @return Cart\Orders
     */
    public function orders()
    {
        return $this->instance('orders');
    }

    /**
     * @return Cart\Points
     * @deprecated
     */
    public function points()
    {
        return $this->instance('points');
    }

    /**
     * @return Cart\Products
     */
    public function products()
    {
        return $this->provider->products();
    }

    public function provider()
    {
        return $this->provider;
    }


    /**
     * @return Cart\Totals
     */
    public function totals()
    {
        return $this->products()->totals();
    }

    protected function buildCustomer()
    {
        $customer = $this->provider->customer();
        if($customer) {
            return new Cart\Customer($customer->id(), $customer->lastname, $customer->firstname, $customer->middlename, $customer->email, $customer->phone);
        }

        return new Cart\Customer();
    }

    protected function buildOrders()
    {
        return new Cart\Orders($this->provider, $this->products());
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
