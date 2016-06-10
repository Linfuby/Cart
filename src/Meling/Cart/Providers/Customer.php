<?php
namespace Meling\Cart\Providers;

/**
 * Class Customer
 * @package Meling\Cart\Providers
 */
class Customer extends Provider
{
    /**
     * @var \Parishop\ORMWrappers\Customer\Entity
     */
    protected $customer;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     * @param mixed                 $customerId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $customerId)
    {
        parent::__construct($orm, $context);
        $this->customer = $this->orm->query('customer')->in($customerId)->findOne();
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
        if($fieldBirthdayUse) {
            if(date('Y') == date_create_from_format('d.m.Y', $fieldBirthdayUse)->format('Y')) {
                return null;
            }
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
        if($fieldMarriageUse) {
            if(date('Y') == date_create_from_format('d.m.Y', $fieldMarriageUse)->format('Y')) {
                return null;
            }
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

}
