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
     * @var Cart\Providers\Provider
     */
    private $customer;

    /**
     * @param Cart\Providers\Provider $customer
     */
    public function __construct(Cart\Providers\Provider $customer)
    {
        $this->customer = $customer;
    }

    /**
     * @return Cart\Actions
     */
    public function actions()
    {
        return $this->instance('actions');
    }

    /**
     * @return Cart\Actions
     */
    public function actionsAfter()
    {
        return $this->instance('actionsAfter');
    }

    /**
     * @return Cart\Addresses
     */
    public function addresses()
    {
        return $this->instance('addresses');
    }

    /**
     * @return Cart\Cards
     */
    public function cards()
    {
        return $this->instance('cards');
    }

    public function customer()
    {
        return $this->customer;
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
        return $this->instance('products');
    }

    /**
     * @return Cart\Totals
     */
    public function totals()
    {
        return $this->instance('totals');
    }

    protected function buildActions()
    {
        return new Cart\Actions($this->customer->actions(), $this->customer->actionId());
    }

    protected function buildActionsAfter()
    {
        return new Cart\Actions($this->customer->actions(1));
    }

    protected function buildAddresses()
    {
        return new Cart\Addresses($this->customer->addresses(), $this->customer->address());
    }

    protected function buildCards()
    {
        return new Cart\Cards($this->customer->customerCards());
    }

    protected function buildOrders()
    {
        return new Cart\Orders($this->products()->asArray(), $this->points(), $this->actionsAfter(), $this->actions()->getDefault(), $this->cards()->get());
    }

    protected function buildPoints()
    {
        return new Cart\Points($this->products(), $this->customer()->city());
    }

    protected function buildProducts()
    {
        return new Cart\Products(array_merge($this->customer->options(), $this->customer->certificates()), $this);
    }

    protected function buildTotals()
    {
        return new Cart\Totals($this->products()->asArray(), $this->points(), $this->actionsAfter(), $this->actions()->getDefault(), $this->cards()->get());
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
