<?php
namespace Meling\Cart\Objects;

/**
 * Объект Опции
 * Class Option
 * @package Meling\Cart\Objects
 */
class Option extends Object
{
    /**
     * Object constructor.
     * @param mixed                               $id           Идентификатор
     * @param \Meling\Cart\Wrappers\Option\Entity $entity       Сущность
     * @param int                                 $price        Стоимость
     * @param int                                 $quantity     Количество
     * @param mixed                               $shopId       Идентфикатор Точки отправления
     * @param mixed                               $shopTariffId Идентификатор Тарифа доставки
     * @param mixed                               $addressId    Идентификатор Точки получения
     * @param string                              $pvz          Пункт выдачи
     */
    public function __construct($id, $entity, $price, $quantity = 1, $shopId = null, $shopTariffId = null, $addressId = null, $pvz = null)
    {
        parent::__construct($id, $entity, $price, $quantity, $shopId, $shopTariffId, $addressId, $pvz);
    }

}
