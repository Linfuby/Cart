<?php
namespace Meling\Cart;

class Addresses
{
    /**
     * @var \Parishop\ORMWrappers\Address\Entity[]
     */
    protected $addresses;
    /**
     * @var \Parishop\ORMWrappers\Address\Entity
     */
    protected $address;

    /**
     * Addresses constructor.
     * @param \Parishop\ORMWrappers\Address\Entity[] $addresses
     * @param \Parishop\ORMWrappers\Address\Entity $address
     */
    public function __construct(array $addresses, \Parishop\ORMWrappers\Address\Entity $address = null)
    {
        $this->addresses = $addresses;
        $this->address = $address;
    }

    /**
     * @return \Parishop\ORMWrappers\Address\Entity[]
     */
    public function asArray()
    {
        return $this->addresses;
    }

    /**
     * @param $id
     * @return \Parishop\ORMWrappers\Address\Entity
     * @throws \Exception
     */
    public function get($id = null)
    {
        if ($id === null) {
            if ($this->address === null) {
                return current($this->addresses);
            }
            return $this->address;
        }
        if (array_key_exists($id, $this->addresses)) {
            return $this->addresses[$id];
        }
        throw new \Exception("Address '$id' does not exist");
    }

}
