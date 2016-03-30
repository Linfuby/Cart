<?php
namespace Meling\Tests\Cart\Cards;

/**
 * Клубная карта
 * 1. Идентификатор
 * 2. Название
 * 3. Размер скидки
 * 4. Количество бонусов
 * Class CardTest
 * @package Meling\Tests\Cart\Cards
 */
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

    /**
     * Проверка Размера скидки в конструкторе
     */
    public function testAttributeDiscount()
    {
        $this->assertAttributeEquals(10, 'discount', $this->card);
    }

    /**
     * Проверка Идентификатора в конструкторе
     */
    public function testAttributeId()
    {
        $this->assertAttributeEquals(1, 'id', $this->card);
    }

    /**
     * Проверка Названия в конструкторе
     */
    public function testAttributeName()
    {
        $this->assertAttributeEquals('Test', 'name', $this->card);
    }

    /**
     * Проверка Количества бонусов в конструкторе
     */
    public function testAttributeRewards()
    {
        $this->assertAttributeEquals(1000, 'rewards', $this->card);
    }

    /**
     * Проверка Размера скидки в методе
     */
    public function testMethodDiscount()
    {
        $this->assertEquals(10, $this->card->discount());
    }

    /**
     * Проверка Идентификатора в методе
     */
    public function testMethodId()
    {
        $this->assertEquals(1, $this->card->id());
    }

    /**
     * Проверка Названия в методе
     */
    public function testMethodName()
    {
        $this->assertEquals('Test', $this->card->name());
    }

    /**
     * Проверка Количества бонусов в методе
     */
    public function testMethodRewards()
    {
        $this->assertEquals(1000, $this->card->rewards());
    }

}
