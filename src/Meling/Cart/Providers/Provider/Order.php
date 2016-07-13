<?php
namespace Meling\Cart\Providers\Provider;

/**
 * Class Order
 * @package Meling\Cart\Providers\Provider
 */
class Order extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Parishop\ORMWrappers\Order\Entity
     */
    protected $order;

    protected $points;

    /**
     * Customer constructor.
     * @param \PHPixie\ORM                       $orm
     * @param \Parishop\ORMWrappers\Order\Entity $order
     * @param mixed                              $cityId
     * @param mixed                              $actionId
     */
    public function __construct(\PHPixie\ORM $orm, $order, $cityId, $actionId)
    {
        parent::__construct($orm, $cityId, $actionId);
        $this->order = $order;
    }

    /**
     * @return \DateTime
     */
    public function actionsBirthday()
    {
        $fieldBirthday = $this->order->customer()->getRequiredField('birthday');
        if(!$fieldBirthday || $fieldBirthday == '0000-00-00') {
            return null;
        }
        $fieldBirthdayUse = $this->order->customer()->getRequiredField('birthday_use');
        if($fieldBirthdayUse && $fieldBirthdayUse != '0000-00-00') {
            if(date('Y') == date_create_from_format('Y-m-d', $fieldBirthdayUse)->format('Y')) {
                return null;
            }

            return new \DateTime($fieldBirthday);
        }

        return new \DateTime($fieldBirthday);
    }

    /**
     * @return \DateTime
     */
    public function actionsDate()
    {
        return new \DateTime($this->order->created);
    }

    /**
     * @return \DateTime
     */
    public function actionsMarriage()
    {
        $fieldMarriage = $this->order->customer()->getRequiredField('marriage');
        if(!$fieldMarriage || $fieldMarriage == '0000-00-00') {
            return null;
        }
        $fieldMarriageUse = $this->order->customer()->getRequiredField('marriage_use');
        if($fieldMarriageUse && $fieldMarriageUse != '0000-00-00') {
            if(date('Y') == date_create_from_format('Y-m-d', $fieldMarriageUse)->format('Y')) {
                return null;
            }

            return new \DateTime($fieldMarriage);
        }

        return new \DateTime($fieldMarriage);

    }

    public function addresses()
    {
        if($this->addresses === null) {
            $this->addresses = new \Meling\Cart\Addresses($this->order->customer()->addresses()->asArray());
        }

        return $this->addresses;
    }

    public function cards()
    {
        if($this->cards === null) {
            $this->cards = new \Meling\Cart\Cards($this->order->customer()->customerCards()->asArray());
        }

        return $this->cards;
    }

    public function city($cityId = null)
    {
        if($cityId === null) {
            return $this->order->city();
        }

        return parent::city($cityId);
    }

    public function customer()
    {
        return $this->order->customer();
    }

    public function email()
    {
        return $this->order->getRequiredField('email');
    }

    public function firstname()
    {
        return $this->order->getRequiredField('firstname');
    }

    public function id()
    {
        return $this->order->id();
    }

    public function lastname()
    {
        return $this->order->getRequiredField('lastname');
    }

    public function middlename()
    {
        return $this->order->getRequiredField('middlename');
    }

    public function order()
    {
        return $this->order;
    }

    public function phone()
    {
        return $this->order->getRequiredField('phone');
    }

    /**
     * @return \Meling\Cart\Points
     */
    public function points()
    {
        if($this->points === null) {
            if($product = $this->products()->current()) {
                $product->setCityId($this->city()->id());
                $this->points = $product->points();
            } else {
                $this->points = new \Meling\Cart\Points($this->order()->cityId);
            }
            if($this->order()->shop()->pickup_point) {
                try {
                    // Пытаемся найти этот магазин среди добавленных
                    $point = $this->points->shops()->get($this->order()->shop()->id());
                } catch(\Exception $e) {
                    // Добавляем новый магазин в список доступных ПВЗ
                    $point = $this->points->shops()->set($this->order()->shop()->id(), $this->order()->shop());
                }
                $point->products()->offsetSet($product->id(), 1);
                $this->points->set($point->id(), $point);
            }
            foreach($this->order()->shop()->shopTariffs() as $shopTariff) {
                if($shopTariff->success($this->points->city())) {
                    try {
                        $point = $this->points->deliveries()->get($shopTariff->shopId . $shopTariff->id);
                    } catch(\Exception $e) {
                        $point = $this->points->deliveries()->set($shopTariff->shopId . $shopTariff->id, $shopTariff, $this->order()->shopTariffId == $shopTariff->id ? $this->order()->pvz : '');
                    }
                    $this->points->set($point->id(), $point);
                }
            }
        }

        return $this->points;
    }

    protected function buildProducts()
    {
        return new \Meling\Cart\Products\Order($this, $this->order());
    }


}
