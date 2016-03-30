<?php
namespace Meling\Cart\Provider;

class Order extends \Meling\Cart\Provider
{
    /**
     * @var \Meling\Cart\Wrappers\Order\Entity
     */
    private $order;

    /**
     * Order constructor.
     * @param \Meling\Cart\Wrappers\Order\Entity $order
     */
    public function __construct(\Meling\Cart\Wrappers\Order\Entity $order)
    {
        $this->order = $order;
    }

    protected function requireCertificates()
    {
        return $this->order->orderCertificates()->asArray(true);
    }

    protected function requireOptions()
    {
        $options = array();
        foreach($this->order->orderProducts()->asArray(true) as $orderProduct) {
            $orderProduct->shopId       = $this->order->shopId;
            $orderProduct->deliveryId   = $this->order->deliveryId;
            $orderProduct->shopTariffId = $this->order->shopTariffId;
            $orderProduct->addressId    = $this->order->addressId;
            $options[]                  = $orderProduct;
        }

        return $options;
    }


}