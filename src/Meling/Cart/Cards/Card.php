<?php
namespace Meling\Cart\Cards;

class Card
{
    /**
     * @var int
     */
    private $discount;

    /**
     * @var mixed
     */
    private $id;

    /**
     * @var string
     */
    private $name;

    /**
     * @var int
     */
    private $rewards;

    /**
     * @param mixed  $id
     * @param string $name
     * @param int    $discount
     * @param int    $rewards
     */
    public function __construct($id, $name, $discount, $rewards)
    {
        $this->id       = $id;
        $this->name     = $name;
        $this->discount = $discount;
        $this->rewards  = $rewards;
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
