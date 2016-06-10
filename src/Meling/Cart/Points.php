<?php
namespace Meling\Cart;

class Points extends \ArrayObject
{
    /**
     * @var \Meling\Cart
     */
    protected $cart;

    /**
     * @var \PHPixie\ORM\Wrappers\Type\Database\Entity
     */
    protected $city;

    /**
     * @var \Meling\Cart\Addresses
     */
    protected $addresses;

    /**
     * @var Points\Shops
     */
    protected $shops;

    /**
     * @var Points\Deliveries
     */
    protected $deliveries;

    /**
     * Points constructor.
     * @param \Meling\Cart                      $cart
     * @param \Parishop\ORMWrappers\City\Entity $city
     * @param \Meling\Cart\Addresses            $addresses
     */
    public function __construct(\Meling\Cart $cart, $city, $addresses)
    {
        $this->cart      = $cart;
        $this->city      = $city;
        $this->addresses = $addresses;
        parent::__construct(array());
    }

    /**
     * @return \ArrayIterator|Points\Point[]
     */
    public function asArray()
    {
        $this->requirePoints();

        return $this->getIterator();
    }

    /**
     * @return Points\Deliveries
     */
    public function deliveries()
    {
        $this->requirePoints();

        return $this->deliveries;
    }

    /**
     * @param $id
     * @return Points\Point
     */
    public function get($id)
    {
        $this->requirePoints();
        if($id && $this->offsetExists($id)) {
            return $this->offsetGet($id);
        }

        return null;
    }

    public function setCity($city)
    {
        $this->city       = $city;
        $this->shops      = null;
        $this->deliveries = null;
    }

    /**
     * @return Points\Shops
     */
    public function shops()
    {
        $this->requirePoints();

        return $this->shops;
    }

    /**
     * @param \Parishop\ORMWrappers\ShopTariff\Entity $shopTariff
     * @return Points\Point\Delivery
     */
    protected function buildDelivery($shopTariff)
    {
        return new Points\Point\Delivery($shopTariff->shopId . $shopTariff->id(), $shopTariff->delivery()->name() . ' (' . $shopTariff->name() . ')', $shopTariff->delivery()->alias, $shopTariff->shop(), $shopTariff, $this->city->id());
    }

    /**
     * @param \Parishop\ORMWrappers\RestOption\Entity $restOption
     * @return Points\Point\Shop
     */
    protected function buildShop($restOption)
    {
        $name       = $restOption->shop()->name();
        $phone      = $restOption->shop()->phone;
        $street     = $restOption->shop()->street;
        $work_times = $restOption->shop()->work_times;

        return new Points\Point\Shop($restOption->shopId, $name, $restOption->shop()->city(), $phone, $street, $work_times, $restOption->shop()->cityId);
    }

    protected function requirePoints()
    {
        if($this->shops !== null && $this->deliveries !== null) {
            return;
        }
        // Формируем список магазинов самовывоза
        $this->shops = new Points\Shops();
        // Формируем список способов доставки
        $this->deliveries = new Points\Deliveries();
        $provider         = $this->cart->providerOrder();
        // Перебираем каждый товар
        foreach($this->cart->products()->asArray() as $product) {
            // Если товар является опцией
            if($product instanceof \Meling\Cart\Products\Option) {
                if($provider instanceof \Meling\Cart\Providers\Order) {
                    if($provider->shop()->pickup_point) {
                        // Если данный пункт отсутствует в точках отправки
                        if(!$this->shops->offsetExists($provider->shop()->id())) {
                            // Добавляем точку отправки
                            $point = new Points\Point\Shop($provider->shop()->id(), $provider->shop()->name(), $provider->shop()->city(), $provider->shop()->phone, $provider->shop()->street, $provider->shop()->work_times, $provider->shop()->cityId);
                            $this->shops->offsetSet($provider->shop()->id(), $point);
                            $this->offsetSet($provider->shop()->id(), $point);
                        }
                        // Добавляем остатки для точки отправки
                        $point = $this->shops->get($provider->shop()->id());
                        $point->rests()->offsetSet($product->option()->id(), 1);
                    }
                    // перебираем все способы доставки
                    foreach($provider->shop()->shopTariffs() as $shopTariff) {
                        // Если способ доставки разрешен для данного города
                        if($shopTariff->success($this->city)) {
                            if(!$this->deliveries->offsetExists($shopTariff->shopId . $shopTariff->id())) {
                                // Добавляем точку отправки
                                $point = $this->buildDelivery($shopTariff);
                                $this->deliveries->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
                                $this->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
                            }
                            // Добавляем остатки для точки отправки
                            $point = $this->deliveries->get($shopTariff->shopId . $shopTariff->id());
                            $point->rests()->offsetSet($product->option()->id(), 1);
                        }
                    }
                }
                // Перебираем остатки
                $this->appendPoints($product->option()->restOptions(), 'optionId');
            }
            // Если товар является сертификатом
            if($product instanceof \Meling\Cart\Products\Certificate) {
                if($provider instanceof \Meling\Cart\Providers\Order) {
                    if($provider->shop()->pickup_point) {
                        // Если данный пункт отсутствует в точках отправки
                        if(!$this->shops->offsetExists($provider->shop()->id())) {
                            // Добавляем точку отправки
                            $point = new Points\Point\Shop($provider->shop()->id(), $provider->shop()->name(), $provider->shop()->city(), $provider->shop()->phone, $provider->shop()->street, $provider->shop()->work_times, $provider->shop()->cityId);
                            $this->shops->offsetSet($provider->shop()->id(), $point);
                            $this->offsetSet($provider->shop()->id(), $point);
                        }
                        // Добавляем остатки для точки отправки
                        $point = $this->shops->get($provider->shop()->id());
                        $point->rests()->offsetSet($product->certificate()->id(), 1);
                    }
                    // Если есть способы доставки
                    if($shopTariffs = $provider->shop()->shopTariffs()) {
                        // перебираем все способы доставки
                        foreach($shopTariffs as $shopTariff) {
                            // Если способ доставки разрешен для данного города
                            if($shopTariff->success($this->city)) {
                                if(!$this->deliveries->offsetExists($shopTariff->shopId . $shopTariff->id())) {
                                    // Добавляем точку отправки
                                    $point = $this->buildDelivery($shopTariff);
                                    $this->deliveries->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
                                    $this->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
                                }
                                // Добавляем остатки для точки отправки
                                $point = $this->deliveries->get($shopTariff->shopId . $shopTariff->id());
                                $point->rests()->offsetSet($product->certificate()->id(), 1);

                                return true;
                            }

                            return false;
                        }
                    }
                }
                // Перебираем остатки
                $this->appendPoints($product->certificate()->restCertificates(), 'certificateId');
            }
            // Если у товара есть точка отправки, но данная точка отсутствует в доступных
            if($product->pointId && !$this->offsetExists($product->pointId)) {
                if($product instanceof \Meling\Cart\Products\Option) {
                    $this->appendPoint($product->shopId, $product->shopTariffId, $product->cityId, $product->addressId, $product->city(), $product->option()->restOptions(), 'optionId');
                }
                if($product instanceof \Meling\Cart\Products\Certificate) {
                    $this->appendPoint($product->shopId, $product->shopTariffId, $product->cityId, $product->addressId, $product->city(), $product->certificate()->restCertificates(), 'certificateId');
                }
            }
        }
    }

