<?php
namespace Meling\Cart\Providers\Options;

/**
 * Class Session
 * @method object[] asArray()
 * @method object offsetGet($id)
 * @package Meling\Cart\Providers\Options
 */
class Session extends \Meling\Cart\Providers\Options
{
    protected $key = 'options';

    /**
     * Options constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        $options = $context->session()->get($this->key, array());
        parent::__construct($options, $orm, $context);
    }

    public function add($optionId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $options = $this->context->session()->get($this->key, array());
        $ids     = array_keys($options);
        if($ids) {
            $id = max($ids);
        } else {
            $id = 1;
        }
        $option = (object)array(
            'id'           => $id,
            'optionId'     => $optionId,
            'price'        => $price,
            'quantity'     => $quantity,
            'shopId'       => $shopId,
            'deliveryId'   => $deliveryId,
            'shopTariffId' => $shopTariffId,
            'addressId'    => $addressId,
            'pvz'          => $pvz,
        );
        $this->offsetSet($id, $option);
    }

    public function clear()
    {
        $this->context->session()->set($this->key, array());
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $option               = $this->offsetGet($id);
        $option->price        = $price;
        $option->quantity     = $quantity;
        $option->shopId       = $shopId;
        $option->deliveryId   = $deliveryId;
        $option->shopTariffId = $shopTariffId;
        $option->addressId    = $addressId;
        $option->pvz          = $pvz;
        $this->offsetSet($id, $option);
    }

    public function remove($id)
    {
        $options = $this->context->session()->get($this->key, array());
        unset($options[$id]);
        $this->context->session()->set($this->key, array());
        $this->offsetUnset($id);
    }

}
