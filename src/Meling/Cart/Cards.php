<?php
namespace Meling\Cart;

class Cards
{
    /**
     * @var Cards\Card[]
     */
    protected $cards;

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

    protected function buildCard($id = null, $name = '', $discount = 0, $rewards = 0)
    {
        return new \Meling\Cart\Cards\Card($id, $name, $discount, $rewards);
    }

    protected function requireCards(array $objects = array())
    {
        $cards = array();
        if(!$objects) {
            $cards[] = $this->buildCard(null, '', 0, $this->rewards);
        } else {
            foreach($objects as $object) {
                $cards[$object->name] = $this->buildCard($object->id, $object->name, $object->discount, $object->rewards);
            }
        }

        return $cards;
    }

}
