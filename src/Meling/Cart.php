<?php
namespace Meling;

/**
 * Class Cart
 * @package Meling
 */
class Cart
{
    /**
     * @type Cart\Builder
     */
    protected $builder;

    /**
     * Cart constructor.
     * @param \Meling\Cart\Providers\Subject     $subject
     * @param \Meling\Cart\Providers\Objects     $objects
     * @param \Meling\Cart\Providers\Environment $environment
     */
    public function __construct($subject, $objects, $environment)
    {
        $this->builder = $this->buildBuilder($subject, $objects, $environment);
    }

    /**
     * @return Cart\Actions
     */
    public function actions()
    {
        return $this->builder->actions();
    }

    /**
     * @return Cart\Cards
     */
    public function cards()
    {
        return $this->builder->cards();
    }

    /**
     * @return Cart\Certificates
     */
    public function certificates()
    {
        return $this->builder->certificates();
    }

    /**
     * @return Cart\Products
     */
    public function products()
    {
        return $this->builder->products();
    }

    /**
     * @return Cart\Totals
     */
    public function totals()
    {
        return $this->builder->totals();
    }

    /**
     * @param \Meling\Cart\Providers\Subject     $subject
     * @param \Meling\Cart\Providers\Objects     $objects
     * @param \Meling\Cart\Providers\Environment $environment
     * @return Cart\Builder
     */
    private function buildBuilder($subject, $objects, $environment)
    {
        return new Cart\Builder($subject, $objects, $environment);
    }

}
