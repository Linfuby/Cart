<?php
namespace Meling\Cart;

/**
 * Class Totals
 * @package Meling\Cart
 */
class Totals
{
    /**
     * @var Products\Product[]
     */
    protected $products;

    /**
     * @var Points
     */
    protected $points;

    /**
     * @var Actions
     */
    protected $actionsAfter;

    /**
     * @var \Parishop\ORMWrappers\Action\Entity
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
     * @param Products\Product[]                  $products
     * @param Points                              $points
     * @param Actions                             $actionsAfter
     * @param \Parishop\ORMWrappers\Action\Entity $action
     * @param Cards\Card                          $card
     */
    public function __construct(array $products, Points $points, Actions $actionsAfter, $action = null, Cards\Card $card)
    {
        $this->products     = $products;
        $this->points       = $points;
        $this->actionsAfter = $actionsAfter;
        $this->action       = $action;
        $this->card         = $card;
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

    public function points()
    {
        return $this->points;
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
        return new Totals\Action($this->products, $this->action, $this->card);
    }

    protected function buildAmount()
    {
        return new Totals\Amount($this->products);
    }

    protected function buildBonuses()
    {
        return new Totals\Bonuses($this->card);
    }

    protected function buildCard()
    {
        return new Totals\Card($this->products, $this->action, $this->card);
    }

    protected function buildShipping()
    {
        return new Totals\Shipping($this->points, $this->products);
    }

    protected function buildTotal()
    {
        return new Totals\Total($this, $this->products, $this->actionsAfter, $this->card);
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
