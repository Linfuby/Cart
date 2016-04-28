<?php
namespace Meling\Cart\Providers;

/**
 * Class User
 * @package Meling\Cart\Providers
 */
class User extends \Meling\Cart\Providers\Provider
{
    /**
     * @var \Meling\Tests\ORMWrappers\Entities\Customer
     */
    private $user;

    /**
     * Provider constructor.
     * @param \PHPixie\ORM                                $orm
     * @param \PHPixie\HTTP\Context\Session               $session
     * @param \Meling\Tests\ORMWrappers\Entities\Customer $user
     */
    public function __construct(\PHPixie\ORM $orm, \PHPixie\HTTP\Context\Session $session, $user)
    {
        parent::__construct($orm, $session);
        $this->user = $user;
    }

    public function certificates()
    {
        if($this->certificates === null) {
            $this->certificates = array();
            foreach($this->user->cartCertificates() as $certificate) {
                $this->certificates[$certificate->id()] = new Product($certificate->id(), $certificate->certificate(), $certificate->getRequiredField('quantity'), $certificate->getRequiredField('price'), $certificate->getRequiredField('shopId'), $certificate->getRequiredField('shopTariffId'), $certificate->getRequiredField('addressId'));
            }
        }

        return $this->certificates;
    }

    public function customer()
    {
        if($this->customer === null) {
            $this->customer = new Customer($this->user->id(), $this->user->getRequiredField('lastname'), $this->user->getRequiredField('firstname'), $this->user->getRequiredField('middlename'), $this->user->getRequiredField('email'), $this->user->getRequiredField('phone'), $this->user->getRequiredField('birthday'), $this->user->getRequiredField('marriage'));
        }

        return $this->customer;
    }

    public function options()
    {
        if($this->options === null) {
            $this->options = array();
            foreach($this->user->cartOptions() as $option) {
                $this->options[$option->id()] = new Product($option->id(), $option->option(), $option->getRequiredField('quantity'), $option->getRequiredField('price'), $option->getRequiredField('shopId'), $option->getRequiredField('shopTariffId'), $option->getRequiredField('addressId'));
            }
        }

        return $this->options;
    }

}
