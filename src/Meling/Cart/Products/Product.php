<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * @method string name()
 * @package Meling\Cart\Products
 */
abstract class Product
{
    /**
     * @var string
     */
    public $pointId;

    /**
     * @var string
     */
    public $shopId;

    /**
     * @var string
     */
    public $shopTariffId;

    /**
     * @var \Parishop\ORMWrappers\City\Entity
     */
    public $city;

    /**
     * @var string
     */
    public $cityId;

    /**
     * @var string
     */
    public $addressId;

    /**
     * @var string
     */
    public $pvz;

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
     * @var int
     */
    protected $priceFinal;

    /**
     * @var \Meling\Cart\Points
     */
    protected $points;

    /**
     * @var \Meling\Cart\Points\Point\Shop[]
     */
    protected $shops;

    /**
     * @var \Meling\Cart\Points\Point\Delivery[]
     */
    protected $deliveries;

    /**
     * Product constructor.
     * @param int                               $id
     * @param int                               $quantity
     * @param int                               $price
     * @param \Meling\Cart\Points               $points
     * @param string                            $pointId
     * @param string                            $shopId
     * @param string                            $shopTariffId
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @param string                            $cityId
     * @param string                            $addressId
     * @param string                            $pvz
     */
    public function __construct($id, $quantity, $price, \Meling\Cart\Points $points, $pointId = null, $shopId = null, $shopTariffId = null, $city = null, $cityId = null, $addressId = null, $pvz = null)
    {
        $this->id           = $id;
        $this->quantity     = $quantity;
        $this->price        = $price;
        $this->pointId      = $pointId;
        $this->shopId       = $shopId;
        $this->shopTariffId = $shopTariffId;
        $this->city         = $city;
        $this->cityId       = $cityId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
        $this->points       = $points;
        $this->priceFinal   = $this->priceTotal();
    }

    public function city()
    {
        return $this->city;
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
        if($this->pointId) {
            return $this->points()->get($this->pointId);
        }

        return null;
    }

    public function pointDeliveries()
    {
        if($this->deliveries === null) {
            $this->deliveries = array();
            foreach($this->points->deliveries()->asArray() as $point) {
                if($point->rests()->offsetExists($this->id())) {
                    $this->deliveries[$point->id()] = $point;
                }
            }
        }

        return $this->deliveries;
    }

    public function pointShops()
    {
        if($this->shops === null) {
            $this->shops = array();
            $this->points->shops()->uasort(array(get_class($this), 'sortedByCity'));
            foreach($this->points->shops()->asArray() as $point) {
                if($point->rests()->offsetExists($this->id())) {
                    $this->shops[$point->id()] = $point;
                }
            }
        }

        return $this->shops;
    }

    /**
     * @return \Meling\Cart\Points
     */
    public function points()
    {
        return $this->points;
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    public function priceFinal($priceFinal = null)
    {
        if($priceFinal) {
            $this->priceFinal -= $priceFinal;
        }

        return $this->priceFinal;
    }

    public function priceTotal()
    {
        return $this->price() * $this->quantity();
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }

    /**
     * @param \Meling\Cart\Points\Point\Shop $a
     * @param \Meling\Cart\Points\Point\Shop $b
     * @return int
     */
    public static function sortedByCity($a, $b)
    {
        if($a->cityId == $b->cityId) {
            return 0;
        }

        return ($a->cityId < $b->cityId) ? -1 : 1;
    }

    public abstract function old_price();

}
