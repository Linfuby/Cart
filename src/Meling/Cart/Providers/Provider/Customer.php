<?php
namespace Meling\Cart\Providers\Provider;

/**
 * Class Customer
 * @package Meling\Cart\Providers\Provider
 */
class Customer extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Parishop\ORMWrappers\Customer\Entity
     */
    protected $customer;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM                          $orm
     * @param \Parishop\ORMWrappers\Customer\Entity $customer
     * @param mixed                                 $cityId
     * @param mixed                                 $actionId
     */
    public function __construct(\PHPixie\ORM $orm, $customer, $cityId, $actionId)
    {
        parent::__construct($orm, $cityId, $actionId);
        $this->customer = $customer;
    }

    /**
     * @return \DateTime
     */
    public function actionsBirthday()
    {
        $fieldBirthday = $this->customer->getRequiredField('birthday');
        if(!$fieldBirthday || $fieldBirthday == '0000-00-00') {
            return null;
        }
        $fieldBirthdayUse = $this->customer->getRequiredField('birthday_use');
        if($fieldBirthdayUse && $fieldBirthdayUse != '0000-00-00') {
            if(date('Y') == date_create_from_format('Y-m-d', $fieldBirthdayUse)->format('Y')) {
                return null;
            }

            return new \DateTime($fieldBirthday);
        }

        return new \DateTime($fieldBirthday);
    }

    /**
     * @return \DateTime
     */
    public function actionsDate()
    {
        return new \DateTime();
    }

    /**
     * @return \DateTime
     */
    public function actionsMarriage()
    {
        $fieldMarriage = $this->customer->getRequiredField('marriage');
        if(!$fieldMarriage || $fieldMarriage == '0000-00-00') {
            return null;
        }
        $fieldMarriageUse = $this->customer->getRequiredField('marriage_use');
        if($fieldMarriageUse && $fieldMarriageUse != '0000-00-00') {
            if(date('Y') == date_create_from_format('Y-m-d', $fieldMarriageUse)->format('Y')) {
                return null;
            }

            return new \DateTime($fieldMarriage);
        }

        return new \DateTime($fieldMarriage);

    }

    public function addresses()
    {
        if($this->addresses === null) {
            $this->addresses = new \Meling\Cart\Addresses($this->customer->addresses()->asArray(false, 'id'));
        }

        return $this->addresses;
    }

    public function cards()
    {
        if($this->cards === null) {
            $this->cards = new \Meling\Cart\Cards($this->customer->customerCards()->asArray(false, 'id'));
        }

        return $this->cards;
    }

    public function customer()
    {
        return $this->customer;
    }

    public function email()
    {
        return $this->customer->getRequiredField('email');
    }

    public function firstname()
    {
        return $this->customer->getRequiredField('firstname');
    }

    public function id()
    {
        return $this->customer->id();
    }

    public function lastname()
    {
        return $this->customer->getRequiredField('lastname');
    }

    public function middlename()
    {
        return $this->customer->getRequiredField('middlename');
    }

    public function phone()
    {
        return $this->customer->getRequiredField('phone');
    }

    protected function buildProducts()
    {
        return new \Meling\Cart\Products\Customer($this, $this->customer());
    }

}
