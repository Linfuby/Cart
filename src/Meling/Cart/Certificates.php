<?php
namespace Meling\Cart;

/**
 * Class Certificates
 * @package Meling\Cart
 */
class Certificates
{
    /**
     * @var \Meling\Cart\Providers\Subject
     */
    protected $subject;

    /**
     * @var Providers\Objects
     */
    protected $objects;

    /**
     * Products constructor.
     * @param Providers\Subject $subject
     * @param Providers\Objects $objects
     */
    public function __construct(Providers\Subject $subject, Providers\Objects $objects)
    {
        $this->subject = $subject;
        $this->objects = $objects;
    }

    /**
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $product
     * @param array                                      $data
     * @return int
     */
    public function add($product, $data = array())
    {
        return $this->objects->add($product, $data);
    }

    public function asArray()
    {
        return $this->builder->objects()->objects();
    }

    /**
     * @return $this
     */
    public function clear()
    {
        return $this->builder->objects()->clear();
    }

    /**
     * @param int $id
     * @return $this
     */
    public function remove($id)
    {
        return $this->builder->objects()->remove($id);
    }

}
