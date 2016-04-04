<?php
namespace Meling\Cart;

class Actions
{
    /**
     * @var \Meling\Cart\Products
     */
    protected $products;

    /**
     * @var \Meling\Cart\Wrappers\Action\Entity
     */
    protected $action;

    /**
     * @var \Meling\Cart\Wrappers\Action\Entity[]
     */
    protected $actions;

    /**
     * @var \Meling\Cart\Cards\Card
     */
    protected $card;

    /**
     * Actions constructor.
     * @param Products                 $products
     * @param Wrappers\Action\Entity   $action
     * @param Wrappers\Action\Entity[] $actions
     * @param Cards\Card               $card
     */
    public function __construct(\Meling\Cart\Products $products, array $actions, Cards\Card $card, $action = null)
    {
        $this->products = $products;
        $this->actions  = $actions;
        $this->card     = $card;
        $this->action   = $action;
    }

    public function asArray()
    {
        return $this->actions;
    }

    public function card()
    {
        return $this->card;
    }

    public function get()
    {
        return $this->buildAction($this->action);
    }

    public function products()
    {
        return $this->products;
    }

    /**
     * @param \Meling\Cart\Wrappers\Action\Entity $action
     * @return Actions\Assortment
     */
    protected function buildAction($action = null)
    {
        if($action !== null) {
            switch($action->actionTypeId) {
                case 53003:
                    return new Actions\Gift($this, $action);
                case 53004:
                    return new Actions\Discount($this, $action);
                case 53005:
                    return new Actions\Lots($this, $action);
                case 53006:
                    return new Actions\Birthday($this, $action);
                case 53007:
                    return new Actions\Marriage($this, $action);
                case 53008:
                    return new Actions\ProductBonusAssortment($this, $action);
                case 53009:
                    return new Actions\BonusProduct($this, $action);
                case 53010:
                    return new Actions\ProductBonus($this, $action);
                case 53011:
                    return new Actions\DiscountAmount($this, $action);
                case 53012:
                    return new Actions\GiftAmount($this, $action);
                case 53013:
                    return new Actions\GiftCount($this, $action);
                case 53014:
                    return new Actions\BonusProductAssortment($this, $action);
                default:
                    return new Actions\Assortment($this);
            }
        }

        return new Actions\Assortment($this);
    }

}
