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
        $cart        = \Meling\Tests\CartTest::getCustomerOptionsCart();
        $this->cards = $cart->cards();
    }

    public function testAttributeSubject()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Subject', 'subject', $this->cards);
    }

    public function testMethodGet()
    {
        $card = new \Meling\Cart\Cards\Card(2, 2, 15, 1500);
        $this->assertEquals($card, $this->cards->get());
    }

    public function testMethodGetEmpty()
    {
        $card = new \Meling\Cart\Cards\Card();
        $this->cards->get(3);
        $this->assertEquals($card, $this->cards->get(3));
    }

    public function testMethodGetId()
    {
        $card = new \Meling\Cart\Cards\Card(1, 1, 5, 500);
        $this->assertEquals($card, $this->cards->get(1));
    }

}
