<?php
namespace Meling\Cart\Providers;

abstract class Certificates extends \ArrayObject
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
     * Certificates constructor.
     * @param array                 $certificates
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     */
    public function __construct(array $certificates, \PHPixie\ORM $orm, \PHPixie\HTTP\Context $context)
    {
        parent::__construct($certificates);
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

    public function load($certificateId)
    {
        $certificate = $this->orm->query('certificate')->in($certificateId)->findOne();
        if($certificate === null) {
            throw new \Exception('Certificate ' . $certificateId . ' does not exist');
        }

        return $certificate;
    }

    public abstract function add($certificateId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '');

    public abstract function clear();

    public abstract function edit($id, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '');

    public abstract function remove($id);

}
