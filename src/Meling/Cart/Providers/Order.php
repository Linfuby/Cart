<?php
namespace Meling\Cart\Providers;

/**
 * Class Order
 * @package Meling\Cart\Providers
 */
class Order extends Provider
{
    /**
     * @var \Parishop\ORMWrappers\Order\Entity
     */
    protected $order;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     * @param mixed                 $orderId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $orderId)
    {
        parent::__construct($orm, $context);
        $this->order = $this->orm->query('order')->in($orderId)->findOne();
    }

    /**
     * @return \DateTime
     */
    public function actionsBirthday()
    {
        $fieldBirthday = $this->order->customer()->getRequiredField('birthday');
        if(!$fieldBirthday || $fieldBirthday == '0000-00-00') {
            return null;
        }
        $fieldBirthdayUse = $this->order->customer()->getRequiredField('birthday_use');
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
        $fieldMarriage = $this->order->customer()->getRequiredField('marriage');
        if(!$fieldMarriage || $fieldMarriage == '0000-00-00') {
            return null;
        }
        $fieldMarriageUse = $this->order->customer()->getRequiredField('marriage_use');
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
            $this->addresses = new \Meling\Cart\Addresses($this->order->customer()->addresses()->asArray());
        }

        return $this->addresses;
    }

    public function cards()
    {
        if($this->cards === null) {
            $this->cards = new \Meling\Cart\Cards($this->order->customer()->customerCards()->asArray());
        }

        return $this->cards;
    }

    public function city($cityId = null)
    {
        return $this->order->city();
    }

    public function customer()
    {
        return $this->order->customer();
    }

    public function email()
    {
        return $this->order->getRequiredField('email');
    }

    public function firstname()
    {
        return $this->order->getRequiredField('firstname');
    }

    public function id()
    {
        return $this->order->id();
    }

    public function lastname()
    {
        return $this->order->getRequiredField('lastname');
    }

    public function middlename()
    {
        return $this->order->getRequiredField('middlename');
    }

    public function order()
    {
        return $this->order;
    }

    public function phone()
    {
        return $this->order->getRequiredField('phone');
    }

    public function shop()
    {
        return $this->order->shop();
    }

}
