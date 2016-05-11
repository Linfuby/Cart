<?php
namespace Meling\Cart\Products;

/**
 * Class Certificate
 * @package Meling\Cart\Products
 */
class Certificate extends Product
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $certificate;

    /**
     * Product constructor.
     * @param string                                     $id
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $certificate
     * @param int                                        $price
     * @param int                                        $quantity
     * @param \Meling\Cart\Points\Point                  $point
     */
    public function __construct($id, $certificate, $price, $quantity = 1, $point = null)
    {
        parent::__construct($id, $price, $quantity, $point);
        $this->certificate = $certificate;
    }
}
