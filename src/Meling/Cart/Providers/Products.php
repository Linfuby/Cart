<?php
namespace Meling\Cart\Providers;

abstract class Products extends \ArrayObject
{
    /**
     * @var \PHPixie\ORM
     */
    protected $orm;

    /**
     * @var \PHPixie\HTTP\Context
     */
    protected $context;

    /**
     * Options constructor.
     * @param array                 $items
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(array $items, \PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        parent::__construct($items);
        $this->orm     = $orm;
        $this->context = $context;
    }

    /**
     * @return \ArrayIterator
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    /**
     * @param string $id
     * @param int    $quantity
     * @param int    $price
     * @param string $pointId
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return mixed
     */
    public abstract function add($id, $quantity, $price, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null);

    public abstract function clear();

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
    public abstract function edit($id, $quantity, $pointId = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null);

    /**
     * @param $id
     */
    public abstract function remove($id);

}
