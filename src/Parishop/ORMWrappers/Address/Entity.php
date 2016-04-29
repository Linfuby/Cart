<?php
namespace Parishop\ORMWrappers\Address;

/**
 * Сущность Адреса покупателя
 * @property int                                                                   id
 * @property int                                                                   customerId
 * @property string                                                                lastname
 * @property string                                                                firstname
 * @property string                                                                middlename
 * @property string                                                                email
 * @property string                                                                phone
 * @property int                                                                   zip
 * @property int                                                                   countryId
 * @property int                                                                   regionId
 * @property int                                                                   cityId
 * @property string                                                                street
 * @property string                                                                home
 * @property string                                                                housing
 * @property string                                                                flat
 * @property string                                                                created
 * @property string                                                                modified
 ***********************************************************************************************************************
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $region
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $customers
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orders
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $cart
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \Parishop\ORMWrappers\Region\Entity region()
 * @method \Parishop\ORMWrappers\City\Entity city()
 * @method \Parishop\ORMWrappers\Customer\Entity[] customers()
 * @method \Parishop\ORMWrappers\Order\Entity[] orders()
 * @method \Parishop\ORMWrappers\Cart\Entity[] cart()
 ***********************************************************************************************************************
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    /**
     * Адрес строкой
     * @return string
     */
    public function __toString()
    {
        $address = array();
        if($this->zip) {
            $address[] = $this->zip;
        }
        if($this->country()) {
            $address[] = $this->country()->name();
        }
        $address[] = $this->regionName();
        $address[] = $this->cityName();

        return implode(', ', $address) . ' ' . $this->address();
    }

    public function address()
    {
        $address   = array();
        $address[] = $this->street;
        $address[] = $this->home;
        if($this->housing) {
            $address[] = $this->housing;
        }
        if($this->flat) {
            $address[] = $this->flat;
        }

        return implode(', ', $address);
    }

    /**
     * @return string
     */
    public function cityName()
    {
        return $this->city() ? $this->city()->name : null;
    }

    /**
     * @return string
     */
    public function countryName()
    {
        return $this->country() ? $this->country()->name : null;
    }

    public function fio()
    {
        $firstname  = $this->firstname ? ' ' . $this->firstname : '';
        $middlename = $this->middlename ? ' ' . $this->middlename : '';

        return $this->lastname . $firstname . $middlename;
    }

    /**
     * @return string
     */
    public function name()
    {
        return (string)$this;
    }

    /**
     * @return string
     */
    public function regionName()
    {
        return $this->region() ? $this->region()->name : null;
    }

}