    /**
     * @param \Parishop\ORMWrappers\City\Entity                                                    $city
     * @param \Parishop\ORMWrappers\ShopTariff\Entity                                              $shopTariff
     * @param \Parishop\ORMWrappers\RestOption\Entity|\Parishop\ORMWrappers\RestCertificate\Entity $rest
     * @param string                                                                               $key
     * @return bool
     */
    private function appendDelivery($city, $shopTariff, $rest, $key)
    {
        // Если способ доставки разрешен для данного города
        if($shopTariff->success($city)) {
            if(!$this->deliveries->offsetExists($shopTariff->shopId . $shopTariff->id())) {
                // Добавляем точку отправки
                $point = $this->buildDelivery($shopTariff);
                $this->deliveries->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
                $this->offsetSet($shopTariff->shopId . $shopTariff->id(), $point);
            }
            // Добавляем остатки для точки отправки
            $point = $this->deliveries->get($shopTariff->shopId . $shopTariff->id());
            $point->rests()->offsetSet($rest->$key, $rest->quantity);

            return true;
        }

        return false;
    }

    /**
     * @param string                                                                                   $shopId
     * @param string                                                                                   $shopTariffId
     * @param string                                                                                   $cityId
     * @param string                                                                                   $addressId
     * @param \Parishop\ORMWrappers\City\Entity                                                        $city
     * @param \Parishop\ORMWrappers\RestOption\Entity[]|\Parishop\ORMWrappers\RestCertificate\Entity[] $rests
     * @param string                                                                                   $key
     * @throws \Exception
     */
    private function appendPoint($shopId, $shopTariffId, $cityId, $addressId, $city, $rests, $key)
    {
        foreach($rests as $rest) {
            if(!$cityId && !$addressId && $shopId && $shopId == $rest->shopId && $rest->shop()->pickup_point) {
                $this->appendShop($rest, $key);
            }
            if($shopTariffId) {
                foreach($rest->shop()->shopTariffs() as $shopTariff) {
                    if($shopTariffId == $shopTariff->id()) {
                        if($addressId) {
                            $city = $this->addresses->get($addressId)->city();
                        }
                        $this->appendDelivery($city, $shopTariff, $rest, $key);
                    }
                }
            }
        }
    }

    /**
     * @param \Parishop\ORMWrappers\RestOption\Entity[]|\Parishop\ORMWrappers\RestCertificate\Entity[] $rests
     * @param string                                                                                   $key
     */
    private function appendPoints($rests, $key)
    {
        foreach($rests as $rest) {
            // Если магазин является пунктом Самовывоза
            if($rest->shop()->pickup_point) {
                $this->appendShop($rest, $key);
            }
            // Если есть способы доставки
            if($shopTariffs = $rest->shop()->shopTariffs()) {
                // перебираем все способы доставки
                foreach($shopTariffs as $shopTariff) {
                    $this->appendDelivery($this->city, $shopTariff, $rest, $key);
                }
            }
        }
    }

    /**
     * @param \Parishop\ORMWrappers\RestOption\Entity|\Parishop\ORMWrappers\RestCertificate\Entity $rest
     * @param                                                                                      $key
     */
    private function appendShop($rest, $key)
    {
        // Если данный пункт отсутствует в точках отправки
        if(!$this->shops->offsetExists($rest->shopId)) {
            // Добавляем точку отправки
            $point = $this->buildShop($rest);
            $this->shops->offsetSet($rest->shopId, $point);
            $this->offsetSet($rest->shopId, $point);
        }
        // Добавляем остатки для точки отправки
        $point = $this->shops->get($rest->shopId);
        $point->rests()->offsetSet($rest->$key, $rest->quantity);
    }

}
