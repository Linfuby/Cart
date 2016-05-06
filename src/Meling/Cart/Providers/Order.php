<?php
namespace Meling\Cart\Providers;

/**
 * Class Order
 * @package Meling\Cart\Providers
 */
class Order extends Provider
{
    /**
     * @var \Parishop\ORMWrappers\Order\Entity
     */
    protected $order;

    protected $actionId;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM          $orm
     * @param \PHPixie\HTTP\Context $context
     * @param mixed                 $orderId
     * @param mixed                 $actionId
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context $context, $orderId, $actionId = null)
    {
        parent::__construct($orm, $context);
        $this->order    = $this->orm()->query('order')->in($orderId)->findOne(
            array(
                'orderProducts.option.product.productImages',
                'orderProducts.option.product.brand',
                'orderProducts.option.restOptions.shop.shopTariffs.delivery',
                'orderCertificates.certificate',
                'customer.customerCards',
                'customer.addresses.city.region.country',
            )
        );
        $this->actionId = $actionId;
    }

    public function actionId()
    {
        return $this->actionId;
    }

    public function addCertificate(
        $certificateId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    ) {
        /** @var \Parishop\ORMWrappers\Option\Entity $option */
        $certificate = $this->orm()->query('certificate')->in($certificateId)->findOne();
        if($certificate) {
            /** @var \Parishop\ORMWrappers\CartCertificate\Entity $orderCertificate */
            $orderCertificate               = $this->orm()->createEntity('orderCertificate');
            $orderCertificate->quantity     = $quantity;
            $orderCertificate->price        = $price;
            $orderCertificate->shopId       = $shopId;
            $orderCertificate->deliveryId   = $deliveryId;
            $orderCertificate->shopTariffId = $shopTariffId;
            $orderCertificate->addressId    = $addressId;
            $orderCertificate->pvz          = $pvz;
            $orderCertificate->save();
            $orderCertificate->certificate->set($certificate);
            $this->order->orderCertificates->add($orderCertificate);
            $this->certificates[(string)$orderCertificate->id()] = $this->buildProduct(
                $orderCertificate->id(),
                $orderCertificate->certificate(), $quantity, $price, 0, $orderCertificate->certificate()->name,
                $orderCertificate->certificate()->image, '', $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
            );
        }
    }

    public function addOption(
        $optionId,
        $quantity = 1,
        $price = null,
        $shopId = null,
        $deliveryId = null,
        $shopTariffId = null,
        $addressId = null,
        $pvz = null
    ) {
        /** @var \Parishop\ORMWrappers\Option\Entity $option */
        $option = $this->orm()->query('option')->in($optionId)->findOne();
        if($option) {
            /** @var \Parishop\ORMWrappers\OrderProduct\Entity $orderOption */
            $orderOption               = $this->orm()->createEntity('orderProduct');
            $orderOption->quantity     = $quantity;
            $orderOption->price        = $price;
            $orderOption->shopId       = $shopId;
            $orderOption->deliveryId   = $deliveryId;
            $orderOption->shopTariffId = $shopTariffId;
            $orderOption->addressId    = $addressId;
            $orderOption->pvz          = $pvz;
            $orderOption->save();
            $orderOption->option->set($option);
            $this->order->orderProducts->add($orderOption);
            $this->options[(string)$orderOption->id()] = $this->buildProduct(
                $orderOption->id(), $orderOption->option(),
                $quantity, $price, $orderOption->option()->old_price,
                $orderOption->option()->product()->name(), $orderOption->option()->product()->image()->name(),
                $orderOption->option()->product()->brand()->name(), $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
            );
        }
    }

    public function address()
    {
        return $this->order->customer()->address();
    }

    public function addresses()
    {
        return $this->order->customer()->addresses()->asArray(false, 'id');
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->order->orderCertificates() as $orderCertificate) {
                $quantity                                            = (int)$orderCertificate->quantity;
                $price                                               = (int)$orderCertificate->price;
                $shopId                                              = $this->order->shopId;
                $deliveryId                                          = $this->order->deliveryId;
                $shopTariffId                                        = $this->order->shopTariffId;
                $addressId                                           = $this->order->addressId;
                $pvz                                                 = $this->order->pvz;
                $this->certificates[(string)$orderCertificate->id()] = $this->buildProduct(
                    $orderCertificate->id(),
                    $orderCertificate->certificate(), $quantity, $price, 0, $orderCertificate->certificate()->name,
                    $orderCertificate->certificate()->image, '', $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
                );
            }
        }

        return $this->certificates;
    }

    public function clear()
    {
        $this->order->orderCertificates->query()->delete();
        $this->order->orderProducts->query()->delete();
    }

    public function customerCards()
    {
        return $this->order->customer()->customerCards();
    }

    public function editCertificate($id, $certificateId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz)
    {
        $this->orm()->query('cartCertificate')->in($id)->update(
            array(
                'quantity'     => $quantity,
                'price'        => $price,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
            )
        );
    }

    public function editOption($id, $optionId, $quantity, $price, $shopId, $deliveryId, $shopTariffId, $addressId, $pvz)
    {
        $this->orm()->query('cartOption')->in($id)->update(
            array(
                'quantity'     => $quantity,
                'price'        => $price,
                'shopId'       => $shopId,
                'deliveryId'   => $deliveryId,
                'shopTariffId' => $shopTariffId,
                'addressId'    => $addressId,
                'pvz'          => $pvz,
            )
        );
    }

    public function email()
    {
        return $this->order->email;
    }

    public function firstname()
    {
        return $this->order->firstname;
    }

    public function id()
    {
        return $this->order->id();
    }

    public function lastname()
    {
        return $this->order->lastname;
    }

    public function middlename()
    {
        return $this->order->middlename;
    }

    /**
     * @return \Meling\Cart\Products\Product[]
     */
    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->order->orderProducts() as $orderOption) {
                $quantity                                  = (int)$orderOption->quantity;
                $price                                     = (int)$orderOption->price;
                $shopId                                    = $this->order->shopId;
                $deliveryId                                = $this->order->deliveryId;
                $shopTariffId                              = $this->order->shopTariffId;
                $addressId                                 = $this->order->addressId;
                $pvz                                       = $this->order->pvz;
                $this->options[(string)$orderOption->id()] = $this->buildProduct(
                    $orderOption->id(), $orderOption->option(),
                    $quantity, $price, $orderOption->option()->old_price,
                    $orderOption->option()->product()->name(), $orderOption->option()->product()->image()->name(),
                    $orderOption->option()->product()->brand()->name(), $shopId, $deliveryId, $shopTariffId, $addressId, $pvz
                );
            }
        }

        return $this->options;
    }

    public function phone()
    {
        return $this->order->phone;
    }

    public function removeCertificate($id)
    {
        $this->orm()->query('orderCertificate')->in($id)->delete();
        unset($this->certificates[$id]);
    }

    public function removeOption($id)
    {
        $this->orm()->query('orderProduct')->in($id)->delete();
        unset($this->options[$id]);
    }

}
