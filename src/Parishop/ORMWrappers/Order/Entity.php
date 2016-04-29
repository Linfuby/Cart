<?php
namespace Parishop\ORMWrappers\Order;

/**
 * Class Entity
 * @property int                                                                   id
 * @property int                                                                   orderStatusId
 * @property int                                                                   customerId
 * @property int                                                                   shopId
 * @property int                                                                   shopTariffId
 * @property string                                                                deliveryId
 * @property string                                                                paymentId
 * @property string                                                                actionId
 * @property string                                                                customerCardId
 * @property int                                                                   addressId
 * @property int                                                                   invoice
 * @property string                                                                url
 * @property string                                                                lastname
 * @property string                                                                firstname
 * @property string                                                                middlename
 * @property string                                                                email
 * @property int                                                                   phone
 * @property int                                                                   zip
 * @property int                                                                   countryId
 * @property int                                                                   regionId
 * @property int                                                                   cityId
 * @property string                                                                street
 * @property string                                                                pvz
 * @property string                                                                payment
 * @property string                                                                comment
 * @property int                                                                   total_amount
 * @property int                                                                   total_shipping
 * @property int                                                                   total_card
 * @property int                                                                   total_action
 * @property int                                                                   total_total
 * @property int                                                                   total_rewards
 * @property string                                                                ip
 * @property string                                                                user_agent
 * @property string                                                                created
 * @property string                                                                modified
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $orderStatus
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customer
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shop
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $shopTariff
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $action
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $customerCard
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $address
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $country
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $region
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Owner $city
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderHistories
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderProducts
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderCertificates
 * @method \Parishop\ORMWrappers\OrderStatus\Entity orderStatus()
 * @method \Parishop\ORMWrappers\Customer\Entity customer()
 * @method \Parishop\ORMWrappers\Shop\Entity shop()
 * @method \Parishop\ORMWrappers\ShopTariff\Entity shopTariff()
 * @method \Parishop\ORMWrappers\Delivery\Entity delivery()
 * @method \Parishop\ORMWrappers\Payment\Entity payment()
 * @method \Parishop\ORMWrappers\Action\Entity action()
 * @method \Parishop\ORMWrappers\CustomerCard\Entity customerCard()
 * @method \Parishop\ORMWrappers\Address\Entity address()
 * @method \Parishop\ORMWrappers\Country\Entity country()
 * @method \Parishop\ORMWrappers\Region\Entity region()
 * @method \Parishop\ORMWrappers\City\Entity city()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\OrderHistory\Entity[] orderHistories()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\OrderProduct\Entity[] orderProducts()
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\OrderCertificates\Entity[] orderCertificates()
 * @package    ORMWrappers
 * @subpackage Entity
 */
class Entity extends \Parishop\ORMWrappers\Entity
{
    public function cityId()
    {
        return $this->city() ? $this->city()->id() : null;
    }

    public function cityName()
    {
        return $this->city() ? $this->city()->name() : null;
    }

    public function countryId()
    {
        return $this->country() ? $this->country()->id() : null;
    }

    public function countryName()
    {
        return $this->country() ? $this->country()->name() : null;
    }

    /**
     * @param \Meling\Cart $cart
     * @param bool|false   $done
     */
    public function createXML($cart, $done = false)
    {
        $writer  = new \Sabre\Xml\Writer();
        $path    = $this->builder->frameworkBuilder()->assets()->assetsRoot()->path();
        $postfix = '_-146541850';
        if($done) {
            if($this->shopId) {
                $postfix = '_' . $this->shopId;
            }
            $postfix .= '_done';
        }
        $fp = fopen($path . 'export/' . $this->id() . $postfix . '.xml', 'w');
        fclose($fp);
        $writer->openURI($path . 'export/' . $this->id() . $postfix . '.xml');
        $writer->startDocument('1.0', 'utf-8');
        $writer->setIndent(true);
        $writer->startElement('order');
        $writer->writeAttribute('orderId', $this->id());
        $writer->writeAttribute('created', date('d.m.Y H:i:s'));
        $writer->writeElement('customerId', $this->customerId);
        $writer->writeElement(
            'userId', $this->customer()->customerClient() ? $this->customer()->customerClient()->id() : ''
        );
        $writer->writeElement('firstname', $this->firstname);
        $writer->writeElement('lastname', $this->lastname);
        $writer->writeElement('birthday', $this->customer()->birthday());
        $writer->writeElement('marriage', $this->customer()->marriage());
        $writer->writeElement('email', $this->email);
        $writer->writeElement('telephone', $this->phone);
        $writer->writeElement(
            'address', $this->zip . ', ' . $this->countryName() . ', ' . $this->regionName() . ', ' . $this->cityName() . ', ' . $this->street
        );
        $shipping_method = array(
            'name' => 'shipping_method',
        );
        if($this->shopId) {
            $shipping_method['attributes'] = array('shopId' => $this->shopId);
        }
        $pvz = '';
        if($this->pvz) {
            $pvz = ' ' . $this->pvz;
        }
        $shipping_method['value'] = $cart->shipping()->get($this->shipping_code)->name() . $pvz;
        $writer->write(array($shipping_method));
        $writer->writeElement(
            'payment_method', $cart->payments()->get($this->payment_code)->name()
        );
        $writer->writeElement('sub_total', $this->total_amount);
        $writer->writeElement('shipping', $this->total_shipping);
        $writer->startElement('card');
        if($this->customer()->priorityCard()) {
            $writer->writeAttribute('id', $this->customer()->priorityCard()->id());
        }
        $writer->write($this->total_card);
        $writer->endElement();
        $writer->startElement('action');
        if($this->actionId) {
            $writer->writeAttribute('id', $this->actionId);
        }
        $writer->write($this->total_action);
        $writer->endElement();
        $writer->writeElement('total', $this->total_total);
        /**
         * TODO-Linfuby: Определить начисление и передачу бонусов
         */
        $bonuses = array();
        foreach($cart->rewards()->bonuses() as $id => $value) {
            $bonuses[] = array('name' => 'bonus', 'value' => $value, 'attributes' => array('id' => $id));
        }

        $rewards = 0;
        if($this->customer()->customerRewards()) {
            foreach($this->customer()->customerRewards() as $reward) {
                $rewards += (int)$reward->rewards;
            }
        }
        if($rewards) {
            $bonuses[] = array('name' => 'bonus', 'value' => $rewards, 'attributes' => array('id' => -1));
        }
        $writer->writeElement('bonuses', $bonuses);
        /**
         * @var \Parishop\ORMWrappers\Order\Product\Entity $product
         */
        $writer->startElement('products');
        foreach($this->orderProducts() as $product) {
            $writer->startElement('product');
            $writer->writeAttribute('optionId', $product->optionId);
            $writer->writeAttribute('quantity', $product->quantity);
            $writer->writeAttribute('price', $product->total_price);
            $writer->writeAttribute('base_price', $product->price);
            $writer->endElement();
        }
        $writer->endElement();
        $writer->endElement();
        $writer->flush();
        unset($writer);
    }

