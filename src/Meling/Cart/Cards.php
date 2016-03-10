<?php
namespace Meling\Cart;

class Cards
{
    /**
     * @var Providers\Subject
     */
    protected $subject;

    protected $cards;

    protected $card;

    /**
     * Cards constructor.
     * @param Providers\Subject $subject
     */
    public function __construct(Providers\Subject $subject)
    {
        $this->subject = $subject;
    }

    public function get($id = null)
    {
        $this->requireCards();
        if($id === null) {
            return $this->card;
        }
        if(array_key_exists($id, $this->cards)) {
            return $this->cards[$id];
        }

        return new Cards\Card();
    }

    protected function requireCards()
    {
        if($this->cards !== null) {
            return;
        }
        $cards = array();
        foreach($this->subject->cards() as $card) {
            $discount = 0;
            $card     = new Cards\Card($card->id, $card->name, $card->discount, $card->rewards);
            if($card->discount() >= $discount) {
                $this->card = $card;
            }
            $cards[$card->id()] = $card;
        }
        $this->cards = $cards;
    }

}
