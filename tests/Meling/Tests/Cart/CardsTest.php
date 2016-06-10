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
        $this->cards = new \Meling\Cart\Cards();
    }

    public function testAttributeBuilder()
    {
        $this->assertAttributeInternalType('array', 'entities', $this->cards);
    }

    public function testMethodAsArray()
    {
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
