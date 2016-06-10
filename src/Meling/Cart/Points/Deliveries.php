<?php
namespace Meling\Cart\Points;

class Deliveries extends \ArrayObject
{
    /**
     * @return \ArrayIterator|Point\Delivery[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return Point\Delivery
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

}
