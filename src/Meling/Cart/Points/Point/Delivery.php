<?php
namespace Meling\Cart\Points\Point;

class Delivery extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * Implementation constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shop
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shopTariff
     * @param string                                     $deliveryName
     * @param string                                     $addressId
     */
    public function __construct($shop, $shopTariff, $deliveryName, $addressId = null)
    {
        parent::__construct(
            $shop->id() . $shopTariff->id() . $addressId,
            $deliveryName,
            $shopTariff->getRequiredField('name'), array()
        );
    }

    public function addressId()
    {
        // TODO: Implement addressId() method.
    }

    public function deliveryId()
    {
        // TODO: Implement deliveryId() method.
    }

    public function pvz()
    {
        // TODO: Implement pvz() method.
    }

    public function shopId()
    {
        // TODO: Implement shopId() method.
    }

    public function shopTariffId()
    {
        // TODO: Implement shopTariffId() method.
    }


}
