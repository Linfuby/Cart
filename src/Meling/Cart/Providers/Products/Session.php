<?php
namespace Meling\Cart\Providers\Products;

/**
 * Class Session
 * @package Meling\Cart\Providers\Products
 */
class Session extends \Meling\Cart\Providers\Products
{
    /**
     * @var string
     */
    private $fieldId;

    /**
     * @var string
     */
    private $modelName;

    /**
     * Options constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     * @param \PHPixie\HTTP\Context $modelName
     * @param                       $fieldId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $modelName, $fieldId)
    {
        $options = $context->session()->get($modelName, array());
        parent::__construct($options, $orm, $context);
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
        $items      = $this->context->session()->get($this->modelName, array());
        $item       = (object)array(
            'id'           => $id,
            $this->fieldId => $id,
            'quantity'     => $quantity,
            'price'        => $price,
            'pointId'      => $pointId,
            'shopId'       => $shopId,
            'shopTariffId' => $shopTariffId,
            'cityId'       => $cityId,
            'addressId'    => $addressId,
            'pvz'          => $pvz,
        );
        $items[$id] = $item;
        $this->context->session()->set($this->modelName, $items);
        $this->offsetSet($id, $item);

        return $item;
    }

    public function clear()
    {
        $this->context->session()->set($this->modelName, array());
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
        $item           = $this->offsetGet($id);
        $item->quantity = $quantity;
        if($pointId !== null) {
            $item->pointId      = $pointId;
            $item->shopId       = $shopId;
            $item->shopTariffId = $shopTariffId;
            $item->cityId       = $cityId;
            $item->addressId    = $addressId;
            $item->pvz          = $pvz;
        }
        $this->offsetSet($id, $item);

        return $item;
    }

    public function remove($id)
    {
        $items = $this->context->session()->get($this->modelName, array());
        unset($items[$id]);
        $this->context->session()->set($this->modelName, $items);
        $this->offsetUnset($id);
    }

}
