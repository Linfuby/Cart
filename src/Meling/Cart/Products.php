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
     * @var \Meling\Cart
     */
    protected $cart;

    /**
     * @param Products\Product[] $products
     * @param \Meling\Cart       $cart
     */
    public function __construct($products, $cart)
    {
        $this->products = $products;
        $this->cart     = $cart;
    }

    /**
     * @return Products\Product[]
     */
    public function asArray()
    {
        return $this->products;
    }

    public function count()
    {
        return count($this->asArray());
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

    public function quantity()
    {
        $quantity = 0;
        foreach($this->asArray() as $product) {
            $quantity += $product->quantity();
        }

        return $quantity;
    }

    public function remove($id)
    {
        $product = $this->get($id);
        if($product->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
            $this->cart->customer()->removeOption($product->id());
        } elseif($product->entity() instanceof \Parishop\ORMWrappers\Certificate\Entity) {
            $this->cart->customer()->removeCertificate($product->id());
        }
    }

    public function save()
    {
        foreach($this->asArray() as $productId => $product) {
            if($product->id()) {
                if($product->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
                    $this->cart->customer()->editOption($product->id(), $product->entity()->id(), $product->quantity(), $product->price(), $product->shopId, $product->deliveryId, $product->shopTariffId, $product->addressId, $product->pvz);
                } elseif($product->entity() instanceof \Parishop\ORMWrappers\Certificate\Entity) {
                    $this->cart->customer()->editCertificate($product->id(), $product->entity()->id(), $product->quantity(), $product->price(), $product->shopId, $product->deliveryId, $product->shopTariffId, $product->addressId, $product->pvz);
                }
            } else {
                if($product->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
                    $this->cart->customer()->addOption($product->entity()->id(), $product->quantity(), $product->price(), $product->shopId, $product->deliveryId, $product->shopTariffId, $product->addressId, $product->pvz);
                } elseif($product->entity() instanceof \Parishop\ORMWrappers\Certificate\Entity) {
                    $this->cart->customer()->addCertificate($product->entity()->id(), $product->quantity(), $product->price(), $product->shopId, $product->deliveryId, $product->shopTariffId, $product->addressId, $product->pvz);
                }
            }
        }
    }

}
