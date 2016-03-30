<?php
namespace Meling\Cart\Objects;

/**
 * Объект Сертификата
 * Class Certificate
 * @package Meling\Cart\Objects
 */
class Certificate extends Object
{
    /**
     * @var string
     */
    protected $image;

    /**
     * Object constructor.
     * @param mixed                                    $id           Идентификатор
     * @param \Meling\Cart\Wrappers\Certificate\Entity $entity       Сущность
     * @param string                                   $image        Изображение
     * @param int                                      $price        Стоимость
     * @param int                                      $quantity     Количество
     * @param mixed                                    $shopId       Идентфикатор Точки отправления
     * @param mixed                                    $shopTariffId Идентификатор Тарифа доставки
     * @param mixed                                    $addressId    Идентификатор Точки получения
     * @param string                                   $pvz          Пункт выдачи
     */
    public function __construct($id, $entity, $image, $price, $quantity = 1, $shopId = null, $shopTariffId = null, $addressId = null, $pvz = null)
    {
        $this->image = $image;
        parent::__construct($id, $entity, $price, $quantity, $shopId, $shopTariffId, $addressId, $pvz);
    }

}
