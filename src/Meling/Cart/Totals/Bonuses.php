<?php
namespace Meling\Cart\Totals;

class Bonuses
{
    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    /**
     * @var int
     */
    protected $total;

    /**
     * Bonuses constructor.
     * @param \Meling\Cart\Cards\Card $card
     */
    public function __construct(\Meling\Cart\Cards\Card $card)
    {
        $this->card = $card;
    }

    public function name()
    {
        return 'Начислено бонусов';
    }

    public function total()
    {
        return $this->card->bonuses;
    }

}
