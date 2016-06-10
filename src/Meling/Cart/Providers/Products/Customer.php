<?php
namespace Meling\Cart\Providers\Products;

/**
 * Class Customer
 * @package Meling\Cart\Providers\Products
 */
class Customer extends \Meling\Cart\Providers\Products
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $customer;

    /**
     * @var string
     */
    private $fieldId;

    /**
     * @var string
     */
    private $modelName;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param array                                      $items
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $customer
     * @param string                                     $modelName
     * @param string                                     $fieldId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, array $items, $customer, $modelName, $fieldId)
    {
        parent::__construct($items, $orm, $context);
        $this->customer  = $customer;
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
        $entity->setField('customerId', $this->customer->id());
        $entity->setField($this->fieldId, $id);
        $entity->setField('quantity', $quantity);
        $entity->setField('price', $price);
        $entity->setField('pointId', $pointId);
        $entity->setField('shopId', $shopId);
        $entity->setField('shopTariffId', $shopTariffId);
        $entity->setField('cityId', $cityId);
        $entity->setField('addressId', $addressId);
        $entity->setField('pvz', $pvz);
        $entity->setField('modified', date('Y-m-d H:i:s'));
        $entity->save();
        $this->offsetSet($id, $entity);

        return $entity->asObject();
    }

    public function clear()
    {
        $this->orm->query($this->modelName)->where('customerId', $this->customer->id())->delete();
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
        if($pointId !== null) {
            $item->setField('pointId', $pointId);
            $item->setField('shopId', $shopId);
            $item->setField('shopTariffId', $shopTariffId);
            $item->setField('cityId', $cityId);
            $item->setField('addressId', $addressId);
            $item->setField('pvz', $pvz);
        }
        $item->setField('modified', date('Y-m-d H:i:s'));
        $item->save();
        $this->offsetSet($id, $item);

        return $item;
    }

    public function remove($id)
    {
        $this->orm->query($this->modelName)->where($this->fieldId, $id)->where('customerId', $this->customer->id())->delete();
        $this->offsetUnset($id);
    }

}
