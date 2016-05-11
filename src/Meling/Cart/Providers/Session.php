<?php
namespace Meling\Cart\Providers;

/**
 * Class Session
 * @package Meling\Cart\Providers
 */
class Session extends Provider
{
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
        if($this->addresses = null) {
            $this->addresses = new \Meling\Cart\Addresses(array());
        }

        return $this->addresses;
    }

    /**
     * @return \Meling\Cart\Cards
     */
    public function cards()
    {
        if($this->cards = null) {
            $this->cards = new \Meling\Cart\Cards(array());
        }

        return $this->cards;
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

    public function phone()
    {
        return null;
    }

}
