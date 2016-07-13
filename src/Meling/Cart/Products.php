<?php
namespace Meling\Cart;

/**
 * Class Products
 * @package Meling\Cart
 */
abstract class Products extends \ArrayObject
{
    /** @var Providers\Provider */
    protected $provider;

    /** @var int */
    protected $quantity;

    /** @var Totals */
    protected $totals;

    /**
     * @param Providers\Provider $provider
     */
    public function __construct(Providers\Provider $provider)
    {
        $this->provider = $provider;
        parent::__construct(array());
    }

    /**
     * @param string $id
     * @param int    $quantity
     * @param int    $price
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return Products\Product\Certificate
     * @throws \Exception
     */
    public function addCertificate($id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        try {
            $product = $this->get($id);
            $product->setQuantity($product->quantity() + $quantity);
            if($price !== null) {
                $product->setPrice($price);
            }
            $product->setShopId($shopId);
            $product->setShopTariffId($shopTariffId);
            $product->setCityId($cityId);
            $product->setAddressId($addressId);
            $product->setPvz($pvz);
        } catch(\Exception $e) {
            $model       = $this->provider->models()->certificate();
            $certificate = $model->load($id);
            if($price === null) {
                $price = $certificate->price;
            }
            $product = $model->buildProduct($this, $certificate, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        }
        $this->offsetSet($product->id(), $product);
        $this->saveAdd($product);
        $this->quantity = null;

        return $product;
    }

    /**
     * @param string $id
     * @param int    $quantity
     * @param int    $price
     * @param string $shopId
     * @param string $shopTariffId
     * @param string $cityId
     * @param string $addressId
     * @param string $pvz
     * @return Products\Product\Option
     * @throws \Exception
     */
    public function addOption($id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = null)
    {
        try {
            $product = $this->get($id);
            $product->setQuantity($product->quantity() + $quantity);
            if($price !== null) {
                $product->setPrice($price);
            }
            $product->setShopId($shopId);
            $product->setShopTariffId($shopTariffId);
            $product->setCityId($cityId);
            $product->setAddressId($addressId);
            $product->setPvz($pvz);
        } catch(\Exception $e) {
            $model  = $this->provider->models()->option();
            $option = $model->load($id);
            if($price === null) {
                $price = $option->price;
            }
            $product = $model->buildProduct($this, $option, $id, $quantity, $price, $shopId, $shopTariffId, $cityId, $addressId, $pvz);
        }
        $this->offsetSet($product->id(), $product);
        $this->saveAdd($product);
        $this->quantity = null;

        return $product;
    }

    /**
     * @return Products\Product[]
     */
    public function asArray()
    {
        return $this->getIterator();
    }

    public function city($cityId = null)
    {
        return $this->provider->city($cityId);
    }

    public function clear()
    {
        parent::exchangeArray(array());
        $this->saveClear();
    }

    /**
     * @return Products\Product
     */
    public function current()
    {
        return $this->getIterator()->current();
    }

    /**
     * @param mixed $id
     * @return Products\Product
     * @throws \Exception
     */
    public function get($id)
    {
        if($this->offsetExists($id)) {
            return $this->offsetGet($id);
        }
        throw new \Exception('Product ' . $id . ' does not exist');
    }

    public function quantity()
    {
        if($this->quantity === null) {
            $this->quantity = 0;
            foreach($this->asArray() as $product) {
                $this->quantity += $product->quantity();
            }
        }

        return $this->quantity;
    }

    /**
     * @param string $id
     */
    public function remove($id)
    {
        try {
            $product = $this->get($id);
            $this->offsetUnset($id);
            $this->saveRemove($product);
        } catch(\Exception $e) {

        }
    }

    public function totals()
    {
        if($this->totals === null) {
            $this->totals = new Totals($this, $this->provider->actionsAfter(), $this->provider->cards()->get(), $this->provider->actions()->get());
        }

        return $this->totals;
    }

    protected abstract function saveAdd($product);

    protected abstract function saveClear();

    protected abstract function saveRemove($product);

}
