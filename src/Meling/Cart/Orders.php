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
     * @param Points             $points
     * @param Providers\Products $options
     * @param Providers\Products $certificates
     */
    public function __construct(Providers\Provider $provider, Products $products, Points $points, Providers\Products $options, Providers\Products $certificates)
    {
        foreach($products->asArray() as $product) {
            if($product->point()) {
                if(!$this->offsetExists($product->point()->id())) {
                    $this->offsetSet($product->point()->id(), $this->buildOrder($product->point()->id(), new Products($provider, $points, $options, $certificates), $product->point(), $product->pvz));
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

    protected function buildOrder($id, $products, $point, $pvz)
    {
        return new Orders\Order($id, $products, $point, $pvz);
    }

}
