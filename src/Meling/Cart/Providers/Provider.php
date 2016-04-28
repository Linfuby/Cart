<?php
namespace Meling\Cart\Providers;

/**
 * Провайдер
 * Class Provider
 * @package Meling\Cart
 */
abstract class Provider
{
    /**
     * @var Product[]
     */
    protected $options;

    /**
     * @var Product[]
     */
    protected $certificates;

    /**
     * @var Customer
     */
    protected $customer;

    /**
     * @var \PHPixie\ORM
     */
    private $orm;

    /**
     * @var \PHPixie\HTTP\Context\Session
     */
    private $session;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                  $orm
     * @param \PHPixie\HTTP\Context\Session $session
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session)
    {
        $this->orm     = $orm;
        $this->session = $session;
    }

    /**
     * @return \Meling\Tests\ORM
     */
    public function orm()
    {
        return $this->orm;
    }

    public function session()
    {
        return $this->session;
    }

    public abstract function certificates();

    public abstract function customer();

    public abstract function options();

}
