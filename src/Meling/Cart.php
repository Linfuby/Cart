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
    private $provider;

    /**
     * @param Cart\Providers\Provider $provider
     */
    public function __construct(Cart\Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return Cart\Products
     */
    public function products()
    {
        return $this->instance('products');
    }

    public function provider()
    {
        return $this->provider;
    }

    protected function buildProducts()
    {
        return new Cart\Products(array_merge($this->provider()->options(), $this->provider()->certificates()));
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
