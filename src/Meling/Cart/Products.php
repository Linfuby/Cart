<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
class Products
{
    /**
     * @var Products\Product[]
     */
    protected $products;

    /**
     * @param \Meling\Cart\Providers\Product[] $products
     */
    public function __construct($products)
    {
        $this->buildProducts($products);
    }

    public function asArray()
    {
        return $this->products;
    }

    /**
     * @param int $id
     * @return Products\Product
     * @throws \Exception
     */
    public function get($id)
    {
        if(array_key_exists($id, $this->products)) {
            return $this->products[$id];
        }
        throw new \Exception('Product ' . $id . ' does not exist');
    }

    /**
     * @param \Meling\Cart\Providers\Product $product
     * @return Products\Product
     */
    protected function buildProduct($product)
    {
        return new Products\Product($product);
    }

    /**
     * @param \Meling\Cart\Providers\Product[] $products
     */
    protected function buildProducts($products)
    {
        $this->products = array();
        foreach($products as $product) {
            $this->products[] = $this->buildProduct($product);
        }
    }

}
