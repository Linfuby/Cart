<?php
namespace Meling\Cart;

class Objects
{
    /**
     * @var \Meling\Cart\Objects\Object[]
     */
    protected $objects;

    /**
     * @var array
     */
    protected $certificates;

    /**
     * @var array
     */
    protected $products;

    /**
     * Objects constructor.
     * @param array $products
     * @param array $certificates
     */
    public function __construct(array $products = array(), array $certificates = array())
    {
        $this->products     = $products;
        $this->certificates = $certificates;
    }

    /**
     * @param Objects\Object $object
     * @return int
     */
    public function add($object)
    {
        $this->requireObjects();
        $id              = count($this->objects);
        $this->objects[] = $object;

        return $id;
    }

    public function asArray()
    {
        $this->requireObjects();

        return $this->objects;
    }

    protected function buildCertificate(
        $id,
        $certificate,
        $price,
        $quantity = 1,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null)
    {
        return new \Meling\Cart\Objects\Certificate($id, $certificate, $price, $quantity, $shopId, $deliveryId, $shopTariffId, $addressId);
    }

    protected function buildOption(
        $id,
        $option,
        $price,
        $quantity = 1,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null)
    {
        return new \Meling\Cart\Objects\Option($id, $option, $price, $quantity, $shopId, $deliveryId, $shopTariffId, $addressId);
    }

    protected function requireObjects()
    {
        if($this->objects !== null) {
            return;
        }
        $objects = array();
        foreach($this->products as $product) {
            $objects[] = $this->buildOption($product->id, $product->option, $product->price, $product->quantity, $product->shopId, $product->deliveryId, $product->shopTariffId, $product->addressId);
        }
        foreach($this->certificates as $certificate) {
            $objects[] = $this->buildCertificate($certificate->id, $certificate->certificate, $certificate->price, $certificate->quantity, $certificate->shopId, $certificate->deliveryId, $certificate->shopTariffId, $certificate->addressId);
        }
        $this->objects = $objects;
    }


}