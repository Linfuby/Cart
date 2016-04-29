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
     * @param \Parishop\ORMWrappers\Customer\Entity $customer
     * @param int                                   $status_id
     * @param int                                   $deliveryId
     * @param int                                   $paymentId
     * @param \Parishop\ORMWrappers\Address\Entity  $address
     * @param string                                $pvz
     * @param \Meling\Cart\Shops\Shop               $shop
     * @param string                                $card_id
     * @param string                                $actionId
     * @param \Meling\Cart\Totals                   $totals
     * @param array                                 $data
     * @return Entity
     */
    public function createOrder(
        $customer,
        $status_id,
        $deliveryId,
        $paymentId,
        $address,
        $pvz,
        $shop,
        $card_id,
        $actionId,
        $totals,
        $data = array())
    {
        $order                 = $this->create();
        $order->customerId     = $customer->id();
        $order->email          = $customer->email;
        $order->orderStatusId  = $status_id;
        $order->invoice        = time();
        $order->deliveryId     = $deliveryId;
        $order->paymentId      = $paymentId;
        $order->addressId      = $address ? $address->id() : null;
        $order->lastname       = $address ? $address->lastname : $customer->lastname;
        $order->firstname      = $address ? $address->firstname : $customer->firstname;
        $order->middlename     = $address ? $address->middlename : $customer->middlename;
        $order->phone          = $address && $address->phone ? $address->phone : $customer->phone;
        $order->zip            = $address ? $address->zip : null;
        $order->countryId      = $address ? $address->countryId : null;
        $order->regionId       = $address ? $address->regionId : null;
        $order->cityId         = $address ? $address->cityId : null;
        $order->city_name      = $address ? $address->city_name : null;
        $order->street         = $address ? $address->street : null;
        $order->shopId         = $shop->id();
        $order->pvz            = $pvz;
        $order->card_id        = $card_id;
        $order->actionId       = $actionId;
        $order->total_amount   = $totals->amount()->total();
        $order->total_shipping = $totals->shipping()->total();
        $order->total_card     = $totals->card()->total();
        $order->total_action   = $totals->action()->total();
        $order->total_total    = $totals->total()->total();
        $order->total_rewards  = $totals->rewards()->total();
        $order->modified       = date(DATE_W3C);
        foreach($data as $key => $value) {
            $order->setField($key, $value);
        }
        $order->save();
        $products = array();
        foreach($totals->products() as $product) {
            /**
             * @var \Parishop\ORMWrappers\OrderProduct\Entity $orderProduct
             */
            $repositoryOrderProduct = $this->builder->components()->orm()->repository('orderProduct');
            $orderProduct           = $repositoryOrderProduct->create();
            $orderProduct->orderId  = $order->id();
            $orderProduct->optionId = $product->option()->id();
            $orderProduct->name     = $product->option()->product()->name();
            $orderProduct->par      = $product->option()->product()->par;
            $orderProduct->quantity = $product->quantity();
            $orderProduct->price    = $product->total();
            $orderProduct->total    = $product->total();
            $orderProduct->save();
            $products[] = $orderProduct;
        }

        return $order;
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
