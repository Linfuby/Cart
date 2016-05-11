<?php
namespace Meling\Cart\Orders;

class Order
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var \Meling\Cart\Points\Point
     */
    protected $point;

    /**
     * Order constructor.
     * @param string                    $id
     * @param \Meling\Cart\Products     $products
     * @param \Meling\Cart\Points\Point $point
     */
    public function __construct($id, $products, \Meling\Cart\Points\Point $point)
    {
        $this->id       = $id;
        $this->point    = $point;
        $this->products = $products;
    }

    /**
     * @return string
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
     * @return \Meling\Cart\Products
     */
    public function products()
    {
        return $this->products;
    }

}
