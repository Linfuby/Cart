<?php
namespace Meling\Cart;

/**
 * Class Builder
 * @package Meling\Cart
 */
class Builder
{
    /**
     * @type array Инициированные классы
     */
    protected $instances = array();

    /**
     * @var Providers\Environment
     */
    protected $environment;

    /**
     * @var Providers\Object
     */
    protected $objects;

    /**
     * @var Providers\Subject
     */
    protected $subject;

    /**
     * Builder constructor.
     * @param \Meling\Cart\Providers\Subject     $subject
     * @param \Meling\Cart\Providers\Objects     $objects
     * @param \Meling\Cart\Providers\Environment $environment
     */
    public function __construct($subject, $objects, $environment)
    {
        $this->subject     = $subject;
        $this->objects     = $objects;
        $this->environment = $environment;
    }

    /**
     * @return Actions
     */
    public function actions()
    {
        return $this->instance('actions');
    }

    /**
     * @return Cards
     */
    public function cards()
    {
        return $this->instance('cards');
    }

    /**
     * @return Certificates
     */
    public function certificates()
    {
        return $this->instance('certificates');
    }

    /**
     * @return Providers\Environment
     */
    public function environment()
    {
        return $this->environment;
    }

    /**
     * @return Products
     */
    public function products()
    {
        return $this->instance('products');
    }

    /**
     * @return Providers\Subject
     */
    public function subject()
    {
        return $this->subject;
    }

    /**
     * @return Totals
     */
    public function totals()
    {
        return $this->instance('totals');
    }

    protected function buildActions()
    {
        return new Actions($this->environment(), $this->subject(), $this->totals());
    }

    protected function buildCards()
    {
        return new Cards($this->subject());
    }

    protected function buildCertificates()
    {
        return new Certificates($this->subject(), $this->subject()->certificates());
    }

    protected function buildProducts()
    {
        return new Products($this->subject(), $this->subject()->products());
    }

    protected function buildTotals()
    {
        return new Totals($this->products());
    }

    protected function instance($name)
    {
        if(!array_key_exists($name, $this->instances)) {
            $method                 = 'build' . ucfirst($name);
            $this->instances[$name] = $this->$method();
        }

        return $this->instances[$name];
    }

}
