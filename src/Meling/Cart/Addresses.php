<?php
namespace Meling\Cart;

class Addresses
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    protected $addresses;
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $address;

    /**
     * Addresses constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $addresses
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $address
     */
    public function __construct(array $addresses, \PHPixie\ORM\Wrappers\Type\Database\Entity $address = null)
    {
        $this->addresses = $addresses;
        $this->address = $address;
    }

    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    public function asArray()
    {
        return $this->addresses;
    }

    /**
     * @param $id
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
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
