<?php
namespace Meling\Cart\Providers\Certificates;

/**
 * Class Order
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity[] asArray()
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity offsetGet($id)
 * @package Meling\Cart\Providers\Certificates
 */
class Order extends \Meling\Cart\Providers\Certificates
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $order;

    /**
     * @var \PHPixie\ORM\Loaders\Loader
     */
    protected $orderCertificates;

    /**
     * Certificates constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $order
     * @param \PHPixie\ORM\Loaders\Loader                $orderCertificates
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $order, $orderCertificates)
    {
        parent::__construct($orderCertificates->asArray(false, 'id'), $orm, $context);
        $this->order             = $order;
        $this->orderCertificates = $orderCertificates;
    }

    public function add($certificateId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $orderCertificate */
        $orderCertificate = $this->orm->createEntity('orderCertificate');
        $orderCertificate->setField('orderId', $this->order->id());
        $orderCertificate->setField('price', $price);
        $orderCertificate->setField('quantity', $quantity);
        $orderCertificate->setField('shopId', $shopId);
        $orderCertificate->setField('deliveryId', $deliveryId);
        $orderCertificate->setField('shopTariffId', $shopTariffId);
        $orderCertificate->setField('addressId', $addressId);
        $orderCertificate->setField('pvz', $pvz);
        $orderCertificate->setField('modified', date('Y-m-d H:i:s'));
        $orderCertificate->save();
        $this->offsetSet($orderCertificate->id(), $orderCertificate);
    }

    public function clear()
    {
        $this->orm->query('orderCertificate')->where('orderId', $this->order->id())->delete();
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $orderCertificate = $this->offsetGet($id);
        $orderCertificate->setField('price', $price);
        $orderCertificate->setField('quantity', $quantity);
        $orderCertificate->setField('shopId', $shopId);
        $orderCertificate->setField('deliveryId', $deliveryId);
        $orderCertificate->setField('shopTariffId', $shopTariffId);
        $orderCertificate->setField('addressId', $addressId);
        $orderCertificate->setField('pvz', $pvz);
        $orderCertificate->setField('modified', date('Y-m-d H:i:s'));
        $orderCertificate->save();
        $this->offsetSet($id, $orderCertificate);
    }

    public function remove($id)
    {
        $this->orm->query('orderCertificate')->in($id)->where('orderId', $this->order->id())->delete();
        $this->offsetUnset($id);
    }

}
