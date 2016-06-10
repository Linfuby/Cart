<?php
namespace Meling;

use Meling\Cart\Points;

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
    protected $provider;

    /**
     * @var Cart\Providers\Products
     */
    protected $options;

    /**
     * @var Cart\Providers\Products
     */
    protected $certificates;

    /**
     * @param Cart\Providers\Provider $provider
     * @param Cart\Providers\Products $options
     * @param Cart\Providers\Products $certificates
     */
    public function __construct(Cart\Providers\Provider $provider, Cart\Providers\Products $options, Cart\Providers\Products $certificates)
    {
        $this->provider     = $provider;
        $this->options      = $options;
        $this->certificates = $certificates;
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
     * @return Cart\Providers\Order
     */
    public function providerOrder()
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
        return new Cart\Orders($this->provider, $this->buildProducts(), $this->buildPoints(), $this->options, $this->certificates);
    }

    protected function buildPoints()
    {
        $addressId = null;
        if($addresses = $this->addresses()->asArray()) {
            $address = current($addresses);
            if($address) {
                $addressId = $address->id();
            }
        }

        return new Cart\Points($this, $this->provider->city(), $this->addresses(), $addressId);
    }

    protected function buildProducts()
    {
        $products = array();
        foreach($this->options->asArray() as $option) {
            $products[(string)$option->optionId] = $this->provider->buildOption($option, $this->points());
        }

        foreach($this->certificates->asArray() as $certificate) {
            $products[(string)$certificate->certificateId] = $this->provider->buildCertificate($certificate, $this->points());
        }

        return new Cart\Products($this->provider, $this->points(), $this->options, $this->certificates, $products);
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
