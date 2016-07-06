<?php
namespace Meling\Cart;

class Points extends \ArrayObject
{
    /** @var \Parishop\ORMWrappers\City\Entity */
    protected $city;

    /** @var Points\Shops */
    protected $shops;

    /** @var Points\Deliveries */
    protected $deliveries;

    /**
     * Points constructor.
     * @param \Parishop\ORMWrappers\City\Entity $city
     */
    public function __construct($city)
    {
        parent::__construct(array());
        $this->city       = $city;
        $this->shops      = new Points\Shops(array());
        $this->deliveries = new Points\Deliveries(array());
    }

    /**
     * @return Points\Point[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    public function city()
    {
        return $this->city;
    }

    public function deliveries()
    {
        return $this->deliveries;
    }

    /**
     * @param mixed $id
     * @return Points\Point
     * @throws \Exception
     */
    public function get($id)
    {
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }
        throw new \Exception('Point ' . $id . ' does not exist');
    }

    /**
     * @param string $id
     * @param Points\Point
     */
    public function set($id, $point)
    {
        $this->offsetSet($id, $point);
    }

    /**
     * @param $city
     * @deprecated
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    public function shops()
    {
        return $this->shops;
    }

}
