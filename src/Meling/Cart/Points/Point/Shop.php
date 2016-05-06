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

}
