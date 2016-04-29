<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * @package Meling\Cart\Products
 */
class Product
{
    /**
     * @var \Meling\Cart\Providers\Product
     */
    protected $product;

    protected $priceFinal;

    /**
     * @param \Meling\Cart\Providers\Product $product
     */
    public function __construct($product)
    {
        $this->product    = $product;
        $this->priceFinal = $this->priceTotal();
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\Option|\Meling\Tests\ORMWrappers\Entities\Certificate
     */
    public function entity()
    {
        return $this->product->entity;
    }

    public function priceFinal($price = null)
    {
        if((int)$price) {
            $this->priceFinal = $this->priceFinal - (int)$price;
        }

        return $this->priceFinal;
    }

    public function priceTotal()
    {
        return $this->product->price * $this->product->quantity;
    }

}
