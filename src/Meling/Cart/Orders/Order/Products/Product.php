<?php
namespace Meling\Cart\Orders\Order\Products;

/**
 * Class Product
 * @property string par
 * @property string tv
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity image()
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity brand()
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity category()
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity mainColor()
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity[] tvs()
 * @method string url()
 * @method string name()
 * @package Meling\Cart\Products
 */
class Product
{
    public $addressId;

    public $deliveryId;

    /**
     * @var int
     */
    public $price;

    public $pvz;

    public $shopId;

    public $shopTariffId;

    /**
     * @var int
     */
    protected $id;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $option;

    /**
     * @var int
     */
    protected $priceFinal;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var array
     */
    protected $rests;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $shop;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $shopTariff;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $address;

    /**
     * Product constructor.
     * @param int                                    $id
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $option
     * @param int                                    $price
     * @param int                                    $quantity
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $shop
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $tariff
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $address
     * @param string                                 $pvz
     */
    public function __construct(
        $id,
        $option,
        $price = 0,
        $quantity = 1,
        $shop = null,
        $tariff = null,
        $address = null,
        $pvz = null)
    {
        $this->id         = $id;
        $this->option     = $option;
        $this->price      = $price;
        $this->quantity   = $quantity;
        $this->priceTotal = (int)$this->price * (int)$this->quantity;
        $this->priceFinal = $this->priceTotal;
        $this->shop       = $shop;
        if($shop) {
            $this->shopId = $shop->id();
        }
        $this->tariff = $tariff;
        if($tariff) {
            $this->shopTariffId = $tariff->id();
            $this->deliveryId   = $tariff->delivery()->id();
        }
        $this->address = $address;
        if($address) {
            $this->addressId = $address->id();
        }
        $this->pvz = $pvz;
    }

    function __call($name, $arguments)
    {
        return $this->option->product()->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->option->product()->{$name};
    }

    /**
     * @param null $actionId
     * @return \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    public function actionDiscount($actionId)
    {
        foreach($this->option->actionProducts() as $actionProduct) {
            if($actionProduct->actionId == $actionId) {
                return $actionProduct;
            }
        }

        return null;
    }

    /**
     * @return \PHPixie\ORM\Models\Type\Database\Entity[]
     */
    public function actionProducts()
    {
        return $this->option->actionProducts();
    }

    /**
     * @return \PHPixie\ORM\Models\Type\Database\Entity[]
     */
    public function actions()
    {
        return $this->option->actions();
    }

    public function address()
    {
        return $this->address;
    }

    public function delivery()
    {
        return $this->shopTariff ? $this->shopTariff->delivery() : null;
    }

    public function id()
    {
        return $this->id;
    }

    /**
     * @return \PHPixie\ORM\Models\Type\Database\Entity
     */
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

    public function rests($type = 'all')
    {
        if($this->rests === null) {
            $rests = array(
                'pickup'   => array(),
                'shipping' => array(),
                'all'      => array(),
            );
            foreach($this->option()->shopRests() as $rest) {
                if($rest->shop()->active) {
                    if($rest->shop()->publish && $rest->shop()->active && $rest->shop()->pickup_point) {
                        $type = 'pickup';
                    } elseif($rest->shop()->shopTariffs()->asArray()) {
                        $type = 'shipping';
                    } else {
                        $type = 'all';
                    }
                    $rests[$type][$rest->shopId] = $rest->quantity;
                }
            }
            $this->rests = $rests;
        }
        if(isset($this->rests[$type])) {
            return $this->rests[$type];
        }

        return $this->rests['all'];
    }

    public function setId($id)
    {
        $this->id = $id;
    }

    public function shop()
    {
        return $this->shop;
    }

    public function shopPvz()
    {
        return $this->shop && !$this->shopTariff ? $this->shop->name() . ': ' . $this->pvz : 'Выберите магазин';
    }

    public function shopTariff()
    {
        return $this->shopTariff;
    }

    public function tariffPvz()
    {
        return $this->shopTariff ? $this->shopTariff->delivery()->name . ': ' . $this->pvz : 'Выберите способ доставки';
    }

}
