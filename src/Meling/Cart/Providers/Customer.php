<?php
namespace Meling\Cart\Providers;

/**
 * Class Customer
 * @package Meling\Cart\Providers
 */
class Customer
{
    public $id;

    public $lastName;

    public $firstName;

    public $middleName;

    public $email;

    public $phone;

    public $birthday;

    public $marriage;

    /**
     * Customer constructor.
     * @param $id
     * @param $lastName
     * @param $firstName
     * @param $middleName
     * @param $email
     * @param $phone
     * @param $birthday
     * @param $marriage
     */
    public function __construct($id = null, $lastName = null, $firstName = null, $middleName = null, $email = null, $phone = null, $birthday = null, $marriage = null)
    {
        $this->id         = $id;
        $this->lastName   = $lastName;
        $this->firstName  = $firstName;
        $this->middleName = $middleName;
        $this->email      = $email;
        $this->phone      = $phone;
        $this->birthday   = $birthday;
        $this->marriage   = $marriage;
    }

}
