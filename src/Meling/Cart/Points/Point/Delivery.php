<?php
namespace Meling\Cart\Points\Point;

class Delivery extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * Implementation constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shop
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $delivery
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shopTariff
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $address
     */
    public function __construct($shop, $delivery, $shopTariff, $address)
    {
        parent::__construct($shop->id() . $delivery->id() . $shopTariff->id() . $address->id(), $delivery->getRequiredField('name'), $shopTariff->getRequiredField('name'), array());
    }

}
