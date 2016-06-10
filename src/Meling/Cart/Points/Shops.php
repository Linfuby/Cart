<?php
namespace Meling\Cart\Points;

class Shops extends \ArrayObject
{
    /**
     * @return \ArrayIterator|Point\Shop[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return Point\Shop
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

}
