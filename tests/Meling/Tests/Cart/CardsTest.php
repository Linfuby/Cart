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
        $this->cards = new \Meling\Cart\Cards(\Meling\Tests\Cart\Providers\Subjects\CustomerTest::getSubject());
    }

    public function testAttributeSubject()
    {
        $this->assertAttributeInstanceOf('\Meling\Cart\Providers\Subject', 'subject', $this->cards);
    }

    public function testMethodGet()
    {
        $card = new \Meling\Cart\Cards\Card(95361854001, '13373048', 15, 442);
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
        $card = new \Meling\Cart\Cards\Card(-42148309, '180199', 8, 0);
        $this->assertEquals($card, $this->cards->get(-42148309));
    }

}
