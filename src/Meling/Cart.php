<?php
namespace Meling;

/**
 * Class Cart
 * @package Meling
 */
class Cart
{
    /**
     * @type Cart\Orders
     */
    protected $orders;

    /**
     * Cart constructor.
     * @param Cart\Context $context
     */
    public function __construct($context)
    {
        $this->orders = new Cart\Orders($context);
    }

    /**
     * @return Cart\Orders\Order\Actions
     */
    public function actions()
    {
        return $this->orders()->get()->products()->actions();
    }

    /**
     * @return Cart\Orders\Order\Actions\Cards
     */
    public function cards()
    {
        return $this->orders()->get()->products()->actions()->cards();
    }

    /**
     * @return Cart\Orders\Order\Certificates
     */
    public function certificates()
    {
        return $this->orders()->get()->certificates();
    }

    /**
     * @return Cart\Orders
     */
    public function orders()
    {
        return $this->orders;
    }

    /**
     * @return Cart\Orders\Order\Products
     */
    public function products()
    {
        return $this->orders()->get()->products();
    }

    /**
     * @return Cart\Orders\Order\Shops
     */
    public function shops()
    {
        return $this->products()->shops();
    }

    /**
     * @return Cart\Orders\Order\Totals
     */
    public function totals()
    {
        return $this->orders()->get()->products()->totals();
    }

}
