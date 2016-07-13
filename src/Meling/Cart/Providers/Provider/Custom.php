<?php
namespace Meling\Cart\Providers\Provider;

/**
 * Class Custom
 * @package Meling\Cart\Providers\Provider
 */
class Custom extends \Meling\Cart\Providers\Provider
{
    /**
     * Customer constructor.
     * @param \PHPixie\ORM                  $orm
     * @param mixed                         $cityId
     * @param mixed                         $actionId
     */
    public function __construct(\PHPixie\ORM $orm, $cityId = null, $actionId = null)
    {
        parent::__construct($orm, $cityId, $actionId);
    }

    /**
     * @return \DateTime
     */
    public function actionsBirthday()
    {
        return null;
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
        return null;
    }

    public function addresses()
    {
        if($this->addresses === null) {
            $this->addresses = new \Meling\Cart\Addresses(array());
        }

        return $this->addresses;
    }

    /**
     * @return \Meling\Cart\Cards
     */
    public function cards()
    {
        if($this->cards === null) {
            $this->cards = new \Meling\Cart\Cards(array());
        }

        return $this->cards;
    }

    public function customer()
    {
        return null;
    }

    public function email()
    {
        return null;
    }

    public function firstname()
    {
        return null;
    }

    public function id()
    {
        return null;
    }

    public function lastname()
    {
        return null;
    }

    public function middlename()
    {
        return null;
    }

    /**
     * Телефон Покупателя
     * @return string
     */
    public function phone()
    {
        return null;
    }

    public function session()
    {
        return $this->session;
    }

    protected function buildProducts()
    {
        return new \Meling\Cart\Products\Session($this, $this->session());
    }


}
