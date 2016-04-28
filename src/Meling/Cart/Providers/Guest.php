<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер Гостя.
 * Данные гостя хряняться в сессии
 * 1. Товары корзины
 * 2. Сертификаты корзины
 * 3. Выбранная акция
 * Class Guest
 * @package Meling\Cart\Provider
 */
class Guest extends \Meling\Cart\Providers\Provider
{
    /**
     * @inheritdoc
     */
    protected function addCertificate($id, $certificate, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null)
    {
        $objects = $this->session->get('objects', array());
        $id      = $id ? $id : count($objects) + 1;
        $object  = array(
            'id'            => $id,
            'certificateId' => $certificate->id(),
            'price'         => $price ? $price : $certificate->getField('price'),
            'quantity'      => $quantity ? $quantity : 1,
            'image'         => $image ? $image : $certificate->getField('image'),
            'shopId'        => $shopId,
            'deliveryId'    => $deliveryId,
            'shopTariffId'  => $shopTariffId,
            'addressId'     => $addressId,
            'pvz'           => $pvz,
            'customerId'    => $customerId,
        );
        $this->session->set(
            'objects', array_merge(
                $objects, array($object)
            )
        );
        $this->objects[] = $object;

        return $object;
    }

    /**
     * @inheritdoc
     */
    protected function addOption($id, $option, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null)
    {
        $objects = $this->session->get('objects', array());
        $id      = $id ? $id : count($objects) + 1;
        $object  = array(
            'id'           => $id,
            'optionId'     => $option->id(),
            'price'        => $price ? $price : $option->price,
            'quantity'     => $quantity ? $quantity : 1,
            'image'        => $image ? $image : $option->product()->image()->name(),
            'shopId'       => $shopId,
            'deliveryId'   => $deliveryId,
            'shopTariffId' => $shopTariffId,
            'addressId'    => $addressId,
            'pvz'          => $pvz,
            'customerId'   => $customerId,
        );
        $this->session->set(
            'objects', array_merge(
                $objects, array($object)
            )
        );
        $this->objects[] = $object;

        return $object;
    }

    /**
     * 2. Сертификаты корзины.
     * Сертификаты представленны в виде Итератора сертификатов
     * @return mixed
     */
    protected function requireObjects()
    {
        if($this->objects !== null) {
            return;
        }

        $this->objects = $this->session->get('objects', array());
    }


}