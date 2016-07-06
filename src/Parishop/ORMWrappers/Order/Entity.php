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
 * @property int                                                                   total_bonuses
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
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderOptions
 * @property \PHPixie\ORM\Relationships\Type\OneTo\Type\Many\Property\Entity\Items $orderCertificates
 * @property string                                                                shipping
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
 * @method \PHPixie\ORM\Loaders\Loader\Proxy\Editable|\Parishop\ORMWrappers\OrderOption\Entity[] orderOptions()
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
     * @param bool|false $done
     */
    public function createXML($done = false)
    {
        $writer  = new \Sabre\Xml\Writer();
        $path    = $this->builder->frameworkBuilder()->assets()->assetsRoot()->path() . 'flow/orders/';
        $postfix = '_-146541850';
        if($done) {
            if($this->shopId) {
                $postfix = '_' . $this->shopId;
            }
            $postfix .= '_done';
        }
        if(!is_dir($path)) {
            @mkdir($path, 0755, true);
        }
        $fp = fopen($path . $this->id() . $postfix . '.xml', 'w');
        fclose($fp);
        $writer->openURI($path . $this->id() . $postfix . '.xml');
        $writer->startDocument('1.0', 'utf-8');
        $writer->setIndent(true);
        $writer->startElement('order');
        $writer->writeAttribute('order_id', $this->id());
        $writer->writeAttribute('created', date('d.m.Y H:i:s'));
        $writer->writeElement('customer_id', $this->customerId);
        $writer->writeElement(
            'user_id', $this->customer()->customerClient() ? $this->customer()->customerClient()->id() : ''
        );
        $writer->writeElement('firstname', $this->firstname);
        $writer->writeElement('lastname', $this->lastname);
        $writer->writeElement('birthday', $this->customer()->birthday());
        $writer->writeElement('marriage', $this->customer()->marriage());
        $writer->writeElement('email', $this->email);
        $writer->writeElement('telephone', $this->phone);
        $writer->writeElement('address', $this->pvz);
        $shipping_method = array('name' => 'shipping_method');
        if($this->shopId) {
            $shipping_method['attributes'] = array('shop_id' => $this->shopId);
        }
        $pvz = '';
        if($this->pvz) {
            $pvz = ' ' . $this->pvz;
        }
        if($this->delivery()) {
            $deliveryName = $this->delivery()->name();
        } else {
            $deliveryName = 'Самовывоз';
        }
        $shipping_method['value'] = $deliveryName . '. ' . $pvz;
        $writer->write(array($shipping_method));
        $payment = $this->builder->components()->orm()->payment->in($this->paymentId)->findOne();
        if($payment) {
            $writer->writeElement(
                'payment_method', $payment->name()
            );
        }
        $writer->writeElement('sub_total', $this->total_amount);
        $writer->writeElement('shipping', $this->total_shipping);
        $writer->startElement('card');
        if($this->customerCardId) {
            $writer->writeAttribute('id', $this->customerCardId);
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
        $bonuses = array();
        if($this->total_bonuses) {
            $bonuses[] = array('name' => 'bonus', 'value' => $this->total_bonuses);
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
        $writer->startElement('products');
        foreach($this->orderOptions() as $product) {
            for($i = 1; $i <= $product->quantity; $i++) {
                $writer->startElement('product');
                $writer->writeAttribute('product_option_id', $product->optionId);
                $writer->writeAttribute('action_id', $product->actionId);
                $writer->writeAttribute('quantity', 1);
                $writer->writeAttribute('price', $product->final);
                $writer->writeAttribute('base_price', $product->price);
                $writer->endElement();
            }
        }
        $writer->endElement();
        $writer->startElement('certificates');
        foreach($this->orderCertificates() as $product) {
            for($i = 1; $i <= $product->quantity; $i++) {
                $writer->startElement('certificate');
                $writer->writeAttribute('certificateId', $product->certificateId);
                $writer->writeAttribute('quantity', 1);
                $writer->writeAttribute('price', $product->final);
                $writer->writeAttribute('base_price', $product->price);
                $writer->endElement();
            }
        }
        $writer->endElement();
        $writer->endElement();
        $writer->flush();
        unset($writer);
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
