<?php
namespace Meling\Cart\Orders;

class Order
{
    /**
     * @var \Meling\Cart\Customer
     */
    protected $customer;

    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @param mixed                 $id
     * @param \Meling\Cart\Customer $customer
     * @param \Meling\Cart\Products $products
     */
    public function __construct($id, $customer, $products)
    {

        $this->id       = $id;
        $this->customer = $customer;
        $this->products = $products;
    }

    /**
     * @param \Meling\Cart\Objects\Certificate $object
     * @return mixed
     */
    public function addCertificate(\Meling\Cart\Objects\Certificate $object)
    {
        return $this->products->addCertificate($object);
    }

    /**
     * @param \Meling\Cart\Objects\Option $object
     * @return mixed
     */
    public function addOption(\Meling\Cart\Objects\Option $object)
    {
        return $this->products->addOption($object);
    }

}
