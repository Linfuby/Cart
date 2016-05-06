<?php
namespace Meling\Cart\Points\Point;

class Pickpoint extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * Implementation constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shop
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $delivery
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $shopTariff
     */
    public function __construct($shop, $delivery, $shopTariff)
    {
        parent::__construct($shop->id() . $delivery->id() . $shopTariff->id(), $delivery->getRequiredField('name'), $shopTariff->getRequiredField('name'), array());
    }

}
