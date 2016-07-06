<?php
namespace Meling\Cart\Products;

/**
 * Class Session
 * @package Meling\Cart\Providers\Products
 */
class Session extends \Meling\Cart\Products
{
    protected $models;

    protected $session;

    /**
     * @param    \Meling\Cart\Providers\Provider $provider
     * @param \PHPixie\HTTP\Context\Session      $session
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider, \PHPixie\HTTP\Context\Session $session)
    {
        parent::__construct($provider);
        $this->session = $session;
        foreach($this->provider->models()->asArray() as $model) {
            foreach($this->session->get($model->plural(), array()) as $product) {
                /** @var \Parishop\ORMWrappers\Entity $entity */
                if($entity = $model->load($product['id'])) {
                    $product = $model->buildProduct(
                        $this,
                        $entity,
                        $product['id'],
                        $product['quantity'],
                        $product['price'],
                        $product['shopId'],
                        $product['shopTariffId'],
                        $product['cityId'],
                        $product['addressId'],
                        $product['pvz']
                    );
                    $this->offsetSet($product->id(), $product);
                }
            }
        }
    }

    public function session()
    {
        return $this->session;
    }

    protected function save()
    {
        $models = array();
        foreach($this->asArray() as $product) {
            $models[$product->model()->plural()][$product->id()] = array(
                'id'           => $product->id(),
                'quantity'     => $product->quantity(),
                'price'        => $product->price(),
                'shopId'       => $product->shopId(),
                'shopTariffId' => $product->shopTariffId(),
                'cityId'       => $product->cityId(),
                'addressId'    => $product->addressId(),
                'pvz'          => $product->pvz(),
            );
        }
        foreach($this->provider->models()->asArray() as $model) {
            $this->session->set($model->plural(), isset($models[$model->plural()]) && is_array($models[$model->plural()]) ? $models[$model->plural()] : array());
        }
    }

    protected function saveAdd($product)
    {
        $this->save();
    }

    protected function saveClear()
    {
        $this->save();
    }

    protected function saveRemove($product)
    {
        $this->save();
    }
}
