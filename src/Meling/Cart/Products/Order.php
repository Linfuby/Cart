<?php
namespace Meling\Cart\Products;

/**
 * Class Order
 * @package Meling\Cart\Providers\Products
 */
class Order extends \Meling\Cart\Products
{
    protected $order;

    protected $models;

    /**
     * @param \Meling\Cart\Providers\Provider    $provider
     * @param \Parishop\ORMWrappers\Order\Entity $order
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, \Parishop\ORMWrappers\Order\Entity $order)
    {
        parent::__construct($provider);
        $this->order = $order;
        foreach($this->provider->models()->asArray() as $model) {
            /** @var \Parishop\ORMWrappers\Entity $order */
            foreach($this->order->{$model->relationShips('order')}() as $order) {
                $product = $model->buildProduct(
                    $this,
                    $order->{$model->modelName()}(),
                    $order->{$model->fieldId()},
                    $order->getField('quantity'),
                    $order->getField('price'),
                    $order->getField('shopId'),
                    $order->getField('shopTariffId'),
                    $order->getField('cityId'),
                    $order->getField('addressId'),
                    $order->getField('pvz')
                );
                $this->offsetSet($product->id(), $product);
            }
        }
    }

    /**
     * @return \Parishop\ORMWrappers\Order\Entity
     */
    public function entity()
    {
        return $this->order;
    }

    /**
     * @param Product $product
     */
    protected function saveAdd($product)
    {
        /** @var \Parishop\ORMWrappers\Entity $cart */
        if(!($cart = $this->provider->orm()->query($product->model()->relationShip('order'))->where('orderId', $this->entity()->id())->where($product->model()->fieldId(), $product->id())->findOne())) {
            $cart = $this->provider->orm()->createEntity($product->model()->relationShip('order'));
            $cart->setField('orderId', $this->entity()->id());
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
            $this->order->{$model->relationShips('order')}->query()->delete();
            $this->order->{$model->relationShips('order')}->reload();
        }
    }

    /**
     * @param Product $product
     */
    protected function saveRemove($product)
    {
        $this->order->{$product->model()->relationShips('order')}->query()->where('orderId', $this->entity()->id())->where($product->model()->fieldId(), $product->id())->delete();
        $this->order->{$product->model()->relationShips('order')}->reload();
    }

}

