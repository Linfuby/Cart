<?php
namespace Meling\Tests\Cart\Cards;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    public function setUp()
    {
        $this->card = new \Meling\Cart\Cards\Card('1', 'Number', 10, 100);
    }

    public function testAttributeDiscount()
    {
        $this->assertAttributeInternalType('int', 'discount', $this->card);
    }

    public function testAttributeId()
    {
        $this->assertAttributeInternalType('string', 'id', $this->card);
    }

    public function testAttributeName()
    {
        $this->assertAttributeInternalType('string', 'name', $this->card);
    }

    public function testAttributeRewards()
    {
        $this->assertAttributeInternalType('int', 'rewards', $this->card);
    }

    public function testMethodDiscount()
    {
        $this->assertInternalType('int', $this->card->discount());
    }

    public function testMethodId()
    {
        $this->assertInternalType('string', $this->card->id());
    }

    public function testMethodName()
    {
        $this->assertInternalType('string', $this->card->name());
    }

    public function testMethodRewards()
    {
        $this->assertInternalType('int', $this->card->rewards());
    }

}
