<?php
namespace Meling\Cart;

/**
 * Класс Покупателя
 * Class Customer
 * @package Meling\Cart
 */
class Customer
{
    /**
     * Клубные карты Покупателя
     * @var Cards
     */
    private $cards;

    /**
     * E-mail Покупателя
     * @var string
     */
    private $email;

    /**
     * Имя Покупателя
     * @var string
     */
    private $firstname;

    /**
     * Идентификатор Покупателя
     * @var string
     */
    private $id;

    /**
     * Фамилия Покупателя
     * @var string
     */
    private $lastname;

    /**
     * Отчество Покупателя
     * @var string
     */
    private $middlename;

    /**
     * Телефон Покупателя
     * @var string
     */
    private $phone;

    /**
     * @param string             $id         Идентификатор
     * @param string             $lastname   Фамилия
     * @param string             $firstname  Имя
     * @param string             $middlename Отчество
     * @param string             $email      E-mail
     * @param string             $phone      Телефон
     * @param \Meling\Cart\Cards $cards      Клубные Карты
     */
    public function __construct($id, $lastname, $firstname, $middlename, $email, $phone, $cards)
    {
        $this->id         = $id;
        $this->lastname   = $lastname;
        $this->firstname  = $firstname;
        $this->middlename = $middlename;
        $this->email      = $email;
        $this->phone      = $phone;
        $this->cards      = $cards;
    }

    /**
     * @return Cards
     */
    public function cards()
    {
        return $this->cards;
    }

    /**
     * @return string
     */
    public function email()
    {
        return $this->email;
    }

    /**
     * @return string
     */
    public function firstname()
    {
        return $this->firstname;
    }

    /**
     * @return string
     */
    public function fullName()
    {
        return implode(' ', array_diff(array($this->lastname, $this->firstname, $this->middlename), array(null, '')));
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function lastname()
    {
        return $this->lastname;
    }

    /**
     * @return string
     */
    public function middlename()
    {
        return $this->middlename;
    }

    /**
     * @return string
     */
    public function phone()
    {
        return $this->phone;
    }

}
