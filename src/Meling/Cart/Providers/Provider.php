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
     * @var \Parishop\ORMWrappers\City\Entity
     */
    private $city;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                      $orm
     * @param \PHPixie\HTTP\Context\Session     $session
     * @param \Parishop\ORMWrappers\City\Entity $city
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session, \Parishop\ORMWrappers\City\Entity $city)
    {
        $this->orm     = $orm;
        $this->session = $session;
        $this->city    = $city;
    }

    /**
     * @return \Parishop\ORMWrappers\City\Entity
     */
    public function city()
    {
        return $this->city;
    }

    /**
     * @return \Meling\Tests\ORM
     */
    public function orm()
    {
        return $this->orm;
    }

    /**
     * @return \PHPixie\HTTP\Context\Session
     */
    public function session()
    {
        return $this->session;
    }

    public abstract function certificates();

    public abstract function customer();

    public abstract function options();

}
