<?php
namespace Meling\Cart;

class Points
{
    /**
     * @var Products
     */
    protected $products;

    /**
     * @var \Parishop\ORMWrappers\City\Entity
     */
    protected $city;

    /**
     * @var Points\Point[]
     */
    protected $points;

    /**
     * Points constructor.
     * @param Products                          $products
     * @param \Parishop\ORMWrappers\City\Entity $city
     */
    public function __construct(Products $products, \Parishop\ORMWrappers\City\Entity $city)
    {
        $this->products = $products;
        $this->city     = $city;
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

    /**
     * @param \Parishop\ORMWrappers\City\Entity $city
     */
    public function setCity($city)
    {
        $this->city   = $city;
        $this->points = null;
    }

    protected function buildDeliveries($deliveries)
    {
        return new Points\Deliveries($deliveries);
    }

    /**
     * @param \Meling\Cart\Products\Product $product
     * @param array                         $shops
     * @param array                         $deliveries
     * @return Points\Point
     */
    protected function buildPoint($product, $shops, $deliveries)
    {
        $shops      = $this->buildShops($shops);
        $deliveries = $this->buildDeliveries($deliveries);

        return new Points\Point($product, $shops, $deliveries);
    }

    protected function buildShops($shops)
    {
        return new Points\Shops($shops);
    }

    protected function requirePoints()
    {
        if($this->points !== null) {
            return;
        }
        $points = array();
        foreach($this->products->asArray() as $productId => $product) {
            $shops = $deliveries = array();
            if($product->entity() instanceof \Parishop\ORMWrappers\Option\Entity) {
                $restOptions = $product->entity()->restOptions();
            } elseif($product->entity() instanceof \Parishop\ORMWrappers\Certificate\Entity) {
                $restOptions = $product->entity()->restCertificates();
            } else {
                continue;
            }
            foreach($restOptions as $restOption) {
                if($restOption->shop()->pickup_point) {
                    if(!array_key_exists($restOption->shopId, $shops)) {
                        $shops[$restOption->shopId] = (object)array(
                            'id'    => $restOption->shopId,
                            'shop'  => $restOption->shop(),
                            'cost'  => 0,
                            'rests' => array(),
                        );
                    }
                    if($restOption instanceof \Parishop\ORMWrappers\RestOption\Entity) {
                        if(!array_key_exists($restOption->optionId, $shops[$restOption->shopId]->rests)) {
                            $shops[$restOption->shopId]->rests[$restOption->optionId] = $restOption->quantity;
                        }
                    } elseif($restOption instanceof \Parishop\ORMWrappers\RestCertificate\Entity) {
                        if(!array_key_exists($restOption->certificateId, $shops[$restOption->shopId]->rests)) {
                            $shops[$restOption->shopId]->rests[$restOption->certificateId] = $restOption->quantity;
                        }
                    }

                }
                $deliveryId = null;
                foreach($restOption->shop()->shopTariffs() as $shopTariff) {
                    if($shopTariff->success($this->city)) {
                        $deliveryId = $shopTariff->deliveryId;
                        if(array_key_exists($deliveryId, $deliveries)) {
                            continue;
                        }
                        $deliveries[$deliveryId] = (object)array(
                            'id'         => $deliveryId,
                            'delivery'   => $shopTariff->delivery(),
                            'shopTariff' => $shopTariff,
                            'cost'       => $shopTariff->cost,
                            'rests'      => array(),
                        );
                    }
                }
                if($deliveryId) {
                    if($restOption instanceof \Parishop\ORMWrappers\RestOption\Entity) {
                        if(!array_key_exists($restOption->optionId, $deliveries[$deliveryId]->rests)) {
                            $deliveries[$deliveryId]->rests[$restOption->optionId] = $restOption->quantity;
                        }
                    } elseif($restOption instanceof \Parishop\ORMWrappers\RestCertificate\Entity) {
                        if(!array_key_exists($restOption->certificateId, $deliveries[$deliveryId]->rests)) {
                            $deliveries[$deliveryId]->rests[$restOption->certificateId] = $restOption->quantity;
                        }
                    }
                }
            }
            $points[$productId] = $this->buildPoint($product, $shops, $deliveries);
        }
        $this->points = $points;
    }

}
