<?php
namespace Meling\Cart\Products;

class Custom extends \Meling\Cart\Products
{
    protected $models;

    protected $session;

    /**
     * @param    \Meling\Cart\Providers\Provider $provider
     */
    public function __construct(\Meling\Cart\Providers\Provider $provider)
    {
        parent::__construct($provider);
    }

    protected function saveAdd($product)
    {

    }

    protected function saveClear()
    {

    }

    protected function saveRemove($product)
    {

    }
}
