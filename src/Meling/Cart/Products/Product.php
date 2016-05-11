<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * @package Meling\Cart\Products
 */
abstract class Product
{
    /**
     * @var int
     */
    protected $id;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $entity;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var \Meling\Cart\Points\Point
     */
    protected $point;

    /**
     * Product constructor.
     * @param int                       $id
     * @param int                       $quantity
     * @param int                       $price
     * @param \Meling\Cart\Points\Point $point
     */
    public function __construct($id, $price, $quantity, $point)
    {
        $this->id       = $id;
        $this->quantity = $quantity;
        $this->price    = $price;
        $this->point    = $point;
    }

    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    public function entity()
    {
        return $this->entity;
    }

    /**
     * @return int
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return \Meling\Cart\Points\Point
     */
    public function point()
    {
        return $this->point;
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }

}
