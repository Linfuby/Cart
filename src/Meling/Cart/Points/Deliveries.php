<?php
namespace Meling\Cart\Points;

class Deliveries extends \ArrayObject
{
    /**
     * @return Point\Delivery[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @return Point\Delivery
     */
    public function current()
    {
        return $this->getIterator()->current();
    }

    /**
     * @param $id
     * @return Point\Delivery
     * @throws \Exception
     */
    public function get($id)
    {
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }
        throw new \Exception('Point Delivery ' . $id . ' does not exist');
    }

    /**
     * @param                                         $id
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     * @param string                                  $pvz
     * @return Point\Delivery
     */
    public function set($id, $shopTariff, $pvz)
    {
        $point = $this->buildPoint($shopTariff, $pvz);
        $this->offsetSet($id, $point);

        return $point;
    }

    /**
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     * @param string                                  $pvz
     * @return Point\Delivery
     */
    protected function buildPoint($shopTariff, $pvz)
    {
        return new Point\Delivery($shopTariff->shopId . $shopTariff->id, $shopTariff, $pvz);
    }

}

