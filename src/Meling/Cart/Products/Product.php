<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * @method int old_price()
 * @package Meling\Cart\Products
 */
abstract class Product
{
    /** @var \Meling\Cart\Providers\Models\Model */
    protected $model;

    /** @var \Meling\Cart\Products */
    protected $products;

    /** @var \Parishop\ORMWrappers\Entity */
    protected $entity;

    /** @var \Meling\Cart\Points */
    protected $points;

    /** @var mixed */
    private $id;

    /** @var int */
    private $quantity;

    /** @var int */
    private $price;

    /** @var int */
    private $priceTotal;

    /** @var int */
    private $priceFinal;

    /** @var mixed */
    private $shopId;

    /** @var mixed */
    private $shopTariffId;

    /** @var mixed */
    private $cityId;

    /** @var mixed */
    private $addressId;

    /** @var string */
    private $pvz;

    /**
     * Product constructor.
     * @param \Meling\Cart\Providers\Models\Model $model
     * @param \Meling\Cart\Products               $products
     * @param \Parishop\ORMWrappers\Entity        $entity
     * @param mixed                               $id
     * @param int                                 $quantity
     * @param int                                 $price
     * @param mixed                               $shopId
     * @param mixed                               $shopTariffId
     * @param mixed                               $cityId
     * @param mixed                               $addressId
     * @param string                              $pvz
     */
    public function __construct(\Meling\Cart\Providers\Models\Model $model, \Meling\Cart\Products $products, \Parishop\ORMWrappers\Entity $entity, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '')
    {
        $this->model        = $model;
        $this->products     = $products;
        $this->entity       = $entity;
        $this->id           = $id;
        $this->quantity     = $quantity;
        $this->price        = $price;
        $this->priceTotal   = $this->price * $this->quantity;
        $this->priceFinal   = $this->priceTotal;
        $this->shopId       = $shopId;
        $this->shopTariffId = $shopTariffId;
        $this->cityId       = $cityId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
    }

    /**
     * @return mixed
     */
    public function addressId()
    {
        return $this->addressId;
    }

    /**
     * @return mixed
     */
    public function cityId()
    {
        return $this->cityId;
    }

    /**
     * @return mixed
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return \Meling\Cart\Providers\Models\Model
     */
    public function model()
    {
        return $this->model;
    }

    /**
     * @return \Meling\Cart\Points\Point
     */
    public function point()
    {
        try {
            if($this->shopId() && $this->shopTariffId()) {
                return $this->points()->get($this->shopId() . $this->shopTariffId());
            }
        } catch(\Exception $e) {
            $this->setShopId(null);
            $this->setShopTariffId(null);
            $this->setCityId(null);
            $this->setAddressId(null);
            $this->setPvz('');
        }
        try {
            if($this->shopId()) {
                return $this->points()->get($this->shopId());
            }
        } catch(\Exception $e) {
            $this->setShopId(null);
            $this->setShopTariffId(null);
            $this->setCityId(null);
            $this->setAddressId(null);
            $this->setPvz('');
        }

        return null;
    }

    /**
     * @return \Meling\Cart\Points\Point\Delivery
     */
    public function pointDelivery()
    {
        if($point = $this->point()) {
            if($point instanceof \Meling\Cart\Points\Point\Delivery) {
                return $point;
            }
        }

        return null;
    }

    /**
     * @return \Meling\Cart\Points\Point
     */
    public function pointShop()
    {
        if($point = $this->point()) {
            if($point instanceof \Meling\Cart\Points\Point\Shop) {
                return $point;
            }
        }

        return null;
    }

    /**
     * @return \Meling\Cart\Points
     */
    public function points()
    {
        $this->requirePoints();

        return $this->points;
    }

    /**
     * @return int
     */
    public function price()
    {
        return $this->price;
    }

    /**
     * @return mixed
     */
    public function priceFinal()
    {
        return $this->priceFinal;
    }

    /**
     * @return mixed
     */
    public function priceTotal()
    {
        return $this->priceTotal;
    }

    /**
     * @return string
     */
    public function pvz()
    {
        return $this->pvz;
    }

    /**
     * @return int
     */
    public function quantity()
    {
        return $this->quantity;
    }

    public function save()
    {
        switch($this->model()->modelName()) {
            case 'option':
                $this->products->addOption($this->id(), 0, $this->price(), $this->shopId(), $this->shopTariffId(), $this->cityId(), $this->addressId(), $this->pvz());
                break;
            case 'certificate':
                $this->products->addCertificate($this->id(), 0, $this->price(), $this->shopId(), $this->shopTariffId(), $this->cityId(), $this->addressId(), $this->pvz());
                break;
        }
    }

    /**
     * @param mixed $addressId
     */
    public function setAddressId($addressId)
    {
        $this->addressId = $addressId;
    }

    /**
     * @param mixed $cityId
     */
    public function setCityId($cityId)
    {
        $this->cityId = $cityId;
        $this->points = null;
    }

    /**
     * @param int $price
     */
    public function setPrice($price)
    {
        $this->price = $price;
    }

    /**
     * @param string $pvz
     */
    public function setPvz($pvz)
    {
        $this->pvz = $pvz;
    }

    /**
     * @param int $quantity
     */
    public function setQuantity($quantity)
    {
        $this->quantity = $quantity;
    }

    /**
     * @param mixed $shopId
     */
    public function setShopId($shopId)
    {
        $this->shopId = $shopId;
    }

    /**
     * @param mixed $shopTariffId
     */
    public function setShopTariffId($shopTariffId)
    {
        $this->shopTariffId = $shopTariffId;
    }

    /**
     * @return mixed
     */
    public function shopId()
    {
        return $this->shopId;
    }

    /**
     * @return mixed
     */
    public function shopTariffId()
    {
        return $this->shopTariffId;
    }

    protected function requirePoints()
    {
        if($this->points !== null) {
            return;
        }
        // Формируем все доступные точки отправления товара
        $this->points = new \Meling\Cart\Points($this->products->city($this->cityId()));
        /** @var \Parishop\ORMWrappers\RestOption\Entity $rest */
        foreach($this->entity->{$this->model()->relationShips('rest')}() as $rest) {
            // Пропускаем Магазин, который не является точкой выдачи и не имеет тарифов на отправку
            if(!$rest->shop()->pickup_point && !$rest->shop()->shopTariffs()->offsetExists(0)) {
                continue;
            }
            // Если Магазин является точкой выдачи
            if($rest->shop()->pickup_point) {
                try {
                    // Пытаемся найти этот магазин среди добавленных
                    $point = $this->points->shops()->get($rest->shop()->id());
                } catch(\Exception $e) {
                    // Добавляем новый магазин в список доступных ПВЗ
                    $point = $this->points->shops()->set($rest->shop()->id(), $rest->shop());
                }
                $point->products()->offsetSet($this->id(), $rest->quantity);
                $this->points->set($point->id(), $point);
            }
            foreach($rest->shop()->shopTariffs() as $shopTariff) {
                if($shopTariff->success($this->points->city())) {
                    try {
                        $point = $this->points->deliveries()->get($shopTariff->shopId . $shopTariff->id);
                    } catch(\Exception $e) {
                        $point = $this->points->deliveries()->set($shopTariff->shopId . $shopTariff->id, $shopTariff);
                    }
                    $this->points->set($point->id(), $point);
                }
            }
        }
    }

}

