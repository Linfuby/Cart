<?php
namespace Meling\Cart\Points;

class Deliveries
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    protected $shopTariffs;

    /**
     * @var string
     */
    protected $addressId;

    /**
     * @var Point[]
     */
    protected $points;

    /**
     * Shops constructor.
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $shopTariffs
     * @param string                                       $addressId
     */
    public function __construct(array $shopTariffs, $addressId)
    {
        $this->shopTariffs = $shopTariffs;
        $this->addressId   = $addressId;
    }

    public function asArray()
    {
        $this->requirePoints();

        return $this->points;
    }

    public function get($id)
    {
        $this->requirePoints();
        if(array_key_exists($id, $this->points)) {
            return $this->points[$id];
        }
        throw new \Exception('Delivery ' . $id . ' does not exist');
    }

    protected function buildPoint($shop, $delivery, $shopTariff, $address)
    {
        return new \Meling\Cart\Points\Point\Delivery($shop, $delivery, $shopTariff, $address);
    }

    protected function requirePoints()
    {
        if($this->points !== null) {
            return;
        }
        $points = array();
        foreach($this->shopTariffs as $shopTariff) {
            $points[$shopTariff->getRequiredField('shopId') . $shopTariff->getRequiredField('shopTariffId') . $this->addressId] = $this->buildPoint($shopTariff->shop(), $shopTariff->delivery(), $shopTariff, $this->addressId);
        }
        $this->points = $points;
    }

}
