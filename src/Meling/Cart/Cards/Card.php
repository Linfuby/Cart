<?php
namespace Meling\Cart\Cards;

/**
 * Class Card
 * @package Meling\Cart\Cards
 */
class Card implements Implementation
{
    /**
     * Количество накопленных бонусов на Клубной карте
     * @var int
     */
    public $bonuses = 0;

    /**
     * Идентификатор Клубной карты
     * @var string
     */
    protected $id;

    /**
     * Название Клубной карты
     * @var string
     */
    protected $name;

    /**
     * Скидка по Клубной карте
     * @var int
     */
    protected $discount;

    /**
     * Количество бонусов на Клубной карте
     * @var int
     */
    protected $rewards;

    /**
     * Card constructor.
     * @param string $id
     * @param string $name
     * @param int    $discount
     * @param int    $rewards
     */
    public function __construct($id = null, $name = null, $discount = null, $rewards = null)
    {
        $this->id       = (string)$id;
        $this->name     = (string)$name;
        $this->discount = (int)$discount;
        $this->rewards  = (int)$rewards;
    }

    public function discount()
    {
        return $this->discount;
    }

    public function id()
    {
        return $this->id;
    }

    public function name()
    {
        return $this->name;
    }

    public function rewards()
    {
        return $this->rewards;
    }

}
