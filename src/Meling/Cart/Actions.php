<?php
namespace Meling\Cart;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\AllAction[]
     */
    protected $actions;

    /**
     * @var mixed
     */
    protected $actionId;

    /**
     * Actions constructor.
     * @param \Meling\Tests\ORMWrappers\Entities\AllAction[] $actions
     * @param mixed                                          $actionId
     */
    public function __construct(array $actions, $actionId = null)
    {
        $this->actions  = $actions;
        $this->actionId = $actionId;
    }

    /**
     * @return array|\Meling\Tests\ORMWrappers\Entities\AllAction[]
     */
    public function asArray()
    {
        return $this->actions;
    }

    /**
     * @param $id
     * @return \Meling\Tests\ORMWrappers\Entities\AllAction
     * @throws \Exception
     */
    public function get($id)
    {
        if($id !== false) {
            if(array_key_exists($id, $this->actions)) {
                return $this->actions[$id];
            }
        }
        throw new \Exception('Action ' . $id . ' does not exist');
    }

    /**
     * @return \Meling\Tests\ORMWrappers\Entities\AllAction
     * @throws \Exception
     */
    public function getDefault()
    {
        if($this->actionId !== null) {
            return $this->get($this->actionId);
        }

        return $this->get(current(array_keys($this->actions)));
    }

}
