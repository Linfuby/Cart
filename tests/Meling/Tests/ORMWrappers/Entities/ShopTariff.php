<?php
namespace Meling\Tests\ORMWrappers\Entities;

/**
 * Class ShopTariff
 * @method \Meling\Tests\ORMWrappers\Entities\Delivery delivery()
 * @package Meling\Tests\ORMWrappers\Entities
 */
class ShopTariff extends \Meling\Tests\ORMWrappers\Entity
{
    /**
     * @param \Meling\Tests\ORMWrappers\Entities\City $city
     * @return bool
     */
    public function access($city)
    {
        if($cityId = $this->getRequiredField('cityId')) {
            if($city->id() === $cityId) {
                return true;
            }

            return false;
        }
        if($regionId = $this->getRequiredField('regionId')) {
            if($city->region()->id() === $regionId) {
                return true;
            }

            return false;
        }
        if($countryId = $this->getRequiredField('countryId')) {
            if($city->region()->getRequiredField('countryId') === $countryId) {
                return true;
            }

            return false;
        }

        return false;
    }

    public function calculate()
    {
        return $this->getRequiredField('cost');
    }

}
