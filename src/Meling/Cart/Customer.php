<?php
namespace Meling\Cart;

/**
 * Class Customer
 * @package Meling\Cart
 */
class Customer
{
    /**
     * @var Cards
     */
    private $cards;

    /**
     * @var string
     */
    private $email;

    /**
     * @var string
     */
    private $firstname;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $lastname;

    /**
     * @var string
     */
    private $middlename;

    /**
     * @var string
     */
    private $phone;

    /**
     * @param mixed              $id
     * @param string             $lastname
     * @param string             $firstname
     * @param string             $middlename
     * @param string             $email
     * @param string             $phone
     * @param \Meling\Cart\Cards $cards
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

    public function cards()
    {
        return $this->cards;
    }

    public function email()
    {
        return $this->email;
    }

    public function firstname()
    {
        return $this->firstname;
    }

    public function fullName()
    {
        return implode(' ', array_diff(array($this->lastname, $this->firstname, $this->middlename), array(null, '')));
    }

    public function id()
    {
        return $this->id;
    }

    public function lastname()
    {
        return $this->lastname;
    }

    public function middlename()
    {
        return $this->middlename;
    }

    public function phone()
    {
        return $this->phone;
    }

}
