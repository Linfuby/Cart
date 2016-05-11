<?php
namespace Meling\Cart\Providers\Certificates;

/**
 * Class Session
 * @method object[] asArray()
 * @method object offsetGet($id)
 * @package Meling\Cart\Providers\Certificates
 */
class Session extends \Meling\Cart\Providers\Certificates
{
    protected $key = 'certificates';

    /**
     * Certificates constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        $certificates = $context->session()->get($this->key, array());
        parent::__construct($certificates, $orm, $context);
    }

    public function add($certificateId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $certificates = $this->context->session()->get($this->key, array());
        $ids     = array_keys($certificates);
        if($ids) {
            $id = max($ids);
        } else {
            $id = 1;
        }
        $certificate = (object)array(
            'id'           => $id,
            'certificateId'     => $certificateId,
            'price'        => $price,
            'quantity'     => $quantity,
            'shopId'       => $shopId,
            'deliveryId'   => $deliveryId,
            'shopTariffId' => $shopTariffId,
            'addressId'    => $addressId,
            'pvz'          => $pvz,
        );
        $this->offsetSet($id, $certificate);
    }

    public function clear()
    {
        $this->context->session()->set($this->key, array());
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $certificate               = $this->offsetGet($id);
        $certificate->price        = $price;
        $certificate->quantity     = $quantity;
        $certificate->shopId       = $shopId;
        $certificate->deliveryId   = $deliveryId;
        $certificate->shopTariffId = $shopTariffId;
        $certificate->addressId    = $addressId;
        $certificate->pvz          = $pvz;
        $this->offsetSet($id, $certificate);
    }

    public function remove($id)
    {
        $certificates = $this->context->session()->get($this->key, array());
        unset($certificates[$id]);
        $this->context->session()->set($this->key, array());
        $this->offsetUnset($id);
    }

}
