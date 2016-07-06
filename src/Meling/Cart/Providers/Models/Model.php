<?php
namespace Meling\Cart\Providers\Models;

abstract class Model
{
    /** @var \Meling\Cart\Providers\Models */
    protected $models;

    protected $plural;

    /**
     * Model constructor.
     * @param \Meling\Cart\Providers\Models $models
     */
    public function __construct(\Meling\Cart\Providers\Models $models)
    {
        $this->models = $models;
    }

    /**
     * @return string
     */
    public function fieldId()
    {
        return $this->modelName() . 'Id';
    }

    public function findOne($modelName, $id)
    {
        return $this->models->orm()->query($modelName)->in($id)->findOne();
    }

    /**
     * @param $id
     * @return \Parishop\ORMWrappers\Entity
     */
    public function load($id)
    {
        return $this->models->orm()->query($this->modelName())->in($id)->findOne();
    }

    public function plural()
    {
        if($this->plural === null) {
            $this->plural = $this->models->plural($this->modelName());
        }

        return $this->plural;
    }

    public function relationShip($prefix)
    {
        return $prefix . ucfirst($this->modelName());
    }

    public function relationShips($prefix)
    {
        return $prefix . ucfirst($this->plural());
    }

    /**
     * @param \Meling\Cart\Products        $products
     * @param \Parishop\ORMWrappers\Entity $entity
     * @param mixed                        $id
     * @param int                          $quantity
     * @param int                          $price
     * @param mixed                        $shopId
     * @param mixed                        $shopTariffId
     * @param mixed                        $cityId
     * @param mixed                        $addressId
     * @param string                       $pvz
     * @return \Meling\Cart\Products\Product
     */
    public abstract function buildProduct($products, $entity, $id, $quantity = 1, $price = null, $shopId = null, $shopTariffId = null, $cityId = null, $addressId = null, $pvz = '');

    /**
     * @return string
     */
    public abstract function modelName();

}

