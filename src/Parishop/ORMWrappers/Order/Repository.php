<?php
namespace Parishop\ORMWrappers\Order;

/**
 * Class Repository
 * @method Query query()
 * @method Entity create($data = array())
 * @package    ORMWrappers
 * @subpackage Repository
 */
class Repository extends \Parishop\ORMWrappers\Repository
{
    public function countWork($statuses)
    {
        /**
         * @var Entity $order
         */
        $count = 0;
        foreach($this->work() as $order) {
            if(in_array($order->orderStatusId, $statuses)) {
                $count++;
            }
        }

        return $count;
    }

    /**
     * @param \Meling\Cart\Orders\Order $order
     * @param \Meling\Cart              $cart
     * @param int                       $paymentId
     * @param array                     $data
     * @return \Parishop\ORMWrappers\Order\Entity
     */
    public function createFromCart($order, $cart, $paymentId, $data = array())
    {
        $entity  = $this->create($data);
        $point   = $order->point();
        $product = $order->products()->getIterator()->current();
        if($point instanceof \Meling\Cart\Points\Point\Shop) {
            /** @var \Parishop\ORMWrappers\Shop\Entity $shop */
            $shop = $this->builder->components()->orm()->query('shop')->in($point->id())->findOne();
            $entity->setField('shopId', $point->id());
            $entity->setField('deliveryId', null);
            $entity->setField('shopTariffId', null);
            $entity->setField('addressId', null);
            $entity->setField('pvz', $point->name() . '. ' . $point->street());
            $entity->setField('countryId', $shop->city()->region()->countryId);
            $entity->setField('regionId', $shop->city()->regionId);
            $entity->setField('cityId', $shop->city()->id());
        }
        if($point instanceof \Meling\Cart\Points\Point\Delivery) {
            $entity->setField('shopId', $point->shop()->id());
            $entity->setField('deliveryId', $point->delivery()->id());
            $entity->setField('shopTariffId', $point->shopTariff()->id());
            $entity->setField('addressId', $product->addressId);
            $entity->setField('pvz', $product->pvz);
            $entity->setField('shipping', $point->name());
            if($product->addressId) {
                $address = $cart->addresses()->get($product->addressId);
                $entity->setField('zip', $address->zip);
                $entity->setField('countryId', $address->countryId);
                $entity->setField('regionId', $address->regionId);
                $entity->setField('cityId', $address->cityId);
            } elseif($product->cityId) {
                /** @var \Parishop\ORMWrappers\City\Entity $city */
                $city = $this->builder->components()->orm()->query('city')->in($product->cityId)->findOne();
                if($city) {
                    $entity->setField('zip', null);
                    $entity->setField('countryId', $city->region()->countryId);
                    $entity->setField('regionId', $city->regionId);
                    $entity->setField('cityId', $city->id());
                }
            }
        }
        $actionId = $cart->actions()->get() ? $cart->actions()->get()->id() : null;
        $cardId   = $cart->cards()->get()->id();
        $entity->setField('orderStatusId', '1');
        $entity->setField('customerId', $cart->customer()->id());
        $entity->setField('paymentId', $paymentId);
        $entity->setField('actionId', $actionId);
        $entity->setField('customerCardId', $cardId ? $cardId : null);
        $entity->setField('invoice', time());
        $entity->setField('lastname', $cart->customer()->lastname());
        $entity->setField('firstname', $cart->customer()->firstname());
        $entity->setField('middlename', $cart->customer()->middlename());
        $entity->setField('email', $cart->customer()->email());
        $entity->setField('phone', $cart->customer()->phone());
        $entity->setField('total_amount', $order->products()->totals()->amount()->total());
        $entity->setField('total_shipping', $order->products()->totals()->shipping()->total());
        $entity->setField('total_action', $order->products()->totals()->action()->total());
        $entity->setField('total_card', $order->products()->totals()->card()->total());
        $entity->setField('total_total', $order->products()->totals()->total()->total());
        $entity->setField('total_bonuses', $order->products()->totals()->bonuses()->total());
        $entity->setField('created', date('Y-m-d H:i:s'));
        $entity->setField('modified', date('Y-m-d H:i:s'));
        $entity->save();
        foreach($order->products() as $product) {
            $orderEntity = null;
            if($product instanceof \Meling\Cart\Products\Option) {
                /** @var \Parishop\ORMWrappers\OrderOption\Entity $orderEntity */
                $orderEntity           = $this->builder->components()->orm()->createEntity('orderOption');
                $orderEntity->optionId = $product->option()->id();
                $orderEntity->name     = $product->option()->product()->name();
                $orderEntity->par      = $product->option()->product()->par;
                $orderEntity->actionId = $order->products()->provider()->actions()->get()->id() ? $order->products()->provider()->actions()->get()->id() : $product->action() ? $product->action()->id() : null;
            } elseif($product instanceof \Meling\Cart\Products\Certificate) {
                /** @var \Parishop\ORMWrappers\OrderCertificates\Entity $orderEntity */
                $orderEntity                = $this->builder->components()->orm()->createEntity('orderCertificate');
                $orderEntity->certificateId = $product->certificate()->id();
            }
            if($orderEntity) {
                $orderEntity->orderId      = $entity->id();
                $orderEntity->pointId      = $entity->shopId . $entity->shopTariffId;
                $orderEntity->shopId       = $entity->shopId;
                $orderEntity->shopTariffId = $entity->shopTariffId;
                $orderEntity->cityId       = $entity->cityId;
                $orderEntity->addressId    = $entity->addressId;
                $orderEntity->pvz          = $entity->pvz;
                $orderEntity->price        = $product->price();
                $orderEntity->final        = $product->priceFinal() / $product->quantity();
                $orderEntity->quantity     = $product->quantity();
                $orderEntity->total        = $product->priceTotal();
                $orderEntity->modified     = date('Y-m-d H:i:s');
                $orderEntity->save();
                if($product instanceof \Meling\Cart\Products\Option) {
                    $cart->products()->removeOption($product->id());
                }
                if($product instanceof \Meling\Cart\Products\Certificate) {
                    $cart->products()->removeCertificate($product->id());
                }
            }
        }
        $this->builder->components()->email()->sendTemplate('createOrder', $entity->email, array('order' => $entity));
        $entity->createXML();

        return $entity;
    }

    public function work()
    {
        static $orders;
        if($orders === null) {
            $orders = $this->query()->relatedTo('orderStatus', array(1, 2, 3, 10))->find();
        }

        return $orders;
    }

}
