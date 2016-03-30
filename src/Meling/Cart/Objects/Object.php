<?php
namespace Meling\Cart\Objects;

/**
 * Объект
 * Class Object
 * @package Meling\Cart\Objects
 */
abstract class Object
{
    /**
     * @var mixed
     */
    protected $id;

    /**
     * @var \Meling\Cart\Wrappers\Entity
     */
    protected $entity;

    /**
     * @var int
     */
    protected $price;

    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var mixed
     */
    protected $shopId;

    /**
     * @var mixed
     */
    protected $shopTariffId;

    /**
     * @var mixed
     */
    protected $addressId;

    /**
     * @var string
     */
    protected $pvz;

    /**
     * Object constructor.
     * @param mixed                        $id           Идентификатор
     * @param \Meling\Cart\Wrappers\Entity $entity       Сущность
     * @param int                          $price        Стоимость
     * @param int                          $quantity     Количество
     * @param mixed                        $shopId       Идентфикатор Точки отправления
     * @param mixed                        $shopTariffId Идентификатор Тарифа доставки
     * @param mixed                        $addressId    Идентификатор Точки получения
     * @param string                       $pvz          Пункт выдачи
     */
    public function __construct($id, $entity, $price, $quantity = 1, $shopId = null, $shopTariffId = null, $addressId = null, $pvz = null)
    {
        $this->id           = (string)$id;
        $this->entity       = $entity;
        $this->price        = (int)$price;
        $this->quantity     = (int)$quantity;
        $this->shopId       = $shopId;
        $this->shopTariffId = $shopTariffId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
    }

    /**
     * @return mixed
     */
    public function getAddressId()
    {
        return $this->addressId;
    }

    /**
     * @return \Meling\Cart\Wrappers\Entity
     */
    public function getEntity()
    {
        return $this->entity;
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @return string
     */
    public function getPvz()
    {
        return $this->pvz;
    }

    /**
     * @return int
     */
    public function getQuantity()
    {
        return $this->quantity;
    }

    /**
     * @return mixed
     */
    public function getShopId()
    {
        return $this->shopId;
    }

    /**
     * @return mixed
     */
    public function getShopTariffId()
    {
        return $this->shopTariffId;
    }

}
