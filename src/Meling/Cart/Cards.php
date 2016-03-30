<?php
namespace Meling\Cart;

class Cards
{
    /**
     * @var Cards\Card[]
     */
    protected $cards;

    /**
     * Cards constructor.
     * @param array $objects
     */
    public function __construct(array $objects = array())
    {
        $this->cards = $this->requireCards($objects);
    }

    protected function buildCard($id = null, $name = '', $discount = 0, $rewards = 0)
    {
        return new \Meling\Cart\Cards\Card($id, $name, $discount, $rewards);
    }

    protected function requireCards(array $objects = array())
    {
        $cards = array();
        if(!$objects) {
            $cards[] = $this->buildCard();
        } else {
            foreach($objects as $object) {
                $cards[$object->name] = $this->buildCard($object->id, $object->name, $object->discount, $object->rewards);
            }
        }

        return $cards;
    }

}
