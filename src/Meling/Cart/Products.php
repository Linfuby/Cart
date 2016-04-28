<?php
namespace Meling\Cart;

class Products
{
    /**
     * @var \Meling\Cart\Providers\Provider
     */
    protected $provider;

    /**
     * @var Products\Product
     */
    protected $products;

    /**
     * Objects constructor.
     * @param Providers\Provider $provider
     */
    public function __construct(Providers\Provider $provider)
    {
        $this->provider = $provider;
    }

    /**
     * @param                              $id
     * @param \Meling\Cart\Wrappers\Entity $entity
     * @param                              $price
     * @param                              $quantity
     * @param                              $image
     * @param                              $shopId
     * @param                              $deliveryId
     * @param                              $shopTariffId
     * @param                              $addressId
     * @param                              $pvz
     * @param                              $customerId
     * @return Products\Product
     */
    public function add($id, $entity, $price = null, $quantity = null, $image = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = null, $customerId = null)
    {
        $object = $this->provider->addObject($id, $entity, $price, $quantity, $image, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz, $customerId);

        return $this->buildProduct($object);
    }

    public function asArray()
    {
        $this->requireProducts();

        return $this->products;
    }

    protected function requireProducts()
    {
        if($this->products !== null) {
            return;
        }
        $products = array();
        foreach($this->provider->objects() as $object) {
            $product = $this->buildProduct($object);
            if($product) {
                $products[$product->id()] = $product;
            }
        }
        $this->products = $products;
    }

    private function buildOption($object)
    {
        return new Products\Option();
    }

    private function buildProduct($object)
    {
        if(!empty($object['optionId'])) {
            return $this->buildOption($object);
        }
        if(!empty($object['certificateId'])) {
            return $this->buildCertificate($object);
        }

        return null;
    }

}
