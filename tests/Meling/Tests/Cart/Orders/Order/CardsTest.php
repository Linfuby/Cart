<?php
namespace Meling\Tests\Cart\Orders\Order;

class CardsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Orders\Order\Actions\Cards
     */
    protected $cards;

    public function setUp()
    {
        $provider    = \Meling\Tests\Cart\Providers\CustomerTest::getCustomer();
        $this->cards = new \Meling\Cart\Orders\Order\Actions\Cards($provider);
    }

    public function testAttributeSubject()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Provider', 'provider', $this->cards);
    }

    public function testMethodGet()
    {
        $card = new \Meling\Cart\Orders\Order\Actions\Cards\Card(95361854001, '13373048', 15, 442);
        $this->assertEquals($card, $this->cards->get());
    }

    public function testMethodGetEmpty()
    {
        $card = new \Meling\Cart\Orders\Order\Actions\Cards\Card(95361854001, '13373048', 15, 442);
        $this->assertEquals($card, $this->cards->get(3));
    }

    public function testMethodGetId()
    {
        $card = new \Meling\Cart\Orders\Order\Actions\Cards\Card(-42148309, '180199', 8, 0);
        $this->assertEquals($card, $this->cards->get(-42148309));
    }

}
