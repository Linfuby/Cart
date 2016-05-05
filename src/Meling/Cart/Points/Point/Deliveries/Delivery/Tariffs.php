<?php
namespace Meling\Cart\Points\Point\Deliveries\Delivery;

class Tariffs
{
    /**
     * @var Tariffs\Tariff[]
     */
    protected $tariffs;

    /**
     * @var Tariffs\Tariff
     */
    protected $tariff;

    /**
     * @var \Parishop\ORMWrappers\City\Entity
     */
    protected $cityEntity;

    /**
     * Tariffs constructor.
     * @param \Parishop\ORMWrappers\City\Entity $cityEntity
     */
    public function __construct(\Parishop\ORMWrappers\City\Entity $cityEntity)
    {
        $this->cityEntity = $cityEntity;
    }

    /**
     * @param int    $id        Идентификатор
     * @param string $countryId Идентификатор страны
     * @param string $regionId  Идентификатор региона
     * @param string $cityId    Идентификатор города
     * @param string $name      Название
     * @param float  $cost      Стоимость
     */
    public function addTariff($id, $countryId, $regionId, $cityId, $name, $cost)
    {
        $tariff                       = $this->buildTariff($id, $countryId, $regionId, $cityId, $name, $cost);
        $this->tariffs[$tariff->id()] = $tariff;
    }

    /**
     * @return Tariffs\Tariff[]
     */
    public function asArray()
    {
        return $this->tariffs;
    }

    public function calculate()
    {
        $this->tariff = null;

        return $this->get();
    }

    public function get($id = null)
    {
        if($id === null) {
            if($this->tariff === null) {
                foreach($this->asArray() as $tariff) {
                    if($tariff->access($this->cityEntity)) {
                        $this->setShopTariffId($tariff->id());
                        break;
                    }
                }
            }
            if($this->tariff === null) {
                $this->tariff = $this->buildTariff(0, null, null, null, 'Недоступно', null);
            }

            return $this->tariff;
        }
        if(array_key_exists($id, $this->tariffs)) {
            return $this->tariffs[$id];
        }
        throw new \Exception('Tariff ' . $id . ' does not exists');
    }

    /**
     * @param mixed $shopTariffId
     */
    public function setShopTariffId($shopTariffId)
    {
        $this->tariff = $this->get($shopTariffId);
    }

    /**
     * @param int    $id        Идентификатор
     * @param string $countryId Идентификатор страны
     * @param string $regionId  Идентификатор региона
     * @param string $cityId    Идентификатор города
     * @param string $name      Название
     * @param float  $cost      Стоимость
     * @return Tariffs\Tariff
     */
    protected function buildTariff($id, $countryId, $regionId, $cityId, $name, $cost)
    {
        return new \Meling\Cart\Points\Point\Deliveries\Delivery\Tariffs\Tariff(
            $id, $countryId, $regionId, $cityId, $name, $cost
        );
    }

}