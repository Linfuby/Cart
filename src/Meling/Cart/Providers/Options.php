<?php
namespace Meling\Cart\Providers;

abstract class Options extends \ArrayObject
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
     * @param array                 $options
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(array $options, \PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        parent::__construct($options);
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

    public function load($optionId)
    {
        $option = $this->orm->query('option')->in($optionId)->findOne();
        if($option === null) {
            throw new \Exception('Option ' . $optionId . ' does not exist');
        }

        return $option;
    }

    public abstract function add($optionId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '');

    public abstract function clear();

    public abstract function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '');

    public abstract function remove($id);

}
