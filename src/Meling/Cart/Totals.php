<?php
namespace Meling\Cart;

/**
 * Class Totals
 * @package Meling\Cart
 */
class Totals
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var \Meling\Tests\ORMWrappers\Entities\AllAction
     */
    protected $action;

    /**
     * @var Cards\Card
     */
    protected $card;

    /**
     * @var array
     */
    protected $instances = array();

    /**
     * Totals constructor.
     * @param Products                                     $products
     * @param \Meling\Tests\ORMWrappers\Entities\AllAction $action
     * @param Cards\Card                                   $card
     */
    public function __construct(Products $products, $action = null, Cards\Card $card)
    {
        $this->products = $products;
        $this->action   = $action;
        $this->card     = $card;
    }

    /**
     * @return Totals\Action
     * @throws \Exception
     */
    public function action()
    {
        return $this->instance('action');
    }

    /**
     * @return Totals\Amount
     * @throws \Exception
     */
    public function amount()
    {
        return $this->instance('amount');
    }

    /**
     * @return Totals\Bonuses
     * @throws \Exception
     */
    public function bonuses()
    {
        return $this->instance('bonuses');
    }

    /**
     * @return Totals\Card
     * @throws \Exception
     */
    public function card()
    {
        return $this->instance('card');
    }

    /**
     * @return Totals\Shipping
     * @throws \Exception
     */
    public function shipping()
    {
        return $this->instance('shipping');
    }

    /**
     * @return Totals\Total
     * @throws \Exception
     */
    public function total()
    {
        return $this->instance('total');
    }

    protected function buildAction()
    {
        $this->action->setTotals($this);

        return new Totals\Action($this, $this->products, $this->action);
    }

    protected function buildAmount()
    {
        return new Totals\Amount($this->products, $this->certificates);
    }

    protected function buildBonuses()
    {
        return new Totals\Bonuses($this, $this->actionsAfter);
    }

    protected function buildCard()
    {
        return new Totals\Card();
    }

    protected function buildShipping()
    {
        $shipping = new Totals\Shipping($this->point, $this->orders);
        $shipping->setAmount($this->amount()->total());

        return $shipping;
    }

    protected function buildTotal()
    {
        return new Totals\Total($this);
    }

    protected function instance($name)
    {
        if(!array_key_exists($name, $this->instances)) {
            $method                 = 'build' . ucfirst($name);
            $this->instances[$name] = $this->$method();
        }

        return $this->instances[$name];
    }
}
