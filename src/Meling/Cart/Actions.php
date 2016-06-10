<?php
namespace Meling\Cart;

/**
 * Class Actions
 * @package Meling\Cart
 */
class Actions extends \ArrayObject
{
    /**
     * @var mixed
     */
    protected $actionId;

    /**
     * Actions constructor.
     * @param Actions\Action[] $actions
     * @param mixed            $actionId
     */
    public function __construct(array $actions = array(), $actionId = null)
    {
        parent::__construct($actions);
        $this->actionId = $actionId;
    }

    /**
     * @return Actions\Action[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return Actions\Action
     */
    public function get($id = null)
    {
        if($id === null) {
            $id = $this->actionId;
        }
        if($id) {
            if($this->offsetExists($id)) {
                return $this->offsetGet($id);
            }
        }

        return new Actions\Action();
    }

    public function set($actionId)
    {
        $this->actionId = $actionId;
    }

}
