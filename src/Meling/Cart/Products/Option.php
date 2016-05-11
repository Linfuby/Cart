<?php
namespace Meling\Cart\Products;

/**
 * Class Option
 * @package Meling\Cart\Products
 */
class Option extends Product
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $option;

    /**
     * Product constructor.
     * @param string                                     $id
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $option
     * @param int                                        $price
     * @param int                                        $quantity
     * @param \Meling\Cart\Points\Point                  $point
     */
    public function __construct($id, $option, $price, $quantity = 1, $point = null)
    {
        parent::__construct($id, $price, $quantity, $point);
        $this->option = $option;
    }

}
