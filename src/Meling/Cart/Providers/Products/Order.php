<?php
namespace Meling\Cart\Providers\Products;

/**
 * Class Order
 * @package Meling\Cart\Providers\Products
 */
class Order extends \Meling\Cart\Providers\Products
{
    /**
     * @var \Parishop\ORMWrappers\Order\Entity
     */
    protected $order;

    /**
     * @var string
     */
    private $fieldId;

    /**
     * @var string
     */
    private $modelName;

    /**
     * Order constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param array                                      $items
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $order
     * @param string                                     $modelName
     * @param string                                     $fieldId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, array $items, $order, $modelName, $fieldId)
    {
        parent::__construct($items, $orm, $context);
        $this->order     = $order;
        $this->modelName = $modelName;
        $this->fieldId   = $fieldId;
    }

    /**
     * @param string $id
     * @param int    $quantity
     * @param int    $price
     * @param string $pointId
     * @param string $shopId
     * @param null   $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return mixed
     */
    public function add($id, $quantity, $price, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $entity */
        $entity = $this->orm->createEntity($this->modelName);
        $entity->setField('orderId', $this->order->id());
        $entity->setField($this->fieldId, $id);
        $entity->setField('quantity', $quantity);
        $entity->setField('price', $price);
        $entity->setField('final', $price);
        $entity->setField('total', $price * $quantity);
        $entity->setField('pointId', $this->order->shopId . $this->order->shopTariffId);
        $entity->setField('shopId', $this->order->shopId);
        $entity->setField('shopTariffId', $this->order->shopTariffId);
        $entity->setField('cityId', $this->order->cityId);
        $entity->setField('addressId', $this->order->addressId);
        $entity->setField('pvz', $this->order->pvz);
        $entity->setField('modified', date('Y-m-d H:i:s'));
        $entity->save();
        $this->offsetSet($id, $entity);

        return $entity->asObject();
    }

    public function clear()
    {
        $this->orm->query($this->modelName)->where('orderId', $this->order->id())->delete();
        parent::exchangeArray(array());
    }

    /**
     * @param string $id
     * @param int    $quantity
     * @param string $pointId
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return mixed
     */
    public function edit($id, $quantity, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        $item = $this->offsetGet($id);
        $item->setField('quantity', $quantity);
        $item->setField('total', $item->getField('price') * $quantity);
        $item->setField('pointId', $this->order->shopId . $this->order->shopTariffId);
        $item->setField('shopId', $this->order->shopId);
        $item->setField('shopTariffId', $this->order->shopTariffId);
        $item->setField('cityId', $this->order->cityId);
        $item->setField('addressId', $this->order->addressId);
        $item->setField('pvz', $this->order->pvz);
        $item->setField('modified', date('Y-m-d H:i:s'));
        $item->save();
        $this->offsetSet($id, $item);

        return $item;
    }

    public function remove($id)
    {
        $this->orm->query($this->modelName)->where($this->fieldId, $id)->where('orderId', $this->order->id())->delete();
        $this->offsetUnset($id);
    }

}
