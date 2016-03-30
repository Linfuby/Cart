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
    protected $options;

    /**
     * Objects constructor.
     * @param array $options
     * @param array $certificates
     */
    public function __construct(array $options = array(), array $certificates = array())
    {
        $this->options      = $options;
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
        $image,
        $price,
        $quantity = 1,
        $shopId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null)
    {
        return new \Meling\Cart\Objects\Certificate($id, $certificate, $image, $price, $quantity, $shopId, $shopTariffId, $addressId, $pvz);
    }

    protected function buildOption(
        $id,
        $option,
        $price,
        $quantity = 1,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null)
    {
        return new \Meling\Cart\Objects\Option($id, $option, $price, $quantity, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);
    }

    protected function requireObjects()
    {
        if($this->objects !== null) {
            return;
        }
        $objects = array();
        foreach($this->options as $option) {
            $objects[] = $this->buildOption($option->id, $option->option, $option->price, $option->quantity, $option->shopId, $option->shopTariffId, $option->addressId, $option->pvz);
        }
        foreach($this->certificates as $certificate) {
            $objects[] = $this->buildCertificate($certificate->id, $certificate->certificate, $certificate->image, $certificate->price, $certificate->quantity, $certificate->shopId, $certificate->shopTariffId, $certificate->addressId, $certificate->pvz);
        }
        $this->objects = $objects;
    }


}