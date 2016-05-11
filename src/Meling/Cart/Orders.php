<?php
namespace Meling\Cart;

/**
 * Class Orders
 * @method Orders\Order offsetGet($index)
 * @package Meling\Cart
 */
class Orders extends \ArrayObject
{
    /**
     * @var Orders\Order[]
     */
    protected $orders;

    /**
     * @var Products
     */
    protected $products;

    /**
     * Orders constructor.
     * @param Products $products
     */
    public function __construct(Products $products)
    {
        foreach($products->asArray() as $product) {
            if($product->point()->id()) {
                if(!$this->offsetExists($product->point()->id())) {
                    $this->offsetSet($product->point()->id(), $this->buildOrder($product->point()->id(), new Products($this->provider), $product->point()));
                }
                $this->offsetGet($product->point()->id())->products()->append($product);
            }
        }
    }

    /**
     * @return Orders\Order[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    public function get($id)
    {
        return $this->offsetGet($id);
    }

    protected function buildOrder($id, $products, $point)
    {
        return new Orders\Order($id, $products, $point);
    }

}
