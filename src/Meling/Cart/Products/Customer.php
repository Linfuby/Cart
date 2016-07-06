<?php
namespace Meling\Cart\Products;

/**
 * Class Customer
 * @package Meling\Cart\Providers\Products
 */
class Customer extends \Meling\Cart\Products
{
    protected $customer;

    /**
     * @param \Meling\Cart\Providers\Provider       $provider
     * @param \Parishop\ORMWrappers\Customer\Entity $customer
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, \Parishop\ORMWrappers\Customer\Entity $customer)
    {
        parent::__construct($provider);
        $this->customer = $customer;
        foreach($this->provider->models()->asArray() as $model) {
            /** @var \Parishop\ORMWrappers\Entity $cart */
            foreach($this->customer->{$model->relationShips('cart')}() as $cart) {
                $product = $model->buildProduct(
                    $this,
                    $cart->{$model->modelName()}(),
                    $cart->{$model->fieldId()},
                    $cart->getField('quantity'),
                    $cart->getField('price'),
                    $cart->getField('shopId'),
                    $cart->getField('shopTariffId'),
                    $cart->getField('cityId'),
                    $cart->getField('addressId'),
                    $cart->getField('pvz')
                );
                $this->offsetSet($product->id(), $product);
            }
        }
    }

    /**
     * @return \Parishop\ORMWrappers\Customer\Entity
     */
    public function entity()
    {
        return $this->customer;
    }

    /**
     * @param Product $product
     */
    protected function saveAdd($product)
    {
        /** @var \Parishop\ORMWrappers\Entity $cart */
        if(!($cart = $this->provider->orm()->query($product->model()->relationShip('cart'))->where('customerId', $this->entity()->id())->where($product->model()->fieldId(), $product->id())->findOne())) {
            $cart = $this->provider->orm()->createEntity($product->model()->relationShip('cart'));
            $cart->setField('customerId', $this->entity()->id());
            $cart->setField($product->model()->fieldId(), $product->id());
        }
        $cart->setField('quantity', $product->quantity());
        $cart->setField('price', $product->price());
        $cart->setField('shopId', $product->shopId());
        $cart->setField('shopTariffId', $product->shopTariffId());
        $cart->setField('cityId', $product->cityId());
        $cart->setField('addressId', $product->addressId());
        $cart->setField('pvz', $product->pvz());
        $cart->setField('modified', date('Y-m-d H:i:s'));
        $cart->save();
    }

    protected function saveClear()
    {
        foreach($this->provider->models()->asArray() as $model) {
            $this->customer->{$model->relationShips('cart')}->query()->delete();
            $this->customer->{$model->relationShips('cart')}->reload();
        }
    }

    /**
     * @param Product $product
     */
    protected function saveRemove($product)
    {
        $this->customer->{$product->model()->relationShips('cart')}->query()->where('customerId', $this->entity()->id())->where($product->model()->fieldId(), $product->id())->delete();
        $this->customer->{$product->model()->relationShips('cart')}->reload();
    }

}

