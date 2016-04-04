<?php
namespace Meling\Cart\Actions;

abstract class Action
{
    /**
     * @var \Meling\Cart\Actions
     */
    protected $actions;

    /**
     * @var \Meling\Cart\Wrappers\Action\Entity
     */
    protected $entity;

    /**
     * Action constructor.
     * @param \Meling\Cart\Actions                $actions
     * @param \Meling\Cart\Wrappers\Action\Entity $entity
     */
    public function __construct(\Meling\Cart\Actions $actions, $entity = null)
    {
        $this->actions = $actions;
        $this->entity  = $entity;
    }

}
