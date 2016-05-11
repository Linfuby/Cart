<?php
namespace Meling\Cart\Providers\Certificates;

/**
 * Class Customer
 * @method \PHPixie\ORM\Wrappers\Type\Database\Entity[] asArray()
 * @package Meling\Cart\Providers\Certificates
 */
class Customer extends \Meling\Cart\Providers\Certificates
{
    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $customer;

    /**
     * @var \PHPixie\ORM\Loaders\Loader
     */
    protected $cartCertificates;

    /**
     * Certificates constructor.
     * @param \PHPixie\ORM                               $orm
     * @param \PHPixie\HTTP\Context                      $context
     * @param \PHPixie\ORM\Wrappers\Type\Database\Entity $customer
     * @param \PHPixie\ORM\Loaders\Loader                $cartCertificates
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $customer, $cartCertificates)
    {
        parent::__construct($cartCertificates->asArray(false, 'id'), $orm, $context);
        $this->customer    = $customer;
        $this->cartCertificates = $cartCertificates;
    }

    public function add($certificateId, $price, $quantity = 1, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        try {
            /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $cartCertificate */
            $cartCertificate = $this->orm->createEntity('cartCertificate');
            $cartCertificate->setField('customerId', $this->customer->id());
            $cartCertificate->setField('certificateId', $certificateId);
            $cartCertificate->setField('price', $price);
            $cartCertificate->setField('quantity', $quantity);
            $cartCertificate->setField('shopId', $shopId);
            $cartCertificate->setField('deliveryId', $deliveryId);
            $cartCertificate->setField('shopTariffId', $shopTariffId);
            $cartCertificate->setField('addressId', $addressId);
            $cartCertificate->setField('pvz', $pvz);
            $cartCertificate->setField('modified', date('Y-m-d H:i:s'));
            $cartCertificate->save();
            $certificate         = $cartCertificate->asObject();
            $certificate->certificate = $this->load($certificateId);
            $this->offsetSet($certificate->id, $certificate);
        } catch(\Exception $e) {

        }
    }

    public function clear()
    {
        $this->orm->query('cartCertificate')->where('customerId', $this->customer->id())->delete();
        parent::exchangeArray(array());
    }

    public function edit($id, $price, $quantity = 1, $actionId = null, $shopId = null, $deliveryId = null, $shopTariffId = null, $addressId = null, $pvz = '')
    {
        $this->offsetGet($id);
        /** @var \PHPixie\ORM\Wrappers\Type\Database\Entity $cartCertificate */
        $this->orm->query('cartCertificate')->in($id)->update(
            array(
                'price'        => $price,
                'quantity'     => $quantity,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
                'modified'     => date('Y-m-d H:i:s'),
            )
        );
        $cartCertificate     = $this->orm->query('cartCertificate')->in($id)->findOne();
        $certificate         = $cartCertificate->asObject();
        $certificate->certificate = $this->load($id);
        $this->offsetSet($certificate->id, $certificate);
    }

    public function remove($id)
    {
        $this->orm->query('cartCertificate')->in($id)->where('customerId', $this->customer->id())->delete();
        $this->offsetUnset($id);
    }

}
