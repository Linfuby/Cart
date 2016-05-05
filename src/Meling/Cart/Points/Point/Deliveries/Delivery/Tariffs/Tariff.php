<?php
namespace Meling\Cart\Points\Point\Deliveries\Delivery\Tariffs;

/**
 * Class Tariff
 * @package Meling\Cart\Points\Deliveries\Tariffs
 */
class Tariff
{
    /**
     * @var string
     */
    private $cityId;

    /**
     * @var float
     */
    private $cost;

    /**
     * @var string
     */
    private $countryId;

    /**
     * @var int
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var string
     */
    private $regionId;

    /**
     * Tariff constructor.
     * @param int    $id        Идентификатор
     * @param string $countryId Идентификатор страны
     * @param string $regionId  Идентификатор региона
     * @param string $cityId    Идентификатор города
     * @param string $name      Название
     * @param float  $cost      Стоимость
     */
    public function __construct($id, $countryId, $regionId, $cityId, $name, $cost)
    {
        $this->id        = $id;
        $this->countryId = $countryId;
        $this->regionId  = $regionId;
        $this->cityId    = $cityId;
        $this->name      = $name;
        $this->cost      = $cost;
    }

    /**
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @return bool
     */
    public function access($city)
    {
        if($this->cityId !== null) {
            if($city->id() === $this->cityId) {
                return true;
            }

            return false;
        }
        if($this->regionId !== null) {
            if($city->region()->id() === $this->regionId) {
                return true;
            }

            return false;
        }
        if($this->countryId !== null) {
            if($city->region()->countryId === $this->countryId) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function cost()
    {
        return $this->cost;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

}
