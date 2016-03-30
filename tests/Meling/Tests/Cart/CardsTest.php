<?php
namespace Meling\Tests\Cart;

/**
 * Клубные карты
 * 1. Массив Клубных карт
 * Class CardsTest
 * @package Meling\Tests\Cart
 */
class CardsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards
     */
    protected $cards;

    /**
     * @var object
     */
    protected $card1;

    public function setUp()
    {
        $this->card1 = (object)array(
            'id'       => 1,
            'name'     => 'test',
            'discount' => 10,
            'rewards'  => 1000,
        );
    }

    public function testAttributeCards()
    {
        $this->cards = new \Meling\Cart\Cards(array($this->card1), 1000);
        $card        = new \Meling\Cart\Cards\Card($this->card1->id, $this->card1->name, $this->card1->discount, $this->card1->rewards);
        $this->assertAttributeEquals(array($this->card1->name => $card), 'cards', $this->cards);
    }

    public function testAttributeCardsEmpty()
    {
        $this->cards = new \Meling\Cart\Cards();
        $card        = new \Meling\Cart\Cards\Card(null, '', 0, 0);
        $this->assertAttributeEquals(array($card), 'cards', $this->cards);
    }

    public function testAttributeRewards()
    {
        $this->cards = new \Meling\Cart\Cards(array($this->card1), 1000);
        $this->assertAttributeEquals(1000, 'rewards', $this->cards);
    }

    public function testAttributeRewardsEmpty()
    {
        $this->cards = new \Meling\Cart\Cards();
        $this->assertAttributeEquals(0, 'rewards', $this->cards);
    }

}
