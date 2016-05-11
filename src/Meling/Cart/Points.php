<?php
namespace Meling\Cart;

class Points
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $city;

    /**
     * @var string
     */
    protected $addressId;

    /**
     * @var Points\Point[]
     */
    protected $points;

    /**
     * Points constructor.
     * @param Products                                   $products
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $city
     * @param string                                     $addressId
     */
    public function __construct(Products $products, \PHPixie\ORM\Wrappers\Type\Database\Entity $city, $addressId = null)
    {
        $this->products  = $products;
        $this->city      = $city;
        $this->addressId = $addressId;
    }

    public function asArray()
    {
        $this->requirePoints();

        return $this->points;
    }

    public function getFor($id)
    {
        $this->requirePoints();
        if(array_key_exists($id, $this->points)) {
            return $this->points[$id];
        }
        throw new \Exception('Product ' . $id . ' don\'t have Points');
    }

    protected function buildDeliveries($shopTariffs)
    {
        return new Points\Deliveries($shopTariffs, $this->addressId);
    }

    protected function buildShops($shops, $rests)
    {
        return new Points\Shops($shops, $rests);
    }

    protected function requirePoints()
    {
        if($this->points !== null) {
            return;
        }
        $points = $shops = $deliveries = array();
        foreach($this->products->asArray() as $product) {
            // TODO-Linfuby: Получить остатки Товаров.
        }
        $this->points = $points;
    }

}
