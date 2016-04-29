<?php
namespace Parishop\ORMWrappers\ShopTariff;

/**
 * Class Entity
 * @property int                                                                   id
 * @property string                                                                shopId
 * @property int                                                                   deliveryId
 * @property int                                                                   countryId
 * @property int                                                                   regionId
 * @property int                                                                   cityId
 * @property string                                                                name
 * @property string                                                                description
 * @property int                                                                   cost
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $delivery
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $region
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\ManyToMany\Property\Entity            $payments
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @method \Parishop\ORMWrappers\Delivery\Entity delivery()
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \Parishop\ORMWrappers\Region\Entity region()
 * @method \Parishop\ORMWrappers\City\Entity city()
 * @method \Parishop\ORMWrappers\Payment\Entity[] payments()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{

    public function calculate($city)
    {
        if($this->success($city)) {
            return $this->cost;
        }

        return null;
    }

    public function cityName()
    {
        return $this->city() ? $this->city()->name() : null;
    }

    public function countryName()
    {
        return $this->country() ? $this->country()->name() : null;
    }

    public function regionName()
    {
        return $this->region() ? $this->region()->name() : null;
    }

    /**
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @return null
     */
    public function success($city)
    {
        if($this->cityId) {
            if($this->cityId == $city->id()) {
                return $this->cost;
            }
        } elseif($this->regionId) {
            if($this->regionId == $city->region()->id()) {
                return $this->cost;
            }
        } elseif($this->countryId) {
            if($this->countryId == $city->region()->country()->id()) {
                return $this->cost;
            }
        }

        return null;
    }
}
