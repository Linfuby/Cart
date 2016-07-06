<?php
namespace Meling\Cart\Products;

/**
 * Class Option
 * @package Meling\Cart\Products
 */
class Option extends Product
{
    /**
     * Option constructor.
     *
     * @param \PHPixie\ORM\Models\Model\Entity $entity
     * @param int                                    $qty
     * @param int                                    $price
     * @param mixed                                  $shopId
     * @param mixed                                  $shopTariffId
     * @param mixed                                  $cityId
     * @param mixed                                  $addressId
     * @param string                                 $pvz
     */
    public function __construct(
        \PHPixie\ORM\Models\Model\Entity $entity,
        $qty,
        $price,
        $shopId,
        $shopTariffId,
        $cityId,
        $addressId,
        $pvz
    ) {
        $inflector = new \PHPixie\ORM\Configs\Inflector();
        $provider  = new \Meling\Cart\Providers\Products\Option($inflector);
        parent::__construct($provider, $entity, $qty, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
    }

    /**
     * @return \PHPixie\ORM\Models\Type\Database\Entity
     */
    public function option()
    {
        return $this->entity;
    }

}

