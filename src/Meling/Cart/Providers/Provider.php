<?php
namespace Meling\Cart\Providers;

/**
 * Class Provider
 * @package Meling\Cart\Providers
 */
abstract class Provider
{
    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var \PHPixie\HTTP\Context
     */
    protected $context;

    /**
     * @var \Meling\Cart\Actions
     */
    protected $actions;

    /**
     * @var \Meling\Cart\Actions
     */
    protected $actionsAfter;

    /**
     * @var \Meling\Cart\Addresses
     */
    protected $addresses;

    /**
     * @var \Meling\Cart\Cards
     */
    protected $cards;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        $this->orm     = $orm;
        $this->context = $context;
    }

    /**
     * @return \Meling\Cart\Actions
     */
    public function actions()
    {
        if($this->actions === null) {
            $actions = $this->orm->query('allowAction');
            $actions->where('after', 0);
            $this->actions = new \Meling\Cart\Actions($actions->find()->asArray(false, 'id'), $this->actionId());
        }

        return $this->actions;
    }

    /**
     * @return \Meling\Cart\Actions
     */
    public function actionsAfter()
    {
        if($this->actionsAfter === null) {
            $actions = $this->orm->query('allowAction');
            $actions->where('after', 1);
            $this->actionsAfter = new \Meling\Cart\Actions($actions->find()->asArray(false, 'id'));
        }

        return $this->actionsAfter;
    }

    protected function actionId()
    {
        return $this->context->session()->get('actionId');
    }

    /**
     * @return \DateTime
     */
    public abstract function actionsBirthday();

    /**
     * @return \DateTime
     */
    public abstract function actionsDate();

    /**
     * @return \DateTime
     */
    public abstract function actionsMarriage();

    /**
     * @return \Meling\Cart\Addresses
     */
    public abstract function addresses();

    /**
     * @return \Meling\Cart\Cards
     */
    public abstract function cards();

    /**
     * @return string
     */
    public abstract function email();

    /**
     * @return string
     */
    public abstract function firstname();

    /**
     * @return string
     */
    public abstract function id();

    /**
     * @return string
     */
    public abstract function lastname();

    /**
     * @return string
     */
    public abstract function middlename();

    /**
     * @return string
     */
    public abstract function phone();

}
