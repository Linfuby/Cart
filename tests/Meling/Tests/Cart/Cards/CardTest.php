<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 04.03.2016
 * Time: 17:31
 */

namespace Meling\Tests\Cart\Cards;

class CardTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    public function setUp()
    {
        $cart       = \Meling\Tests\CartTest::getCustomerOptionsCart();
        $this->card = $cart->cards()->get();
    }

    public function testAttributeDiscount()
    {
        $this->assertAttributeEquals(15, 'discount', $this->card);
    }

    public function testAttributeId()
    {
        $this->assertAttributeEquals(2, 'id', $this->card);
    }

    public function testAttributeNumber()
    {
        $this->assertAttributeEquals('20', 'number', $this->card);
    }

    public function testAttributeRewards()
    {
        $this->assertAttributeEquals(1500, 'rewards', $this->card);
    }

    public function testMethodDiscount()
    {
        $this->assertEquals(15, $this->card->discount());
    }

    public function testMethodId()
    {
        $this->assertEquals(2, $this->card->id());
    }

    public function testMethodNumber()
    {
        $this->assertEquals('20', $this->card->number());
    }

    public function testMethodRewards()
    {
        $this->assertEquals(1500, $this->card->rewards());
    }
}
