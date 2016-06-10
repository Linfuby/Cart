<?php
namespace Meling\Cart\Products;

/**
 * Class Certificate
 * @package Meling\Cart\Products
 */
class Certificate extends Product
{
    /**
     * @var \Parishop\ORMWrappers\Certificate\Entity
     */
    protected $certificate;

    /**
     * Product constructor.
     * @param string                                   $id
     * @param \Parishop\ORMWrappers\Certificate\Entity $certificate
     * @param int                                      $quantity
     * @param int                                      $price
     * @param \Meling\Cart\Points                      $points
     * @param string                                   $pointId
     * @param string                                   $shopId
     * @param string                                   $shopTariffId
     * @param \Parishop\ORMWrappers\City\Entity        $city
     * @param string                                   $cityId
     * @param string                                   $addressId
     * @param string                                   $pvz
     */
    public function __construct($id, $certificate, $quantity, $price, \Meling\Cart\Points $points, $pointId = null, $shopId = null, $shopTariffId = null, $city = null, $cityId = null, $addressId = null, $pvz = null)
    {
        parent::__construct($id, $quantity, $price, $points, $pointId, $shopId, $shopTariffId, $city, $cityId, $addressId, $pvz);
        $this->certificate = $certificate;
    }

    /**
     * @return \Parishop\ORMWrappers\Certificate\Entity
     */
    public function certificate()
    {
        return $this->certificate;
    }

    public function name()
    {
        return $this->certificate->price;
    }

    public function old_price()
    {
        return 0;
    }

}
