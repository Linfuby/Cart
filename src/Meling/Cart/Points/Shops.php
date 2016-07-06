<?php
namespace Meling\Cart\Points;

class Shops extends \ArrayObject
{
    /**
     * @return Point\Shop[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @return Point\Shop
     */
    public function current()
    {
        return $this->getIterator()->current();
    }

    /**
     * @param $id
     * @return Point\Shop
     * @throws \Exception
     */
    public function get($id)
    {
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }
        throw new \Exception('Point Shop ' . $id . ' does not exist');
    }

    /**
     * @param string                            $id
     * @param \Parishop\ORMWrappers\Shop\Entity $shop
     * @return Point\Shop
     */
    public function set($id, $shop)
    {
        $point = $this->buildPoint($shop);
        $this->offsetSet($id, $point);

        return $point;
    }

    /**
     * @param \Parishop\ORMWrappers\Shop\Entity $shop
     * @return Point\Shop
     */
    protected function buildPoint($shop)
    {
        return new Point\Shop($shop->id, $shop);
    }

}

