<?php
namespace Meling\Cart\Points;

class Shops
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\Shop[]
     */
    protected $shops;

    /**
     * @var mixed
     */
    private $productId;

    /**
     * @var \Meling\Cart\Products
     */
    private $products;

    /**
     * Shops constructor.
     * @param \Meling\Cart\Products $products
     * @param mixed                 $productId
     */
    public function __construct(\Meling\Cart\Products $products, $productId = null)
    {
        $this->products  = $products;
        $this->productId = $productId;
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\Shop[]
     */
    public function asArray()
    {
        $this->requireShops();

        return $this->shops;
    }

    public function get($id)
    {
        $this->requireShops();
        if(array_key_exists($id, $this->shops)) {
            return $this->shops[$id];
        }
        throw new \Exception('Shop ' . $id . ' does not exist');
    }

    protected function requireShops()
    {
        if($this->shops !== null) {
            return;
        }
        $shops = array();
        if($this->productId !== null) {
            foreach($this->products->get($this->productId)->entity()->shops() as $shop) {
                $shops[$shop->id()] = $shop;
            }
        } else {
            foreach($this->products->asArray() as $product) {
                foreach($product->entity()->shops() as $shop) {
                    $shops[$shop->id()] = $shop;
                }
            }
        }
        $this->shops = $shops;
    }

}
