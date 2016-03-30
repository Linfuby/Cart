<?php
namespace Meling\Cart;

class Products
{
    /**
     * @var Products\Product[]
     */
    protected $products;

    /**
     * @var Provider
     */
    protected $provider;

    /**
     * @param Provider $provider
     */
    public function __construct(Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param \Meling\Cart\Objects\Certificate $certificate
     * @return int
     */
    public function addCertificate($certificate)
    {
        return $this->provider->objects()->add($certificate);
    }

    /**
     * @param \Meling\Cart\Objects\Option $option
     * @return int
     */
    public function addOption($option)
    {
        return $this->provider->objects()->add($option);
    }

    public function asArray()
    {
        $this->requireProducts();

        return $this->products;
    }

    public function requireProducts()
    {
        if($this->products !== null) {
            return;
        }
        $products = array();
        foreach($this->provider->objects()->asArray() as $id => $object) {
            $products[$id] = $this->buildProduct($object);
        }
        $this->products = $products;
    }

    private function buildProduct($object)
    {
        return new Products\Product($object);
    }

}
