<?php
namespace Meling\Cart\Orders\Order\Actions;

class Cards
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Cards\Card[]
     */
    protected $cards;

    /**
     * @var Cards\Card
     */
    protected $card;

    /**
     * Cards constructor.
     * @param \Meling\Cart\Providers\Provider $provider
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @return Cards\Card[]
     */
    public function asArray()
    {
        $this->requireCards();

        return $this->cards;
    }

    /**
     * @param string $id
     * @return Cards\Card
     */
    public function get($id = null)
    {
        $this->requireCards();
        if($id !== null) {
            if(array_key_exists($id, $this->cards)) {
                return $this->cards[$id];
            }
        }

        return $this->card;
    }

    protected function buildCard($id = null, $name = null, $discount = null, $rewards = null)
    {
        return new Cards\Card($id, $name, $discount, $rewards);
    }

    protected function requireCards()
    {
        if($this->cards !== null) {
            return;
        }
        $cards = array();
        foreach($this->provider->cards() as $card) {
            $discount = 0;
            $card     = $this->buildCard($card->id, $card->name, $card->discount, $card->rewards);
            if($card->discount() >= $discount) {
                $this->card = $card;
            }
            $cards[$card->id()] = $card;
        }
        if($this->card === null) {
            $this->card = $this->buildCard();
        }
        $this->cards = $cards;
    }
}
