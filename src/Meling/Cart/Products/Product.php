<?php
namespace Meling\Cart\Products;

/**
 * Class Product
 * 1. Название
 * 2. Опция/Сертификат (Интерфейс Товара)
 * 3. Цена
 * 4. Количество
 * 5. Точка Отправки
 * 6. Точка Получения
 * 7. Адрес Получателя
 * 8. Способ доставки
 * 9. Акции
 * 10. Доступные Точки Получения
 * 11. Доступные Тарифы отправления (Необходимо указание города Получения)
 * @package Meling\Cart\Products
 */
class Product
{
    /**
     * @var null
     */
    public $shopId;

    /**
     * @var null
     */
    public $deliveryId;

    /**
     * @var null
     */
    public $shopTariffId;

    /**
     * @var null
     */
    public    $addressId;

    public    $pvz;

    protected $priceTotal;

    protected $priceFinal;

    private   $id;

    private   $entity;

    private   $quantity;

    private   $price;

    private   $old_price;

    private   $name;

    private   $image;

    private   $brand;

    /**
     * @param      $id
     * @param      $entity
     * @param int  $quantity
     * @param int  $price
     * @param      $old_price
     * @param      $name
     * @param      $image
     * @param      $brand
     * @param      $shopId
     * @param      $deliveryId
     * @param      $shopTariffId
     * @param      $addressId
     * @param      $pvz
     */
    public function __construct(
        $id,
        $entity,
        $quantity,
        $price,
        $old_price,
        $name,
        $image,
        $brand,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    ) {
        $this->priceFinal   = $this->priceTotal();
        $this->id           = $id;
        $this->entity       = $entity;
        $this->quantity     = $quantity;
        $this->price        = $price;
        $this->old_price    = $old_price;
        $this->name         = $name;
        $this->image        = $image;
        $this->brand        = $brand;
        $this->shopId       = $shopId;
        $this->deliveryId   = $deliveryId;
        $this->shopTariffId = $shopTariffId;
        $this->addressId    = $addressId;
        $this->pvz          = $pvz;
        $this->priceTotal   = $this->price * $this->quantity;
        $this->priceFinal   = $this->price * $this->quantity;
    }

    public function brand()
    {
        return $this->brand;
    }

    /**
     * @return \Parishop\ORMWrappers\Option\Entity|\Parishop\ORMWrappers\Certificate\Entity
     */
    public function entity()
    {
        return $this->entity;
    }

    public function id()
    {
        return $this->id;
    }

    public function image()
    {
        return $this->image;
    }

    public function mainColorName()
    {
        if($this->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
            return $this->entity()->product()->mainColor()->name();
        }

        return '';
    }

    public function name()
    {
        return $this->name;
    }

    public function old_price()
    {
        return $this->old_price;
    }

    public function par()
    {
        if($this->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
            return $this->entity()->product()->par;
        }

        return '';
    }

    public function price()
    {
        return $this->price;
    }

    public function priceFinal($price = null)
    {
        if((int)$price) {
            $this->priceFinal = $this->priceFinal - (int)$price;
        }

        return $this->priceFinal;
    }

    public function priceTotal()
    {
        return $this->priceTotal;
    }

    public function quantity()
    {
        return $this->quantity;
    }

    public function sizeName()
    {
        if($this->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
            return $this->entity()->sizeName();
        }

        return '';
    }

    public function url()
    {
        if($this->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
            return '/product/' . $this->entity()->product()->par;
        }
        if($this->entity() instanceof \Parishop\ORMWrappers\Certificate\Entity) {
            return '/certificates';
        }

        return '';
    }

}
