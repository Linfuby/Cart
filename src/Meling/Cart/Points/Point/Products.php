<?php
namespace Meling\Cart\Points\Point;

class Products extends \ArrayObject
{
    /**
     * @param mixed $id
     * @return int
     */
    public function rests($id)
    {
        return $this->offsetExists($id) ? $this->offsetGet($id) : 0;
    }
}
