<?php
namespace Meling\Cart\Points;

class Deliveries
{
    /**
     * @var array
     */
    protected $deliveries;

    /**
     * Deliveries constructor.
     * @param array $deliveries
     */
    public function __construct(array $deliveries)
    {
        $this->deliveries = $deliveries;
    }

    public function asArray()
    {
        return $this->deliveries;
    }

    public function get($id)
    {
        if (array_key_exists($id, $this->deliveries)) {
            return $this->deliveries[$id];
        }
        throw new \Exception('Delivery ' . $id . ' does not exist');
    }

}
