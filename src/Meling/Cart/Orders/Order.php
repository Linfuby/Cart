<?php
namespace Meling\Cart\Orders;

class Order
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var Order\Products
     */
    protected $products;

    /**
     * @var Order\Certificates
     */
    protected $certificates;

    /**
     * Order constructor.
     * @param string             $id
     * @param Order\Products     $products
     * @param Order\Certificates $certificates
     */
    public function __construct($id, Order\Products $products, Order\Certificates $certificates)
    {
        $this->id           = $id;
        $this->products     = $products;
        $this->certificates = $certificates;
    }

    /**
     * @return Order\Certificates
     */
    public function certificates()
    {
        return $this->certificates;
    }

    public function id()
    {
        return $this->id;
    }

    /**
     * @return Order\Products
     */
    public function products()
    {
        return $this->products;
    }

}