    /**
     * @param \Meling\Cart\Orders\Order $cartOrder
     * @param array                     $data
     */
    public function editOrder($cartOrder, $data = array())
    {
        $this->customerId     = $cartOrder->customer()->id();
        $this->email          = $cartOrder->customer()->email;
        $this->deliveryId     = $cartOrder->deliveryId();
        $this->paymentId      = $cartOrder->paymentId();
        $this->addressId      = $cartOrder->address() ? $cartOrder->address()->id() : null;
        $this->lastname       = $cartOrder->address() ? $cartOrder->address()->lastname : $cartOrder->customer()->lastname;
        $this->firstname      = $cartOrder->address() ? $cartOrder->address()->firstname : $cartOrder->customer()->firstname;
        $this->middlename     = $cartOrder->address() ? $cartOrder->address()->middlename : $cartOrder->customer()->middlename;
        $this->phone          = $cartOrder->address() && $cartOrder->address()->phone ? $cartOrder->address()->phone : $cartOrder->customer()->phone;
        $this->zip            = $cartOrder->address() ? $cartOrder->address()->zip : null;
        $this->countryId      = $cartOrder->address() ? $cartOrder->address()->countryId : null;
        $this->regionId       = $cartOrder->address() ? $cartOrder->address()->regionId : null;
        $this->cityId         = $cartOrder->address() ? $cartOrder->address()->cityId : null;
        $this->street         = $cartOrder->address() ? $cartOrder->address()->street : null;
        $this->shopId         = $cartOrder->shopId();
        $this->pvz            = $cartOrder->pvz();
        $this->customerCardId = $cartOrder->cardId();
        $this->total_action   = $cartOrder->actionId();
        $this->total_amount   = $cartOrder->totals()->amount()->total();
        $this->total_shipping = $cartOrder->totals()->shipping()->total();
        $this->total_card     = $cartOrder->totals()->card()->total();
        $this->total_action   = $cartOrder->totals()->action()->total();
        $this->total_total    = $cartOrder->totals()->total()->total();
        $this->total_rewards  = $cartOrder->totals()->rewards()->total();
        $this->modified       = date(DATE_W3C);
        foreach($data as $key => $value) {
            $this->setField($key, $value);
        }
        $this->save();
    }

    /**
     * Возвращает ФИО покупателя
     * @return string
     */
    public function fio()
    {
        return implode(' ', array($this->lastname, $this->firstname, $this->middlename));
    }

    /**
     * @return \PHPixie\ORM\Loaders\Loader\Proxy\Caching
     */
    public function histories()
    {
        /**
         * @var \Parishop\ORMWrappers\OrderHistory\Query $history
         */
        $history = $this->orderHistories->query();
        $history->ordering();

        return $history->find(array('user'));
    }

    public function name()
    {
        return $this->id;
    }

    public function regionId()
    {
        return $this->region() ? $this->region()->id() : null;
    }

    public function regionName()
    {
        return $this->region() ? $this->region()->name() : null;
    }

    public function save()
    {
        /** @var \PHPixie\ORM\Data\Types\Map $data */
        $data = $this->data();
        /** @var \PHPixie\ORM\Data\Diff $diff */
        $diff      = $data->diff();
        $histories = array();
        foreach($diff->set() as $key => $value) {
            switch($key) {
                case 'orderStatusId':
                    $histories[$key] = $this->orderStatus()->name();
                    break;
            }
        }
        $entity = parent::save();
        $this->orderStatus->reload();
        foreach($histories as $key => $value) {
            switch($key) {
                case 'orderStatusId':
                    // Добавляем в историю изменение Статуса заказа
                    $this->builder->components()->orm()->repository('orderHistory')->create(
                        array(
                            'orderId'   => $this->id(),
                            'userId'    => $this->builder->components()->auth()->domain()->user()->id(),
                            'name'      => 'Статус заказа',
                            'value_old' => $value,
                            'value_new' => $this->orderStatus()->name(),
                        )
                    )->save();
                    break;
            }
        }
        unset($histories);

        return $entity;
    }

    public function url($url = array(), $query = array(), $resolverPath = null)
    {
        return parent::url(
            array(
                'processor' => 'orders',
                'action'    => 'order',
                'id'        => $this->id(),
            ), $query, $resolverPath
        );
    }

}
