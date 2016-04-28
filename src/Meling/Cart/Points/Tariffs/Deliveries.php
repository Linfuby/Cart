<?php
namespace Meling\Cart\Points\Tariffs;

class Deliveries
{
    /**
     * @var \Meling\Cart\Points\Tariffs
     */
    protected $tariffs;

    private   $deliveries;

    /**
     * Deliveries constructor.
     * @param \Meling\Cart\Points\Tariffs $tariffs
     */
    public function __construct($tariffs)
    {
        $this->tariffs = $tariffs;
    }

    public function asArray()
    {
        $this->requireDeliveries();

        return $this->deliveries;
    }

    protected function buildDelivery($name)
    {
        $class = '\Meling\Cart\Points\Tariffs\Deliveries\\' . ucfirst($name);
        if(class_exists($class)) {
            return new $class();
        }
        throw new \Exception('Delivery ' . $name . ' does not exist');
    }

    protected function requireDeliveries()
    {
        if($this->deliveries !== null) {
            return;
        }
        $deliveries = array();
        foreach($this->tariffs->asArray() as $tariff) {
            if(array_key_exists($tariff->deliveryId, $deliveries)) {
                $deliveries[$tariff->deliveryId] = $this->buildDelivery($tariff->delivery()->getRequiredField('name'));
            }
        }
        $this->deliveries = $deliveries;
    }

}
