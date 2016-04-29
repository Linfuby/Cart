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

    public function get($id)
    {
        $this->requireDeliveries();
        if(array_key_exists($id, $this->deliveries)) {
            return $this->deliveries[$id];
        }
        throw new \Exception('Delivery ' . $id . ' does not exist');
    }

    /**
     * @param \Meling\Tests\ORMWrappers\Entities\Delivery     $delivery
     * @param \Meling\Tests\ORMWrappers\Entities\ShopTariff[] $tariffs
     * @param \Meling\Tests\ORMWrappers\Entities\ShopTariff   $defaultTariff
     * @return mixed
     * @throws \Exception
     */
    protected function buildDelivery($delivery, $tariffs, $defaultTariff)
    {
        $class = '\Meling\Cart\Points\Tariffs\Deliveries\\' . ucfirst($delivery->getRequiredField('alias'));

        return new $class($delivery, $tariffs, $defaultTariff);
    }

    protected function requireDeliveries()
    {
        if($this->deliveries !== null) {
            return;
        }
        $deliveries = array();
        foreach($this->tariffs->asArray() as $tariff) {
            if(!array_key_exists($tariff->delivery()->getRequiredField('alias'), $deliveries)) {
                $deliveries[(string)$tariff->delivery()->getRequiredField('alias')] = (object)array(
                    'class'         => $tariff->delivery(),
                    'tariffs'       => array(),
                    'defaultTariff' => $tariff
                );
            }
            $deliveries[(string)$tariff->delivery()->getRequiredField('alias')]->tariffs[(string)$tariff->id()] = $tariff;
        }
        foreach($deliveries as $alias => $delivery) {
            $this->deliveries[] = $this->buildDelivery($delivery->class, $delivery->tariffs, $delivery->defaultTariff);
        }
    }

}
