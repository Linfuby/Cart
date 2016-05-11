<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
class Products extends \ArrayObject
{
    /**
     * @var int
     */
    protected $quantity;

    /**
     * @var Providers\Provider
     */
    protected $provider;

    /**
     * @var Providers\Options
     */
    protected $options;

    /**
     * @var Providers\Certificates
     */
    protected $certificates;

    /**
     * @param Providers\Provider     $provider
     * @param Providers\Options      $options
     * @param Providers\Certificates $certificates
     * @param array                  $products
     */
    public function __construct(Providers\Provider $provider, Providers\Options $options, Providers\Certificates $certificates, array $products = array())
    {
        $this->provider     = $provider;
        $this->options      = $options;
        $this->certificates = $certificates;
        parent::__construct($products);
    }

    /**
     * @param string       $id
     * @param string       $certificateId
     * @param int          $price
     * @param int          $quantity
     * @param Points\Point $point
     */
    public function addCertificate($id, $certificateId, $price, $quantity = 1, $point = null)
    {
        $shopId       = null;
        $deliveryId   = null;
        $shopTariffId = null;
        $addressId    = null;
        $pvz          = null;
        if($point instanceof \Meling\Cart\Points\Point) {
            $shopId       = $point->shopId();
            $deliveryId   = $point->deliveryId();
            $shopTariffId = $point->shopTariffId();
            $addressId    = $point->addressId();
            $pvz          = $point->pvz();
        }
        if($this->certificates->offsetExists($id)) {
            $certificate = $this->certificates->offsetGet($id);
            $this->certificates->edit($id, $price, $quantity + $certificate->quantity, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);
        } else {
            $this->certificates->add($certificateId, $price, $quantity, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);
        }
    }

    /**
     * @param string       $id
     * @param string       $optionId
     * @param int          $price
     * @param int          $quantity
     * @param Points\Point $point
     */
    public function addOption($id, $optionId, $price, $quantity = 1, $point = null)
    {
        $shopId       = null;
        $deliveryId   = null;
        $shopTariffId = null;
        $addressId    = null;
        $pvz          = null;
        if($point instanceof \Meling\Cart\Points\Point) {
            $shopId       = $point->shopId();
            $deliveryId   = $point->deliveryId();
            $shopTariffId = $point->shopTariffId();
            $addressId    = $point->addressId();
            $pvz          = $point->pvz();
        }
        if($this->options->offsetExists($id)) {
            $option = $this->options->offsetGet($id);
            $this->options->edit($id, $price, $quantity + $option->quantity, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);
        } else {
            $this->options->add($optionId, $price, $quantity, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz);
        }
    }

    /**
     * @return Products\Product[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param $id
     * @return Products\Product
     */
    public function get($id)
    {
        return $this->offsetGet($id);
    }

    /**
     * @return \Meling\Cart\Providers\Provider
     */
    public function provider()
    {
        return $this->provider;
    }

    public function quantity()
    {
        if($this->quantity === null) {
            $this->quantity = 0;
            foreach($this->asArray() as $product) {
                $this->quantity += $product->quantity();
            }
        }

        return $this->quantity;
    }

    /**
     * @param string $id
     */
    public function removeCertificate($id)
    {
        $this->certificates->remove($id);
        $this->offsetUnset($id);
    }

    /**
     * @param string $id
     */
    public function removeOption($id)
    {
        $this->options->remove($id);
        $this->offsetUnset($id);
    }

    public function totals()
    {
        if($this->totals === null) {
            $this->totals = new Totals($this, $this->actions, $this->card, $this->action);
        }

        return $this->totals;
    }

}
