<?php
namespace Meling\Cart\Points\Point;

abstract class Implementation implements \Meling\Cart\Points\Point
{
    /**
     * @var string
     */
    protected $id;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $tariffName;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity[]
     */
    protected $rests = array();

    /**
     * Implementation constructor.
     * @param string                                       $id
     * @param string                                       $name
     * @param string                                       $tariffName
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity[] $rests
     */
    public function __construct($id, $name, $tariffName, $rests)
    {
        $this->id         = $id;
        $this->name       = $name;
        $this->tariffName = $tariffName;
        $this->rests      = $rests;
    }

    /**
     * @inheritdoc
     */
    public function fullName()
    {
        return $this->name . ' (' . $this->tariffName . ')';
    }

    /**
     * @inheritdoc
     */
    public function id()
    {
        return $this->id;
    }

    /**
     * @inheritdoc
     */
    public function name()
    {
        return $this->name;
    }

    /**
     * @inheritdoc
     */
    public function rests($productId)
    {
        if(array_key_exists($productId, $this->rests)) {
            return $this->rests[$productId]->getRequiredField('quantity');
        }

        return 0;
    }

}
