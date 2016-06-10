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
     * @var string
     */
    protected $pvz;

    /**
     * Order constructor.
     * @param string                    $id
     * @param \Meling\Cart\Products     $products
     * @param \Meling\Cart\Points\Point $point
     * @param string                    $pvz
     */
    public function __construct($id, $products, \Meling\Cart\Points\Point $point, $pvz = null)
    {
        $this->id       = $id;
        $this->point    = $point;
        $this->products = $products;
        $this->pvz      = $pvz;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        $point = $this->point();
        if($point instanceof \Meling\Cart\Points\Point\Shop) {
            return $point->name() . '. ' . $point->street();
        }
        if($point instanceof \Meling\Cart\Points\Point\Delivery) {
            return $point->name() . '. ' . $this->pvz;
        }

        return null;
    }

    /**
     * @return \Meling\Cart\Points\Point\Shop|\Meling\Cart\Points\Point\Delivery
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
