<?php
namespace Meling\Cart;

class Addresses extends \ArrayObject
{
    /**
     * @var \Parishop\ORMWrappers\Address\Entity
     */
    protected $address;

    /**
     * Addresses constructor.
     * @param \Parishop\ORMWrappers\Address\Entity[] $addresses
     * @param \Parishop\ORMWrappers\Address\Entity   $address
     */
    public function __construct(array $addresses, \Parishop\ORMWrappers\Address\Entity $address = null)
    {
        parent::__construct($addresses);
        $this->address = $address;
    }

    /**
     * @param \Parishop\ORMWrappers\Address\Entity $address
     */
    public function add($address)
    {
        $this->offsetSet($address->id(), $address);
    }

    /**
     * @return \Parishop\ORMWrappers\Address\Entity[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return \Parishop\ORMWrappers\Address\Entity
     * @throws \Exception
     */
    public function get($id = null)
    {
        if(!$id) {
            if($this->address === null) {
                return $this->getIterator()->current();
            }

            return $this->address;
        }
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }
        throw new \Exception("Address '$id' does not exist");
    }

}
