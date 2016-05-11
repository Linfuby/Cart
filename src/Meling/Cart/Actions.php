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
     * @param array $actions
     * @param mixed $actionId
     */
    public function __construct($actions, $actionId = null)
    {
        parent::__construct($actions);
        $this->actionId = $actionId;
    }

    /**
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    public function get($id = null)
    {
        if($id === null) {
            $id = $this->actionId;
        }
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }

        return new Actions\Action();
    }

}
