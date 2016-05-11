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
    protected $provider;

    /**
     * @var Cart\Providers\Options
     */
    protected $options;

    /**
     * @var Cart\Providers\Certificates
     */
    protected $certificates;

    /**
     * @param Cart\Providers\Provider     $provider
     * @param Cart\Providers\Options      $options
     * @param Cart\Providers\Certificates $certificates
     */
    public function __construct(Cart\Providers\Provider $provider, Cart\Providers\Options $options, Cart\Providers\Certificates $certificates)
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
     * @return Cart\Orders
     */
    public function orders()
    {
        return $this->instance('orders');
    }

    /**
     * @return Cart\Products
     */
    public function products()
    {
        return $this->instance('products');
    }

    protected function buildCertificate($id, $certificate, $price, $quantity = 1, $point = null)
    {
        return new \Meling\Cart\Products\Certificate($id, $certificate, $price, $quantity, $point);
    }

    protected function buildOption($id, $option, $price, $quantity = 1, $point = null)
    {
        return new \Meling\Cart\Products\Option($id, $option, $price, $quantity, $point);
    }

    protected function buildOrders()
    {
        return new Cart\Orders($this->products());
    }

    protected function buildProducts()
    {
        $products = array();
        foreach($this->options->asArray() as $option) {
            $pointId               = $option->shopId . $option->shopTariffId . $option->addressId;
            $products[$option->id] = $this->buildOption($option->id, $option->option, $option->price, $option->quantity, $pointId);
        }

        foreach($this->certificates->asArray() as $certificate) {
            $pointId                    = $certificate->shopId . $certificate->shopTariffId . $certificate->addressId;
            $products[$certificate->id] = $this->buildCertificate($certificate->id, $certificate->certificate, $certificate->price, $certificate->quantity, $pointId);
        }

        return new Cart\Products($this->provider, $products);
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
