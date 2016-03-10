<?php
namespace Meling\Cart;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions
{
    /**
     * @var Providers\Environment
     */
    protected $environment;

    /**
     * @var Providers\Subject
     */
    protected $subject;

    /**
     * @var Totals
     */
    protected $totals;

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
     * @param Providers\Environment $environment
     * @param Providers\Subject     $subject
     * @param Totals                $totals
     */
    public function __construct(Providers\Environment $environment, Providers\Subject $subject, Totals $totals)
    {
        $this->environment = $environment;
        $this->subject     = $subject;
        $this->totals      = $totals;
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
        } elseif($action = $this->environment->action()) {
            return new Actions\Action($this->totals, $action);
        }

        return new Actions\Action($this->totals);
    }

    /**
     * @param string $id
     * @return Actions\Action
     */
    public function getAfter($id)
    {
        $this->requireActionsAfter();
        if($id !== null) {
            if(array_key_exists($id, $this->actionsAfter)) {
                return $this->actionsAfter[$id];
            }
        }

        return new Actions\Action($this->totals);
    }

    protected function requireActions()
    {
        if($this->actions !== null) {
            return;
        }
        $actions = array();
        foreach($this->environment->actions(
            $this->subject->dateActual(), $this->subject->dateBirthday(), $this->subject->dateMarriage()
        ) as $action) {
            $actions[$action->id()] = new Actions\Action($this->totals, $action);
        }
        $this->actions = $actions;
        unset($actions);
    }

    protected function requireActionsAfter()
    {
        if($this->actionsAfter !== null) {
            return;
        }
        $actionsAfter = array();
        foreach($this->environment->actionsAfter($this->subject->dateActual()) as $action) {
            $actionsAfter[$action->id()] = new Actions\Action($this->totals, $action);
        }
        $this->actionsAfter = $actionsAfter;
        unset($actionsAfter);
    }

}
