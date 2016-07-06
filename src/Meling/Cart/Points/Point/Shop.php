<?php
namespace Meling\Cart\Points\Point;

/**
 * Class Shop
 * @property string street
 * @property string work_times
 * @property string phone
 * @package Meling\Cart\Points\Point
 */
class Shop extends \Meling\Cart\Points\Point
{
    /** @var \Parishop\ORMWrappers\Shop\Entity */
    protected $shop;

    /** @var Products */
    protected $products;

    /**
     * Shop constructor.
     * @param string                            $id
     * @param \Parishop\ORMWrappers\Shop\Entity $shop
     */
    public function __construct($id, $shop)
    {
        parent::__construct($id);
        $this->shop     = $shop;
        $this->products = new Products(array());
    }

    /**
     * @param string $name
     * @param array  $arguments
     * @return mixed
     */
    function __call($name, $arguments)
    {
        return call_user_func_array(array($this->shop, $name), $arguments);
    }

    /**
     * @param string $name
     * @return string
     */
    function __get($name)
    {
        return $this->shop->{$name};
    }

    public function cost()
    {
        return 0;
    }

    public function name()
    {
        return $this->shop->name();
    }

    public function nameCity()
    {
        return $this->shop->name() . ' (' . $this->shop->city()->name() . ')';
    }

    public function nameFull()
    {
        return $this->shop->name() . ' (' . $this->shop->street . ')';
    }

    public function products()
    {
        return $this->products;
    }


}

