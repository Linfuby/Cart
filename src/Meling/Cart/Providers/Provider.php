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
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var \PHPixie\HTTP\Context\Session
     */
    protected $session;

    /**
     * @var CartObject[]
     */
    protected $objects;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                  $orm
     * @param \PHPixie\HTTP\Context\Session $session
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session)
    {
        $this->orm     = $orm;
        $this->session = $session;
    }

    /**
     * @param                              $id
     * @param \Meling\Cart\Wrappers\Entity $entity
     * @param                              $price
     * @param                              $quantity
     * @param                              $image
     * @param                              $shopId
     * @param                              $deliveryId
     * @param                              $shopTariffId
     * @param                              $addressId
     * @param                              $pvz
     * @param                              $customerId
     * @return string
     */
    public function addObject($id, $entity, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null)
    {
        $this->requireObjects();
        if($entity instanceof \Meling\Cart\Wrappers\Certificate\Entity) {
            return $this->addCertificate($id, $entity, $price, $quantity, $image, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz, $customerId);
        }
        if($entity instanceof \Meling\Cart\Wrappers\Option\Entity) {
            return $this->addOption($id, $entity, $price, $quantity, $image, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz, $customerId);
        }

        return null;
    }

    public function objects()
    {
        $this->requireObjects();

        return $this->objects;
    }

    /**
     * @param                                          $id
     * @param \Meling\Cart\Wrappers\Certificate\Entity $certificate
     * @param                                          $price
     * @param                                          $quantity
     * @param                                          $image
     * @param                                          $shopId
     * @param                                          $deliveryId
     * @param                                          $shopTariffId
     * @param                                          $addressId
     * @param                                          $pvz
     * @param                                          $customerId
     * @return array
     */
    protected abstract function addCertificate($id, $certificate, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null);

    /**
     * @param                                     $id
     * @param \Meling\Cart\Wrappers\Option\Entity $option
     * @param                                     $price
     * @param                                     $quantity
     * @param                                     $image
     * @param                                     $shopId
     * @param                                     $deliveryId
     * @param                                     $shopTariffId
     * @param                                     $addressId
     * @param                                     $pvz
     * @param                                     $customerId
     * @return array
     */
    protected abstract function addOption($id, $option, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null);

    /**
     * @return array
     */
    protected abstract function requireObjects();


}
