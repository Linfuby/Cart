<?php
namespace Meling\Cart\Orders\Order\Deliveries;

/**
 * Class Delivery
 * @method string id()
 * @method string name()
 * @method \PHPixie\ORM\Drivers\Driver\PDO\Entity[] shopTariffs()
 * @package Meling\Cart\Deliveries
 */
class Delivery
{

    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $entity;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $address;

    /**
     * @var \PHPixie\ORM\Drivers\Driver\PDO\Entity
     */
    protected $shopTariffDefault;

    /**
     * Delivery constructor.
     * @param \Meling\Cart\Providers\Provider        $provider
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $entity
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $address
     */
    public function __construct($provider, $entity, $address)
    {
        $this->provider = $provider;
        $this->entity  = $entity;
        $this->address = $address;
    }

    function __call($name, $arguments)
    {
        return $this->entity->{$name}($arguments);
    }

    public function __get($name)
    {
        return $this->entity->{$name};
    }

    public function city()
    {
        return $this->address ? $this->address->city() : $this->provider->source()->city();
    }

    public function cost()
    {
        return null;
    }

    public function country()
    {
        return $this->address ? $this->address->country() : $this->provider->source()->country();
    }

    public function getDefault($id)
    {
        return $this->shopTariffDefault;
    }

    public function region()
    {
        return $this->address ? $this->address->region() : $this->provider->source()->region();
    }

    /**
     * @param \PHPixie\ORM\Drivers\Driver\PDO\Entity $shopTariff
     */
    public function setDefault($shopTariff)
    {
        $this->shopTariffDefault = $shopTariff;
    }

    public function tariff()
    {
        foreach($this->entity->shops() as $shop) {

        }
    }

}
