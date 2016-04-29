<?php
namespace Meling\Tests\Cart;

class CardsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards
     */
    protected $cards;

    public function setUp()
    {
        $orm = new \Meling\Tests\ORM();
        /** @var \Meling\Tests\ORMWrappers\Entities\Customer $user */
        $user        = $orm->query('customer')->in(1)->findOne();
        $this->cards = new \Meling\Cart\Cards($user->customerCards());
        $orm->disconnect();
    }

    public function testMethodAsArray()
    {
        $this->assertInternalType('array', $this->cards->asArray());
    }

    public function testMethodAsArrayEmpty()
    {
        $this->cards = new \Meling\Cart\Cards(array());
        $this->assertInternalType('array', $this->cards->asArray());
    }

    public function testMethodGet()
    {
        foreach($this->cards->asArray() as $card) {
            $this->assertInstanceOf('\Meling\Cart\Cards\Card', $this->cards->get($card->id()));
        }
    }

    public function testMethodGetDefault()
    {
        $this->assertInstanceOf('\Meling\Cart\Cards\Card', $this->cards->get());
    }

}
