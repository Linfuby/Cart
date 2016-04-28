<?php
namespace Meling\Cart\Products;

class Certificate extends Product
{
    /**
     * @var \Meling\Cart\Wrappers\Certificate\Entity
     */
    protected $entity;

    /**
     * @return Points\Point[]
     */
    public function points()
    {
        if($this->points === null) {
            $this->points = array();
        }

        return $this->points;
    }
}