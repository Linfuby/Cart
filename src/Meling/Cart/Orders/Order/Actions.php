<?php
namespace Meling\Cart\Orders\Order;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Products
     */
    protected $products;

    /**
     * @var Actions\Action[]
     */
    protected $actions;

    /**
     * @var Actions\Action[]
     */
    protected $actionsAfter;

    /**
     * Products constructor.
     * @param \Meling\Cart\Providers\Provider $provider
     * @param Products                        $products
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, Products $products)
    {
        $this->provider = $provider;
        $this->products = $products;
        $this->cards    = new Actions\Cards($this->provider);
    }

    /**
     * @return Actions\Action[]
     */
    public function asAfter()
    {
        $this->requireActionsAfter();

        return $this->actionsAfter;
    }

    /**
     * @return Actions\Action[]
     */
    public function asArray()
    {
        $this->requireActions();

        return $this->actions;
    }

    public function cards()
    {
        return $this->cards;
    }

    /**
     * @param string $id
     * @return Actions\Action
     */
    public function get($id = null)
    {
        $this->requireActions();
        if($id !== null) {
            if(array_key_exists($id, $this->actions)) {
                return $this->actions[$id];
            }
        } elseif($action = $this->provider->action()) {
            return $this->buildAction($action);
        }

        return $this->buildAction();
    }

    /**
     * @param string $id
     * @return Actions\Action
     */
    public function getAfter($id = null)
    {
        $this->requireActionsAfter();
        if($id !== null) {
            if(array_key_exists($id, $this->actionsAfter)) {
                return $this->actionsAfter[$id];
            }
        }

        return $this->buildAction();
    }

    protected function requireActions()
    {
        if($this->actions !== null) {
            return;
        }
        $actions = array(53001 => $this->buildAction((object)array('id' => 53001, 'actionTypeId' => 53001)));
        foreach($this->provider->actions() as $action) {
            $actions[$action->id()] = $this->buildAction($action);
        }
        $this->actions = $actions;
        $this->get()->totalDiscount();
        unset($actions);
    }

    protected function requireActionsAfter()
    {
        if($this->actionsAfter !== null) {
            return;
        }
        $actionsAfter = array();
        foreach($this->provider->actionsAfter() as $action) {
            $actionsAfter[$action->id()] = $this->buildAction($action);
        }
        $this->actionsAfter = $actionsAfter;
        unset($actionsAfter);
    }

    private function buildAction($action = null)
    {
        return new Actions\Action($this->products, $action, $this->cards->get());
    }

}
