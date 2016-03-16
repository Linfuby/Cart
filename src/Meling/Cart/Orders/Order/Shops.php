<?php
namespace Meling\Cart\Orders\Order;

class Shops
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Shops\Shop[]
     */
    protected $shops;

    /**
     * @var Shops\Shop
     */
    protected $shop;

    /**
     * Shops constructor.
     * @param \Meling\Cart\Providers\Provider $provider
     * @param Products                        $products
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, Products $products)
    {
        $this->provider = $provider;
        $this->shops    = $this->buildShops($products);
        $this->shop     = $this->buildShop($this->provider->source()->query('shop')->in(-146541850)->findOne());
    }

    public function asArray()
    {
        return $this->shops;
    }

    public function get($id)
    {
        if(array_key_exists($id, $this->shops)) {
            return $this->shops[$id];
        }
        throw new \Exception('Shop ' . $id . ' does not exist');
    }

    public function getDefault()
    {
        return $this->shops ? current($this->shops) : $this->shop;
    }

    protected function buildShop($shop)
    {
        return new Shops\Shop($shop);
    }

    /**
     * @param Products $products
     * @return array
     */
    protected function buildShops(Products $products)
    {
        $shops = array();
        foreach($products->asArray() as $product) {
            foreach($product->option()->shopRests() as $rest) {
                if(!array_key_exists($rest->shopId, $shops)) {
                    $shops[$rest->shopId] = $this->buildShop($rest->shop());
                }
            }
        }

        return $shops;
    }

}
