<?php
namespace Meling\Cart\Products;

class Product
{
    protected $id;

    protected $option;

    protected $price;

    protected $priceFinal;

    protected $quantity;

    /**
     * Product constructor.
     * @param int                                        $id
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $option
     * @param int                                        $price
     * @param int                                        $quantity
     */
    public function __construct($id, $option, $price = 0, $quantity = 1)
    {
        $this->id         = $id;
        $this->option     = $option;
        $this->price      = $price;
        $this->quantity   = $quantity;
        $this->priceTotal = (int)$this->price * (int)$this->quantity;
        $this->priceFinal = $this->priceTotal;
    }

    function __call($name, $arguments)
    {
        return $this->option->product()->{$name}();
    }

    public function __get($name)
    {
        return $this->option->product()->{$name};
    }

    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    public function actionProducts()
    {
        //TODO
        return array();
    }

    function id()
    {
        return $this->id;
    }

    public function option()
    {
        return $this->option;
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
    public function priceFinal()
    {
        return $this->priceFinal;
    }

    /**
     * @return int
     */
    public function priceTotal()
    {
        return $this->priceTotal;
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }

}
