<?php
namespace Meling\Cart\Orders\Order;

/**
 * Class Products
 * @package Meling\Cart\Orders\Order
 */
class Products
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Products\Product[]
     */
    protected $products;

    protected $shops;

    protected $actions;

    /**
     * Products constructor
     * @param \Meling\Cart\Providers\Provider $provider
     * @param array                           $products
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, array $products = array())
    {
        $this->provider = $provider;
        $this->products = $this->requireProducts($products);
        $this->shops    = new Shops($provider, $this);
        $this->actions  = new Actions($provider, $this);
    }

    public function actions()
    {
        return $this->actions;
    }

    public function add($product)
    {
        if($product instanceof \PHPixie\ORM\Drivers\Driver\PDO\Entity) {
            $option = $product->option();
        } else {
            if(is_array($product)) {
                $product = (object)$product;
            }
            $option = $product->option;
        }
        if(empty($product->price)) {
            $product->price = $option->price;
        }
        if(empty($product->quantity)) {
            $product->quantity = 1;
        }
        $product = $this->buildProduct(count($this->products), $option, $product->price, $product->quantity);
        $id      = $this->provider->addProduct($product);
        $product->setId($id);
        $this->products[$id] = $product;
    }

    public function asArray()
    {
        return $this->products;
    }

    /**
     * @return $this
     */
    public function clear()
    {
        $this->products = array();
        $this->provider()->clearProducts();

        return $this;
    }

    public function count()
    {
        return count($this->asArray());
    }

    public function get($id)
    {
        if(array_key_exists($id, $this->products)) {
            return $this->products[$id];
        }
        throw new \Exception('Product ' . $id . ' does not exist');
    }

    /**
     * @return \Meling\Cart\Providers\Provider
     */
    public function provider()
    {
        return $this->provider;
    }

    public function quantity()
    {
        $quantity = 0;
        foreach($this->asArray() as $product) {
            $quantity += $product->quantity();
        }

        return $quantity;
    }

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id)
    {
        unset($this->products[$id]);
        $this->provider()->removeProducts($id);

        return $this;
    }

    public function shops()
    {
        return $this->shops;
    }

    public function totals()
    {
        return new Totals($this);
    }

    protected function buildProduct(
        $id,
        $option,
        $price,
        $quantity,
        $shop = null,
        $shopTariff = null,
        $address = null,
        $pvz = null)
    {
        return new Products\Product($id, $option, $price, $quantity, $shop, $shopTariff, $address, $pvz);
    }

    /**
     * @param array $objects
     * @return Products\Product[]
     */
    protected function requireProducts($objects = array())
    {
        $products = array();
        foreach($objects as $id => $object) {
            if($object instanceof \PHPixie\ORM\Drivers\Driver\PDO\Entity) {
                $option = $object->option();
            } else {
                $option = $object->option;
            }
            $products[$id] = $this->buildProduct($id, $option, $object->price, $object->quantity);
        }

        return $products;
    }

}
