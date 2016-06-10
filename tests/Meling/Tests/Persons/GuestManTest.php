<?php
namespace Meling\Tests\Persons;

class GuestManTest extends \PHPUnit_Framework_TestCase
{
    protected $cart;

    public function setUp()
    {
        $guest = new \Meling\Cart\Providers\Guest();
        $this->cart = new \Meling\Cart($guest);
    }

}
