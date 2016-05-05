<?php
namespace Meling\Cart;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions
{
    /**
     * @var \Parishop\ORMWrappers\Action\Entity[]
     */
    protected $actions;

    /**
     * @var mixed
     */
    protected $actionId;

    /**
     * Actions constructor.
     * @param \Parishop\ORMWrappers\Action\Entity[] $actions
     * @param mixed $actionId
     */
    public function __construct(array $actions, $actionId = null)
    {
        $this->actions = $actions;
        $this->actionId = $actionId;
    }

    /**
     * @return \Parishop\ORMWrappers\Action\Entity[]
     */
    public function asArray()
    {
        return $this->actions;
    }

    /**
     * @param $id
     * @return \Parishop\ORMWrappers\Action\Entity
     * @throws \Exception
     */
    public function get($id)
    {
        if ($id !== false) {
            if (array_key_exists($id, $this->actions)) {
                return $this->actions[$id];
            }
        }
        return null;
    }

    /**
     * @return \Parishop\ORMWrappers\Action\Entity
     * @throws \Exception
     */
    public function getDefault()
    {
        if ($this->actionId !== null) {
            return $this->get($this->actionId);
        }

        return $this->get(current(array_keys($this->actions)));
    }

}
