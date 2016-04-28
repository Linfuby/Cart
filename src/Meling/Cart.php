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
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var Cart\Providers\Provider
     */
    private $provider;

    /**
     * @param \PHPixie\ORM            $orm
     * @param Cart\Providers\Provider $provider
     */
    public function __construct(\PHPixie\ORM $orm, Cart\Providers\Provider $provider)
    {
        $this->orm      = $orm;
        $this->provider = $provider;
    }

    public function deliveries()
    {
        return $this->instance('deliveries');
    }

    public function orders()
    {
        return $this->instance('orders');
    }

    public function orm()
    {
        return $this->orm;
    }

    public function points()
    {
        return $this->instance('points');
    }

    public function shops()
    {
        return $this->instance('shops');
    }

    public function tariffs()
    {
        return $this->instance('tariffs');
    }

    protected function buildTariffs()
    {
        return new Cart\Tariffs();
    }
    protected function buildDeliveries()
    {
        return new Cart\Deliveries();
    }

    protected function buildOrders()
    {
        //return new Cart\Orders($this->provider->customer(), $this->provider);
    }

    protected function buildPoints()
    {
        return new Cart\Points($this->orm);
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
