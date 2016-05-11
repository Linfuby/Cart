<?php
namespace Meling\Cart\Providers\Options;

/**
 * Class Order
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity[] asArray()
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity offsetGet($id)
 * @package Meling\Cart\Providers\Options
 */
class Order extends \Meling\Cart\Providers\Options
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $order;

    /**
     * @var \PHPixie\ORM\Loaders\Loader
     */
    protected $orderOptions;

    /**
     * Options constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $order
     * @param \PHPixie\ORM\Loaders\Loader                $orderOptions
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $order, $orderOptions)
    {
        parent::__construct($orderOptions->asArray(false, 'id'), $orm, $context);
        $this->order        = $order;
        $this->orderOptions = $orderOptions;
    }

    public function add($optionId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $orderOption */
        $orderOption = $this->orm->createEntity('orderOption');
        $orderOption->setField('orderId', $this->order->id());
        $orderOption->setField('price', $price);
        $orderOption->setField('quantity', $quantity);
        $orderOption->setField('shopId', $shopId);
        $orderOption->setField('deliveryId', $deliveryId);
        $orderOption->setField('shopTariffId', $shopTariffId);
        $orderOption->setField('addressId', $addressId);
        $orderOption->setField('pvz', $pvz);
        $orderOption->setField('modified', date('Y-m-d H:i:s'));
        $orderOption->save();
        $this->offsetSet($orderOption->id(), $orderOption);
    }

    public function clear()
    {
        $this->orm->query('orderOption')->where('orderId', $this->order->id())->delete();
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $orderOption = $this->offsetGet($id);
        $orderOption->setField('price', $price);
        $orderOption->setField('quantity', $quantity);
        $orderOption->setField('shopId', $shopId);
        $orderOption->setField('deliveryId', $deliveryId);
        $orderOption->setField('shopTariffId', $shopTariffId);
        $orderOption->setField('addressId', $addressId);
        $orderOption->setField('pvz', $pvz);
        $orderOption->setField('modified', date('Y-m-d H:i:s'));
        $orderOption->save();
        $this->offsetSet($id, $orderOption);
    }

    public function remove($id)
    {
        $this->orm->query('orderOption')->in($id)->where('orderId', $this->order->id())->delete();
        $this->offsetUnset($id);
    }

}
