<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер
 * Class Provider
 * @package Meling\Cart
 */
abstract class Provider
{
    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $options;

    /**
     * @var \Meling\Cart\Products\Product[]
     */
    protected $certificates;

    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var \PHPixie\HTTP\Context
     */
    protected $context;

    /**
     * @var \Parishop\ORMWrappers\City\Entity
     */
    protected $city;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        $this->orm     = $orm;
        $this->context = $context;
    }

    public function actionId()
    {
        return $this->session()->get('actionId');
    }

    /**
     * @param int $after
     * @return \Parishop\ORMWrappers\Action\Entity[]
     */
    public function actions($after = 0)
    {
        return $this->orm()->query('allowAction')->where('after', $after)->find(array())->asArray(false, 'id');
    }

    /**
     * @return \Parishop\ORMWrappers\City\Entity
     */
    public function city()
    {
        if($this->city === null) {
            if($address = $this->address()) {
                $this->city = $address->city();
            } else {
                $cityId = $this->context->cookies()->get('defaultCityId', '-6081056');
                $city   = $this->orm()->query('city')->in($cityId)->findOne(array('region'));
                if($city === null) {
                    $city = $this->orm()->query('city')->in('-6081056')->findOne(array('region'));
                }
                $this->city = $city;
            }
        }

        return $this->city;
    }

    /**
     * @return \PHPixie\ORM
     */
    public function orm()
    {
        return $this->orm;
    }

    /**
     * @return \PHPixie\HTTP\Context\Session
     */
    public function session()
    {
        return $this->context->session();
    }

    /**
     * @param      $id
     * @param      $entity
     * @param      $quantity
     * @param      $price
     * @param      $old_price
     * @param      $name
     * @param      $image
     * @param      $brand
     * @param null $shopId
     * @param null $deliveryId
     * @param null $shopTariffId
     * @param null $addressId
     * @param null $pvz
     * @return \Meling\Cart\Products\Product
     */
    protected function buildProduct(
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
        return new \Meling\Cart\Products\Product(
            $id, $entity, $quantity, $price, $old_price, $name, $image, $brand,
            $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
        );
    }

    /**
     * @param      $certificateId
     * @param int  $quantity
     * @param null $price
     * @param null $shopId
     * @param null $deliveryId
     * @param null $shopTariffId
     * @param null $addressId
     * @param null $pvz
     * @return \Meling\Cart\Products\Product
     */
    public abstract function addCertificate(
        $certificateId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    );

    /**
     * @param      $optionId
     * @param int  $quantity
     * @param null $price
     * @param null $shopId
     * @param null $deliveryId
     * @param null $shopTariffId
     * @param null $addressId
     * @param null $pvz
     * @return \Meling\Cart\Products\Product
     */
    public abstract function addOption(
        $optionId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    );

    /**
     * @return \Parishop\ORMWrappers\Address\Entity
     */
    public abstract function address();

    /**
     * @return \Parishop\ORMWrappers\Address\Entity[]
     */
    public abstract function addresses();

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public abstract function certificates();

    public abstract function clear();

    /**
     * @return \Parishop\ORMWrappers\CustomerCard\Entity[]
     */
    public abstract function customerCards();

    public abstract function editCertificate($id, $certificateId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);

    public abstract function editOption($id, $optionId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);

    public abstract function email();

    public abstract function firstname();

    public abstract function id();

    public abstract function lastname();

    public abstract function middlename();

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public abstract function options();

    public abstract function phone();

    public abstract function removeCertificate($id);

    public abstract function removeOption($id);

}
