<?php
namespace Meling\Cart\Cards;

/**
 * Class Card
 * @package Meling\Cart\Cards
 */
class Card
{
    public $bonuses = 0;

    protected $id;

    protected $name;

    protected $discount;

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
        $this->id       = $id;
        $this->name     = $name;
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
