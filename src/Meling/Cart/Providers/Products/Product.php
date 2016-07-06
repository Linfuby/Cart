<?php
namespace Meling\Cart\Providers\Products;

/**
 * Class Product
 * @package Meling\Cart\Providers\Products
 */
abstract class Product
{
    /** @var \PHPixie\ORM\Configs\Inflector */
    protected $inflector;

    /**
     * Product constructor.
     *
     * @param \PHPixie\ORM\Configs\Inflector $inflector
     */
    public function __construct(\PHPixie\ORM\Configs\Inflector $inflector)
    {
        $this->inflector = $inflector;
    }

    /**
     * @return string
     */
    public function plural()
    {
        return $this->inflector->plural($this->modelName());
    }

    public function relationShip($prefix)
    {
        return $prefix . ucfirst($this->plural());
    }

    /**
     * @return string
     */
    protected abstract function modelName();

}

