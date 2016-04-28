<?php
namespace Meling\Cart\Tariffs;

/**
 * Тариф Доставки
 * Class Tariff
 * @package Meling\Cart\Tariffs
 */
class Tariff
{
    /**
     * @var mixed
     */
    private $id;

    /**
     * @var \PHPixie\ORM\Models\Type\Database\Implementation\Entity
     */
    private $shopTariff;

    /**
     * @var \PHPixie\ORM\Models\Type\Database\Implementation\Entity
     */
    private $city;

    /**
     * Tariff constructor.
     * @param mixed                                                   $id
     * @param \PHPixie\ORM\Models\Type\Database\Implementation\Entity $shopTariff
     * @param \PHPixie\ORM\Models\Type\Database\Implementation\Entity $city
     */
    public function __construct($id, $shopTariff, $city)
    {
        $this->id         = $id;
        $this->shopTariff = $shopTariff;
        $this->city       = $city;
    }

    public function cost()
    {
        if($this->city !== null) {
            if($this->city->id() === $this->shopTariff->cityId) {
                return $this->shopTariff->cost;
            }

            return false;
        }
        if($this->shopTariff->regionId !== null) {
            if($this->city->region()->id() === $this->shopTariff->regionId) {
                return $this->shopTariff->cost;
            }

            return false;
        }
        if($this->shopTariff->countryId !== null) {
            if($this->city->region()->countryId === $this->shopTariff->countryId) {
                return $this->shopTariff->cost;
            }

            return false;
        }

        return false;
    }

    public function fullName()
    {
        return $this->shopTariff->delivery()->getField('name') . ' (' . $this->name() . ')';
    }

    public function name()
    {
        return $this->cost() === false ? 'Недоступно' : $this->shopTariff->getField('name');
    }

}
