<?php
namespace Meling\Cart\Cards;

class Card
{
    protected $id;

    protected $number;

    protected $discount;

    protected $rewards;

    /**
     * Card constructor.
     * @param string $id
     * @param string $number
     * @param int    $discount
     * @param int    $rewards
     */
    public function __construct($id = null, $number = null, $discount = null, $rewards = null)
    {
        $this->id       = $id;
        $this->number   = $number;
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

    public function number()
    {
        return $this->number;
    }

    public function rewards()
    {
        return $this->rewards;
    }
}