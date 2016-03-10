<?php
namespace Meling\Cart\Actions\Types;

/**
 * Интерфейс Типа акции
 * Interface Type
 * @package Meling\Cart\Actions\Types
 */
abstract class Type
{
    /**
     * @var \Meling\Cart\Totals
     */
    protected $totals;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $action;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;


    /**
     * Type constructor.
     * @param \Meling\Cart\Totals                        $totals
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $action
     * @param \Meling\Cart\Cards\Card                    $card
     */
    public function __construct($totals, $action = null, $card = null)
    {
        $this->totals = $totals;
        $this->action = $action;
        $this->card   = $card;
    }

    public function name()
    {
        if($this->action) {
            return $this->action->getField('name');
        }

        return null;
    }

    public function roundDiscount($discountAction = 0, $discountCard = 0)
    {
        $discountAction = $discountAction < 0 ? 0 : $discountAction;
        $discountAction = $discountAction > 50 ? 50 : $discountAction;
        $discountCard   = $discountCard < 0 ? 0 : $discountCard;
        $discountCard   = $discountCard > 50 ? 50 : $discountCard;

        return $discountAction + $discountCard;
    }

    public function total()
    {
        if($this->total === null) {
            $this->total = 0;
            $this->totalDiscount();
        }

        return $this->total;
    }

    public abstract function totalDiscount();
}
