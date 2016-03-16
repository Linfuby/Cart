<?php
namespace Meling\Cart\Orders\Order;

class Deliveries
{
    /**
     * @var Deliveries\Delivery[]
     */
    protected $deliveries;

    /**
     * @var Deliveries\Delivery
     */
    protected $deliveryDefault;

    /**
     * Shops constructor.
     * @param \Meling\Cart\Providers\Provider          $provider
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity[] $deliveries
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity    $address
     */
    public function __construct($provider, $deliveries, $address)
    {
        $this->deliveries = array();
        foreach($deliveries as $delivery) {
            $class                             = '\Meling\Cart\Deliveries\\' . ucfirst($delivery->alias);
            $this->deliveries[$delivery->id()] = new $class($provider, $delivery, $address);
        }
    }

    /**
     * @return array|Deliveries\Delivery[]
     */
    public function asArray()
    {
        return $this->deliveries;
    }

    public function get($id)
    {
        if(array_key_exists($id, $this->deliveries)) {
            return $this->deliveries[$id];
        }
        throw new \Exception('Delivery ' . $id . ' does not exist');
    }

    public function getDefault()
    {
        return $this->deliveryDefault ? $this->deliveryDefault : current($this->deliveries);
    }

    public function setDefault($id)
    {
        $this->deliveryDefault = $this->get($id);
    }

}
