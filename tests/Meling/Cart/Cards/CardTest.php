<?php
namespace Meling\Cart\Cards;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    public function setUp()
    {
        $this->card = new \Meling\Cart\Cards\Card(1, 'Test', 10, 1000);
    }

    public function testAttributeDiscount()
    {
        $this->assertAttributeEquals(10, 'discount', $this->card);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->card);
    }

    public function testAttributeName()
    {
        $this->assertAttributeEquals('Test', 'name', $this->card);
    }

    public function testAttributeRewards()
    {
        $this->assertAttributeEquals(1000, 'rewards', $this->card);
    }

    public function testMethodDiscount()
    {
        $this->assertEquals(10, $this->card->discount());
    }

    public function testMethodId()
    {
        $this->assertEquals(1, $this->card->id());
    }

    public function testMethodName()
    {
        $this->assertEquals('Test', $this->card->name());
    }

    public function testMethodRewards()
    {
        $this->assertEquals(1000, $this->card->rewards());
    }


}
