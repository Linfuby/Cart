<?php
/**
 * Created by PhpStorm.
 * User: manager
 * Date: 29.03.2016
 * Time: 13:24
 */

namespace Meling\Cart;

class CardsTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var \Meling\Cart\Cards
     */
    protected $cards;

    public function testAttributeCards()
    {
        $this->cards = new \Meling\Cart\Cards(
            array(
                (object)array(
                    'id'       => 1,
                    'name'     => 'test',
                    'discount' => 10,
                    'rewards'  => 1000,
                ),
            )
        );
        $this->assertAttributeInternalType('array', 'cards', $this->cards);
    }

    public function testAttributeCardsEmpty()
    {
        $this->cards = new \Meling\Cart\Cards();
        $this->assertAttributeInternalType('array', 'cards', $this->cards);
    }

}
