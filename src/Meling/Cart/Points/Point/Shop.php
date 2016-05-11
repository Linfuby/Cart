<?php
namespace Meling\Cart\Points\Point;

class Shop extends \Meling\Cart\Points\Point\Implementation
{
    /**
     * Implementation constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity   $shop
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $rests
     */
    public function __construct($shop, $rests)
    {
        parent::__construct($shop->id(), $shop->getRequiredField('name'), $shop->getRequiredField('street'), $rests);
    }

    public function addressId()
    {
        return null;
    }

    public function deliveryId()
    {
        return null;
    }

    public function pvz()
    {
        // TODO: Implement pvz() method.
    }

    public function shopId()
    {
        return $this->id();
    }

    public function shopTariffId()
    {
        return null;
    }


}
