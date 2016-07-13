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
     * @param Providers\Provider $provider
     * @param Products           $products
     */
    public function __construct(Providers\Provider $provider, Products $products)
    {
        foreach($products->asArray() as $product) {
            if($product->point()) {
                if(!$this->offsetExists($product->point()->id())) {
                    $provider->resetCards();
                    $products = new \Meling\Cart\Products\Custom($provider);
                    $this->offsetSet($product->point()->id(), $this->buildOrder($product->point()->id(), $products, $product->point(), $product->pvz()));
                }
                $product->priceReset();
                $this->offsetGet($product->point()->id())->products()->offsetSet($product->id(), $product);
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

    protected function buildOrder($id, $products, $point, $pvz)
    {
        return new Orders\Order($id, $products, $point, $pvz);
    }

}
