<?php
namespace Meling\Cart;

class Cards
{
    /**
     * @var Cards\Card[]
     */
    protected $cards;

    /**
     * @var Cards\Card
     */
    protected $card;

    /**
     * @var int
     */
    private $rewards;

    /**
     * Cards constructor.
     * @param array $objects
     * @param int   $rewards
     */
    public function __construct(array $objects = array(), $rewards = 0)
    {
        $this->cards   = $this->requireCards($objects);
        $this->rewards = $rewards;
    }

    public function getDefault()
    {
        return $this->card;
    }

    protected function buildCard($id = null, $name = '', $discount = 0, $rewards = 0)
    {
        return new \Meling\Cart\Cards\Card($id, $name, $discount, $rewards);
    }

    protected function requireCards(array $objects = array())
    {
        $cards = array();
        if(!$objects) {
            $this->card = $this->buildCard(null, '', 0, $this->rewards);
            $cards[]    = $this->card;
        } else {
            foreach($objects as $object) {
                $card                 = $this->buildCard($object->id, $object->name, $object->discount, $object->rewards);
                $cards[$object->name] = $card;
                if($this->card === null) {
                    $this->card = $card;
                }
                if($this->card->discount() < $object->discount) {
                    $this->card = $card;
                } elseif($this->card->discount() == $object->discount) {
                    if($this->card->rewards() < $object->rewards) {
                        $this->card = $card;
                    }
                }
            }
        }

        return $cards;
    }

}
