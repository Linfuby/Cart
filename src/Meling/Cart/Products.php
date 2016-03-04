<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
class Products
{
    /**
     * @var Builder
     */
    protected $builder;

    /**
     * Products constructor.
     * @param Builder           $builder
     */
    public function __construct(Builder $builder)
    {
        $this->builder = $builder;
    }

    /**
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $product
     * @param array                                      $data
     * @return int
     */
    public function add($product, $data = array())
    {
        return $this->builder->objects()->add($product, $data);
    }

    public function asArray()
    {
        return $this->builder->objects()->objects();
    }

    /**
     * @return $this
     */
    public function clear()
    {
        return $this->builder->objects()->clear();
    }

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id)
    {
        return $this->builder->objects()->remove($id);
    }

}
