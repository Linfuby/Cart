<?php
namespace Meling\Cart\Points\Point;

abstract class Implementation extends \ArrayObject implements \Meling\Cart\Points\Point
{
    /**
     * @var string
     */
    public $cityId;

    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * Implementation constructor.
     * @param string $id
     * @param string $name
     * @param string $cityId
     */
    public function __construct($id, $name, $cityId)
    {
        parent::__construct(array());
        $this->id     = $id;
        $this->name   = $name;
        $this->cityId = $cityId;
    }

    public function cost()
    {
        return 0;
    }

    /**
     * @return string
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @return string
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @return \ArrayIterator
     */
    public function rests()
    {
        return $this->getIterator();
    }

}
