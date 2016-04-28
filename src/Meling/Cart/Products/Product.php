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

    /**
     * @param \Meling\Cart\Providers\Product $product
     */
    public function __construct($product)
    {
        $this->product = $product;
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\Option|\Meling\Tests\ORMWrappers\Entities\Certificate
     */
    public function entity()
    {
        return $this->product->entity;
    }

}
