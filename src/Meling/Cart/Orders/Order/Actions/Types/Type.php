<?php
namespace Meling\Cart\Orders\Order\Actions\Types;

/**
 * Интерфейс Типа акции
 * Interface Type
 * @package Meling\Cart\Orders\Order\Actions\Types
 */
abstract class Type
{
    /**
     * @var \Meling\Cart\Orders\Order\Products
     */
    protected $products;

    /**
     * @var \PHPixie\ORM\Models\Type\Database\Entity
     */
    protected $action;

    /**
     * @var int
     */
    protected $total;

    /**
     * @var \Meling\Cart\Orders\Order\Actions\Cards\Card
     */
    protected $card;


    /**
     * Type constructor.
     * @param \Meling\Cart\Orders\Order\Products           $products
     * @param \PHPixie\ORM\Models\Type\Database\Entity     $action
     * @param \Meling\Cart\Orders\Order\Actions\Cards\Card $card
     */
    public function __construct($products, $action = null, $card = null)
    {
        $this->products = $products;
        $this->action   = $action;
        if($card === null) {
            $card = new \Meling\Cart\Orders\Order\Actions\Cards\Card();
        }
        $this->card = $card;
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

    /**
     * @param bool $special
     * @return bool
     */
    protected function accessSpecial($special = false)
    {
        // Только для товаров без спец. цены
        if($this->action->getField('price_flag') == 0 && $special) {
            return false;
        }
        // Только для товаров со спец. ценой
        if($this->action->getField('price_flag') == 2 && !$special) {
            return false;
        }

        return true;
    }
}
