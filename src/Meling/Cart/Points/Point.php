<?php
namespace Meling\Cart\Points;

/**
 * Точка Отправления Товара (ТОТ).
 * Точка Выдачи Товара (ТВТ).
 * Пункт Выдачи Заказов (ПВЗ).
 * ТВТ, может быть ПВЗ (Рочничный Магазин), ПВЗ с доставкой (PickPoint, Почта России) или Способ доставки (Курьер, СДЭК)
 * Interface Point
 * @package Meling\Cart\Points
 */
interface Point
{
    /**
     * Полное название ТВТ
     * Магазин: Название Магазина + Адрес Магазина
     * PickPoint: [Идентификатор ПВЗ] + Адрес ПВЗ
     * Почта России: Название ТВТ + Название Тарифа
     * Курьер: Название ТВТ + Название Тарифа
     * СДЭК: Название ТВТ + Название Тарифа
     * @return string
     */
    public function fullName();

    /**
     * Идентификатор ТВТ
     * Магазин: shopId
     * PickPoint: shopId + deliveryId + shopTariffId
     * Почта России: shopId + deliveryId + shopTariffId + addressId
     * Курьер: shopId + deliveryId + shopTariffId + addressId
     * СДЭК: shopId + deliveryId + shopTariffId + addressId
     * @return string
     */
    public function id();

    /**
     * Название ТВТ
     * @return mixed
     */
    public function name();

    /**
     * Количество остатков Товара в ТОТ
     * @param mixed $productId Идентификатор Товара
     * @return int Количество остатков Товара
     */
    public function rests($productId);

}
